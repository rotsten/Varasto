<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  //require 'Varasto/lib/base_controller';
  //require 'Varasto/lib/base_model';
  
  class HelloWorldController extends BaseController{
    
    // Tastaamista
    public static function sandbox(){
      echo 'Hip-hei, täällä ollaan!';
      
      //$paluuarvo = self::check_user_rights();
      //echo $paluuarvo;
      
      VarastoTuoteController::varastotuote_lisaa_show(15);
      
      //TuoteController::poista_tuote('9789513233259');
      
      //echo user_logged_in.kayttajatunnus;
      
      //VarastoTuoteController::varastotilanne_show('001');
      //echo $varastotilanne = Varastotilanne::all();
            
      //$Uusi_kayttaja = new Kayttaja(array(
      //  'kayttajatunnus' => 'a',
      //  'kayttooikeudet' => 'x'
      //));
      //$errors = $Uusi_kayttaja->errors();

      //Kint::dump($errors);

      //base_controller::check_user_rights();
    }
  }
