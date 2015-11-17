<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
       
        // Katsotaan onko user-avain sessiossa
        if(isset($_SESSION['kayttaja'])){
          $kayttajatunnus = $_SESSION['Kayttaja'];
          // Pyydetään Kayttaja-mallilta käyttäjä session mukaisella id:llä
          $kayttaja = Kayttaja::find($kayttajatunnus);

          return $kayttaja;
        }

    // Käyttäjä ei ole kirjautunut sisään
    return null;
  }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
