<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  //require 'Varasto/lib/base_controller';
  //require 'Varasto/lib/base_model';
  
  class HelloWorldController extends BaseController{
    
    // Tastaamista
    public static function sandbox(){
      echo 'Hip-hei, täällä ollaan!';
      
      
      //VarastoTuoteController::varastotilanne_show('001');
      
      //echo $varastotilanne = Varastotilanne::all();
      
      
      $Uusi_kayttaja = new Kayttaja(array(
        'kayttajatunnus' => 'a',
        'salasana' => '7',
        'etunimi' => '?',
        'sukunimi' => '',
        'kayttooikeudet' => '1'
      ));
      $errors = $Uusi_kayttaja->errors();

      Kint::dump($errors);

      //base_controller::check_user_rights();
    }
  }
