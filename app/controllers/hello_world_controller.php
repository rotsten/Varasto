<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  
  class HelloWorldController extends BaseController{
 
    // Tastaamista
    public static function sandbox(){
      echo 'Hip-hei, täällä ollaan!';
      //TuoteController::find_tuotteennimi('Lakua');
      TuoteController::find_tuote('9789522910325');
      //TuoteController::find_tuote_with_tuote_id('9789522910325');

    }
 
    public static function index(){
      View::make('Aloitussivu.html');
    }

    public static function paasivu_show(){
      View::make('Paasivu.html');
    }
    
     public static function kirjaudu(){
       View::make('Kayttaja/Kirjaudu.html');
    }
        
    public static function kayttaja_list(){
       View::make('Kayttaja/Kayttajienlistaus.html');
    }
    
    public static function kayttaja_edit(){
       View::make('Kayttaja/Kayttajatietojenmuutos.html');
    }
      
    // Tuotteeseen liittyvät funktiot 
    public static function tuote_list(){
       View::make('Tuote/Tuotteidenlistaus.html');
    }

    public static function tuote_add(){
       View::make('Tuote/Lisaatuote.html');
    }
 /*   
    public static function tuote_show(){
      View::make('Tuote/Tuotesivu.html');
    }
  */
    public static function tuote_edit(){
      View::make('Tuote/Tuotetietojenmuutos.html');
    }
    
    public static function tuote_search(){
      View::make('Tuote/Tuotteenhakeminen.html');
    }
       
    // Varastoon liittyvät funktiot
    public static function varasto_list(){
       View::make('Varasto/Varastonlistaus.html');
    }
    
    public static function varasto_edit(){
      View::make('Varasto/Varastotilanteenmuutos.html');
    }
  }
