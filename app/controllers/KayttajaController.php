<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KayttajaController
 *
 * @author rotsten
 */
class KayttajaController extends BaseController {
    
    public static function Kirjaudu(){
      View::make('/Kayttaja/Kirjaudu.html');
    }
                    
    public static function paasivu_show(){
      self::check_logged_in();
      $paakayttaja= self::check_user_rights();
      
      View::make('Paasivu.html', array('oikeudet' => $paakayttaja));
    }
    
    public static function kayttooikeudet_check($kayttaja){

    Kint::dump($kayttaja);
    $kayttajan_tiedot = Kayttaja::find($kayttaja);
    
    Kint::dump($kayttajan_tiedot['kayttooikeudet']);
    
      if ( $kayttajan_tiedot['kayttooikeudet'] == 'true' ) {
        // Kyseessä on pääkäyttäjä
        return true;
      }
        else {
          return false;  
      } // end of if
    } // end of kayttooikeudet_check()
    
  /*****************************************
   * 
   * Käyttäjän kirjautuminen 
   * 
   *****************************************/
         
  public function authenticate ($kayttajatunnus, $salasana) {
 
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
    $row = $query->fetch();
    if($row){
      $found_kayttaja = new Kayttaja(array(
          'kayttajatunnus' => $row['kayttajatunnus'],
          'salasana' => $row['salasana'],
          'etunimi' => $row['etunimi'],
          'sukunimi' => $row['sukunimi'],
          'kayttooikeudet' => $row['kayttooikeudet']
        ));
      return $found_kayttaja;
    }
    else{
      return null;
    } // end of if-else
  } // end of authenticate

  public static function check_login_params($params){
           
     //Kint::dump($params);            
     $errors  = array();
     $errors2 = array();
     
     if ($params['kayttajatunnus'] == '' || $params['kayttajatunnus'] == null){
        $errors[] = 'Jätit käyttäjätunnuksen antamatta!';
     }
 
     if($params['salasana'] == '' || $params['salasana'] == null){
        $errors2[] = 'Jätit salasanan antamatta!';
     }
        
     $errors = array_merge($errors, $errors2);
    
     // Palautetaan mahdolliset virheilmoitukset
     return $errors;
   }  

  public static function handle_login (){

   /* 
    * This function receives two values from Login.html:
    * These are: käyttäjätunnus & salasana 
    * Returns the text, whether fields are empty or not.
    * Later add also other mechanisms to check the validity of the inputs... 
    */
      
    $params = $_POST;
    $errors = array();
    
    // Tarkistetaan, että käyttäjätunnus ja salasana ovat annettu
    $errors = KayttajaController::check_login_params($params);
       
    if(count($errors) == 0){
       
       // Tarkistetaan löytyykö annettu käyttäjätunnus + salasana -pari
       $kayttaja = KayttajaController::authenticate($params['kayttajatunnus'], $params['salasana']);

      if(!$kayttaja){
          $errors []= 'Väärä käyttäjätunnus tai salasana!'; 
          View::make('/Kayttaja/Kirjaudu.html', array('errors' => $errors, 'attributes' => $params));
      } else{
          // Sessioon annetaan käyttäjän käyttäjätunnus
          $_SESSION['Kayttaja'] = $kayttaja->kayttajatunnus;

          Redirect::to('/Paasivu', array('message' => 'Tervetuloa takaisin ' . $kayttaja->etunimi . '!'));
      } // the end of function
    } // the end of function
    else {
       // Jotain virheitä käyttäjätunnuksen ja salasanan antamisessa:
       Redirect::to('/Kayttaja/Kirjaudu', array('errors' => $errors));
    } // end of if
  } // the end of handle_login()

  /*****************************************
   * 
   * Käyttäjätietojen esittely & listaaminen 
   * 
   *****************************************/
  
  public static function kayttaja_show($kayttajatunnus) {
     
     self::check_logged_in(); 
     $listattava_kayttaja = Kayttaja::find($kayttajatunnus);

     View::make('Kayttaja/Kayttajasivu.html', array('kayttaja' => $listattava_kayttaja));                   
  } // The end of kayttaja_show
  
