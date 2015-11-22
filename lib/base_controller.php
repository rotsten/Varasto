<?php

  class BaseController{

    public static function get_user_logged_in(){
      /* palauttaa sovellukseemme kirjautuneen käyttäjän oliona, 
       * jotta voimme käyttää tietoa kirjautuneesta käyttäjästä 
       * näkymissä ja kontrollereissa. 
       */

      if(isset($_SESSION['kayttaja'])){
        $kayttajatunnus = $_SESSION['Kayttaja'];
        
        Kint::dump($kayttajatunnus);
        
        // Pyydetään Kayttaja-mallilta käyttäjä session mukaisella id:llä
        $kayttaja = Kayttaja::find($kayttajatunnus);

        return $kayttaja;
      }

      // Käyttäjä ei ole kirjautunut sisään
      return null;
    } // end of get_user_logged_in()

    public static function check_logged_in($kayttajatunnus){
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        
        if(!isset($_SESSION['kayttajatunnus'])){
            Redirect::to('/Kirjaudu.html', array('message' => 'Vaatii kirjautumisen')); 
         }  
    } 
    
    public static function check_user_rights(){

        $tarkistettava_kayttaja = get_user_logged_in();
        
        if($tarkistettava_kayttaja['kayttooikeudet']='T'){
            Kint::dump($tarkistettava_kayttaja);
            return TRUE;
        }
        // EI ole pääkäyttäjä
        return FALSE; 
    } // end of check_user_rights()

  } // End of BaseController
