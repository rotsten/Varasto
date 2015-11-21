<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  require 'base_controller';
  
  class HelloWorldController extends BaseController{
 
    // Tastaamista
    public static function sandbox(){
      echo 'Hip-hei, täällä ollaan!';
      //TuoteController::find_tuotteennimi('Lakua');
      TuoteController::find_tuote('9789522910325');
      //TuoteController::tuote_show('9789522641632');
      base_controller::check_user_rights();
    }
  }
