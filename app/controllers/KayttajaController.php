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
    
    /*
    public static function index(){
       $kayttajat = Kayttaja::all();
       View::make('kayttajat/Kayttajienlistaus.html', array('kayttajat' => $kayttajat));
    } */
    
   
  public function authenticate ($kayttajatunnus, $salasana) {
 
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus AND salasana = $salasana LIMIT 1');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
    $row = $query->fetch();
    if($row){
      $found_kayttaja = new Kayttaja(array(
          'kayttajatunnus' => $row['kayttajatunnus'],
          'salasana' => $row['salasana'],
          'etunimi' => $row['etunimi'],
          'sukunimi' => $row['sukunimi'],
          'kayttooikeus' => $row['kayttooikeus']
        ));
      return found_kayttaja;
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
       $user = KayttajaController::authenticate($params['kayttajatunnus'], $params['salasana']);

      if(!$user){
          View::make('Kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['kayttajatunnus']));
      } else{
          $_SESSION['kayttajatunnus'] = $user->kayttajatunnus;

          Redirect::to('Paasivu', array('message' => 'Tervetuloa takaisin ' . $user->etunimi . '!'));
      } // the end of function
    } // the end of function
  } // the end of handle_login()

  public static function kayttaja_list(){
   /*
    * Tämä funktio kutsuu, all-funktiota,
    * mikä hakee varastotilanteen tietokannasta
    */
    $kayttajat = Kayttaja::all();
    View::make('Kayttaja/Kayttajienlistaus.html', array('kayttajat' => $kayttajat));
  } // end of kayttaja_list
    
  public static function kayttaja_find ($kayttajatunnus){
  /*
   * Pitää ensin etsiä halutun käyttäjän tiedot tietokannasta.
   */
      
    $query = DB::connection()->prepare ('SELECT * KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus');
    $query->execute(array('tuote_id' => $tuote_id));
    $row = $query->fetch();

    if($row){
       $muutettava_kayttaja = new Kayttaja(array(
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'kayttooikeudet' => $row['kayttooikeudet']
      ));
    }
    return $kayttaja;
    
  } // end of kayttaja_find
     
  public static function kayttaja_edit($kayttajatunnus){
   /*
    * Pitää ensin etsiä halutun käyttäjän tiedot tietokannasta.
    */
      
    $muutettava_kayttaja = Kayttaja::find($kayttajatunnus);
    View::make('Kayttaja/Kayttajatietojenmuutos.html', $muutettava_kayttaja);
    
  } // end of kayttaja_edit
} // THE END of class
