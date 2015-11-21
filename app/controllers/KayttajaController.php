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
      View::make('Paasivu.html');
    }
         
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

  public static function handle_login (){

   /* 
    * This function receives two values from Login.html:
    * These are: käyttäjätunnus & salasana 
    * Returns the text, whether fields are empty or not.
    * Later add also other mechanisms to check the validity of the inputs... 
    */
      
    $params = $_POST;
    //$annettu_kayttajatunnus=$_POST['kayttajatunnus'];
    //$annettu_salasana      =$_POST['salasana'];
    
    // Success-flag setting
    $okay = TRUE;
   
    // Tsekkaa antoiko käyttäjä käyttäjätunnuksen:
    if (empty($params['kayttajatunnus'])){
       print '<p class="error">Anna käyttäjätunnus.</p>';
       $okay = FALSE;
    }
    
    // Tsekkaa antoiko käyttäjä salasanan:   
    if (empty($params['salasana'])){
       print '<p class="error">Anna salasana.</p>';
       $okay = FALSE;
    }
    
    /*
    if (empty($submit['salasana'])) {
            print '<p class="error">Anna salasana.</p>';
            $okay = FALSE;
    }*/
    if ($okay) {
       //$user = Kayttaja::authenticate($annettu_kayttajatunnus, $annettu_salasana);
       $kayttaja = KayttajaController::authenticate($params['kayttajatunnus'], $params['salasana']);

      if(!$kayttaja){
          View::make('/Kayttaja/Kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['kayttajatunnus']));
      } else{
          $_SESSION['kayttajatunnus'] = $kayttaja->kayttajatunnus;

          Redirect::to('/Paasivu', array('message' => 'Tervetuloa takaisin ' . $kayttaja->etunimi . '!'));
      } // the end of function
    } // the end of function
  } // the end of handle_login()
  
  public static function kayttaja_show($kayttajatunnus) {
        
     $listattava_kayttaja = Kayttaja::find($kayttajatunnus);

     View::make('Kayttaja/Kayttajasivu.html', array('kayttaja' => $listattava_kayttaja));
                   
  } // The end of kayttaja_show
  
  public static function kayttajalistaus(){
   /*
    * Tämä funktio kutsuu, all-funktiota,
    * mikä hakee varastotilanteen tietokannasta
    */
    $Kayttajat = Kayttaja::all();
    //Kint::dump($Kayttajat);
      
    View::make('Kayttaja/Kayttajienlistaus.html', array('Kayttajat' => $Kayttajat));
  } // end of kayttaja_list
    
 
  public static function kayttaja_edit($kayttajatunnus){
   /*
    * Pitää ensin etsiä halutun käyttäjän tiedot tietokannasta.
    */
        
    $muutettava_kayttaja = Kayttaja::find($kayttajatunnus);
    Kint::dump($muutettava_kayttaja);
    
    View::make('Kayttaja/Kayttajatietojenmuutos.html', $muutettava_kayttaja);
 
  } // end of kayttaja_edit
     
  public static function kayttaja_edit_post($kayttajatunnus){
 
    $uudet_kayttajan_tiedot = $_POST; 
    // Kutsu kayttaja_list();
    
    //Luodaan uusi Kayttaja, jolla kutsutaan modifya...
    
    $muuttujat= array(
      'kayttajatunnus' => $kayttajatunnus,
      'salasan' => $uudet_tiedot['tuotteen_nimi'],
      'etunimi'=> $uudet_tiedot['etunimi'], 
      'sukunimi'=> $uudet_tiedot['sukunimi'],
      'kayttooikeudet' => $uudet_tiedot['kayttooikeudet']
    );

    $Kayttajatietojen_muutokset = new Kayttaja ($muuttujat);
    //$errors = $Tuote->errors();
    
    $Kayttajatietojen_muutokset->modify();
    $Kayttajatietojen_muutokset::kayttajalistaus();
    
  } // end of kayttaja_edit_post
} // THE END of class
