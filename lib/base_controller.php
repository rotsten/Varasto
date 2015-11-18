<?php

  class BaseController{

    public static function get_user_logged_in(){
      /* palauttaa sovellukseemme kirjautuneen käyttäjän oliona, 
       * jotta voimme käyttää tietoa kirjautuneesta käyttäjästä 
       * näkymissä ja kontrollereissa. 
       */

        if(isset($_SESSION['kayttaja'])){
          $kayttajatunnus = $_SESSION['Kayttaja'];
          // Pyydetään Kayttaja-mallilta käyttäjä session mukaisella id:llä
          $kayttaja = Kayttaja::find($kayttajatunnus);

          return $kayttaja;
        }

    // Käyttäjä ei ole kirjautunut sisään
    return null;
  }

    public static function check_logged_in($kayttajatunnus){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        
        if($_SESSION['kayttaja'] == $kayttajatunnus){
            return TRUE;
        }

        Redirect::to('/Kayttaja/Kirjaudu.html');     
    } 
    
    public static function check_user_rights(){

        $tarkistettava_kayttaja = get_user_logged_in();
        
        if($tarkistettava_kayttaja['kayttooikeudet']){
            return TRUE;
        }

        // EI ole pääkäyttäjä
        return FALSE; 
    } // end of check_user_rights()

  } // End of BaseController
