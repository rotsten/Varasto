<?php

  class BaseController{
        
    public static function get_user_logged_in(){
      /* palauttaa sovellukseemme kirjautuneen käyttäjän oliona, 
       * jotta voimme käyttää tietoa kirjautuneesta käyttäjästä 
       * näkymissä ja kontrollereissa. 
       */

      if(isset($_SESSION['Kayttaja'])){
        $kayttajatunnus = $_SESSION['Kayttaja'];
        
        //Kint::dump($kayttajatunnus);
        
        // Pyydetään Kayttaja-mallilta käyttäjä session mukaisella id:llä
        $kayttaja = Kayttaja::find($kayttajatunnus);
        //Kint::dump($kayttaja);

        return $kayttaja;
      }
      else {
          
        // Käyttäjä ei ole kirjautunut sisään
        // View::make('/Kirjaudu.html', array('message' => 'Vaatii kirjautumisen'));   
      } 
      return null;
    } // end of get_user_logged_in()

    public static function check_logged_in(){
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        
        // Sessioon on tallennettu kirjautuneen käyttäjän käyttäjätunnus
        if(!isset($_SESSION['Kayttaja'])){
            Redirect::to('/Kayttaja/Kirjaudu', array('message' => 'Vaatii kirjautumisen')); 
         }  
    } 
    
  public static function check_user_rights(){

    // hakee sisään kirjautuneen tiedot. Palauttaa Kayttaja -olion.
    $tarkistettava_kayttaja = BaseController::get_user_logged_in();
    
    // true or false
    return KayttajaController::get_kayttooikeudet($tarkistettava_kayttaja);
        
  } // end of check_user_rights()
  
 /*****************************************
  * 
  * Kirjaudutaan ulos
  * 
  *****************************************/

  public static function logout(){
    $_SESSION['Kayttaja'] = null;
    
    //Kint::dump($_SESSION);
    View::make('/Kayttaja/Logout.html');
    //Redirect::to('Kayttaja/Logout', array('message' => 'Olet kirjautunut ulos!'));
  }  
} // End of BaseController
