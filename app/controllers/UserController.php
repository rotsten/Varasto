<?php

class UserController extends BaseController {
    
 /* 
 * Tietokantasovellus harjoitustyö, 2015 
 *  Kirsi Rotstén 
 *
 * This script receives two values from Home.html:
 * These are: käyttäjätunnus & salasana 
 * Returns the text, whether fields are empty or not.
 * Later add also other mechanisms to check the validity of the inputs... 
 */

public static function handle_login (){

    $params = $_POST;
    
    // Success-flag setting
    $okay = TRUE;
   
    // Tsekkaa antoiko käyttäjä käyttäjätunnuksen:
    if (empty($submit['user_id'])) {
            print '<p class="error">Anna käyttäjätunnus.</p>';
            $okay = FALSE;
    }

    // Tsekkaa antoiko käyttäjä salasanan:
    if (empty($submit['password'])) {
            print '<p class="error">Anna salasana.</p>';
            $okay = FALSE;
    }
    if ($okay) {
        $query = DB::connection()->prepare ('SELECT * KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus and salasana = $salasana;');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus));
        $row = $query->fetch();
    
        if($row){
            // Käyttäjä löytyi!
            $Found_Kayttaja = new Kayttaja(array(
              'kayttajatunnus' => $row['kayttajatunnus'],
              'salasana' => $row['salasana'],
              'etunimi' => $row['etunimi'],
              'sukunimi' => $row['sukunimi'],
              'kayttooikeus' => $row['kayttooikeus']
            ));

            return $Found_Kayttaja;
        } 
        else
        {
          // Käyttäjää ei löytynyt
          return null;
        } // end of if 
    }
    else  // not "okay"
    {
      //print '<p>Yritä uudelleen.</p>';
      return null;
    } // end of if-else
} // end of function
}
