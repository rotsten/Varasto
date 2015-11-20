<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  
  class HelloWorldController extends BaseController{
 
    // Tastaamista
    public static function sandbox(){
      echo 'Hip-hei, täällä ollaan!';
      //TuoteController::find_tuotteennimi('Lakua');
      //TuoteController::find_tuote('9789522910325');
      TuoteController::tuote_show('9789522641632');
      //TuoteController::find_tuote_with_tuote_id('9789522910325');

    }
  }
