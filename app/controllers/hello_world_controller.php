<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  //require 'Varasto/lib/base_controller';
  //require 'Varasto/lib/base_model';
  
  class HelloWorldController extends BaseController{
    
    // Tastaamista
    public static function sandbox(){
      echo 'Hip-hei, täällä ollaan!';
      
      //TuoteController::find_tuote_with_tuote_id('9518752761');
      //TuoteController::find_tuote_post('9789523001084');
      //
      
      echo base_controller::get_user_logged_in();
      
      echo $varastotilanne = Varastotilanne::all();
            
      //$kayttaja = get_user_logged_in();
      //echo $kayttaja;
      
      $Uusi_kayttaja = new Kayttaja(array(
        'kayttajatunnus' => 'a',
        'salasana' => '7',
        'etunimi' => '?',
        'sukunimi' => ''
      ));
      $errors = $Uusi_kayttaja->errors();

      Kint::dump($errors);
      
      //$Uusi_kirja = new Tuote(array(
      //  'tuote_id' => 'a',
      //  'tuotteen_nimi' => '7',
      //  'valmistaja' => '?',
      //  'kuvaus' => ''
      //));
      //$errors = $Uusi_kirja->errors();
      //Kint::dump($errors);
            
      //TuoteController::find_tuotteennimi('Lakua');
      //TuoteController::tuote_show('9789522641632');
      //base_controller::check_user_rights();
    }
  }