  public static function kayttajalistaus(){   
   /*
    * Tämä funktio kutsuu, all-funktiota,
    * mikä hakee varastotilanteen tietokannasta
    */
    
    self::check_logged_in();
    
    $Kayttajat = Kayttaja::all();
    $paakayttaja= TuoteController::check_user_rights();
      
    View::make('Kayttaja/Kayttajienlistaus.html', array('Kayttajat' => $Kayttajat, 'oikeudet' => $paakayttaja));
    
  } // end of kayttaja_list

  /*****************************************
   * 
   * Käyttäjän lisääminen
   * 
   *****************************************/
    
  // Näyttää käyttäjän lisäyssivun
  public static function kayttaja_lisaa_show(){
    
    self::check_logged_in();
    View::make('Kayttaja/LisaaKayttaja.html');
  }
 
  public static function kayttaja_create (){    

    self::check_logged_in();
    $params = $_POST;
    
    $uusi_kayttaja = new Kayttaja(array(
      'kayttajatunnus' => $params['kayttajatunnus'],  
      'salasana' => $params['salasana'],
      'etunimi' => $params['etunimi'],
      'sukunimi' => $params['sukunimi'],
      'kayttooikeudet' => $params['kayttooikeudet']
    ));
    
    // tsekataan käyttäjätunnuksen ja salasanan antaminen  
    //$errors = KayttajaController::check_login_params($params);
    $errors = $uusi_kayttaja->errors();
     
    if(count($errors) == 0){
  
      $uusi_kayttaja ->save();
            
      $Kayttajat = Kayttaja::all();   
      View::make('Kayttaja/Kayttajienlistaus.html', array('Kayttajat' => $Kayttajat));
          
    } else{
        // Annetuissa arvoissa oli jotain vikaa.     
        Kint::dump($errors);
        View::make('Kayttaja/LisaaKayttaja.html', array('errors' => $errors, 'attiributes' => $params));
    }
    return;
  }
 
  /*****************************************
   * 
   * Käyttäjätietojen muutos
   * 
   *****************************************/
  
  public static function kayttaja_edit($kayttajatunnus){
    /*
     * Pitää ensin etsiä halutun käyttäjän tiedot tietokannasta.
     */
      
    self::check_logged_in();    
    $muutettava_kayttaja = Kayttaja::find($kayttajatunnus);
    
    View::make('Kayttaja/Kayttajatietojenmuutos.html', array('muutettava_kayttaja' => $muutettava_kayttaja));
 
  } // end of kayttaja_edit
     
  public static function kayttaja_edit_post($kayttajatunnus){
 
    self::check_logged_in();
    $uudet_kayttajan_tiedot = $_POST; 
 
    // Luodaan uusi Kayttaja, jolla kutsutaan modifya...
    
    $muuttujat= array(
      'kayttajatunnus' => $kayttajatunnus,
      'salasana' => $uudet_kayttajan_tiedot['salasana'],
      'etunimi' => $uudet_kayttajan_tiedot['etunimi'], 
      'sukunimi' => $uudet_kayttajan_tiedot['sukunimi'],
      'kayttooikeudet' => $uudet_kayttajan_tiedot['kayttooikeudet']
    );
 
    $Kayttajatietojen_muutokset = new Kayttaja ($muuttujat);
    $errors = $Kayttajatietojen_muutokset->errors();
    
    if(count($errors) == 0){

      $Kayttajatietojen_muutokset->modify();      
      KayttajaController::kayttajalistaus();
    } 
    else {
      View::make('Kayttajatietojenmuutos.html', array('errors' => $errors, 'attributes' => $Kayttajatietojen_muutokset));
    }   
  } // end of kayttaja_edit_post
  
  /*****************************************
   * 
   * Käyttäjän poistaminen
   * 
   *****************************************/
  
  public static function poista_kayttaja($kayttajatunnus){
    
    self::check_logged_in();  
      
    $poistettava_kayttaja = new Kayttaja(array('kayttajatunnus' => $kayttajatunnus));
    Kint::dump($poistettava_kayttaja);
    
    $poistettava_kayttaja->destroy();
    
    // Käyttäjä näkee listauksesta, että kayttajatunnus on poistunut      
    $Kayttajat = Kayttaja::all();
    Redirect::to('/Kayttaja/Kayttajienlistaus', array('Kayttajat' => $Kayttajat));
  }
} // THE END of class
