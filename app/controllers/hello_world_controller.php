<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  
  class HelloWorldController extends BaseController{
 
    // Tastaamista
    public static function sandbox(){
      echo 'Hip-hei, täällä ollaan!';
      TuoteController::find_tuotteennimi('Lakua');
      TuoteController::find_tuote('9789522910325');
      $varastotilanne = Varasto::all();
      $kayttajat = Kayttaja::all();
      $Tuotteet = Tuote::all();
      
      Kint::dump ($Tuotteet);
      Kint::dump ($varastotilanne);
      Kint::dump ($kayttajat);
    }
 
    public static function index(){
      View::make('Aloitussivu.html');
    }

    public static function paasivu_show(){
      View::make('Paasivu.html');
    }
    
    // Käyttäjään littyvät funktiot
    public static function kirjaudu(){
       View::make('Kirjaudu.html');
    }
    
    public static function kayttaja_list(){
       View::make('Kayttaja/Kayttajienlistaus.html');
    }
    
    public static function kayttaja_edit(){
       View::make('Kayttaja/Kayttajatietojenmuutos.html');
    }
      
    
    

       
    // Varastoon liittyvät funktiot
    public static function varasto_list(){
       View::make('Varasto/Varastonlistaus.html');
    }
    
    public static function varasto_edit(){
      View::make('Varasto/Varastotilanteenmuutos.html');
    }
  }
