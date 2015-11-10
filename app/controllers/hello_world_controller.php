<?php

  //require 'app/models/Tuote.php';
  //require 'app/models/Kayttaja.php';
  
  class HelloWorldController extends BaseController{

 /*
    public static function sandbox(){
      $Tuotteet = Tuote::all();
      Kint::dump ($Tuotteet);
    }
 */

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
      UserController::handle_login();
      //$Tuotteet = Tuote::all();
      // View::make('HelloWorld.html');
    }
    
    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('Aloitussivu.html');
      // echo 'Tämä on etusivu!';
    }

    public static function paasivu_show(){
      View::make('Paasivu.html');
    }
   
    
    public static function login(){
       View::make('Login.html');
    }
   
    // Tuotteeseen liittyvät funktiot 
    
    public static function tuote_show(){
      View::make('Tuote/Tuotesivu.html');
    }

    public static function tuote_list(){
       View::make('Tuote/Tuotteidenlistaus.html');
    }

    public static function tuote_add(){
       View::make('Tuote/Lisaatuote.html');
    }
    
    public static function tuote_edit(){
      View::make('Tuote/Tuotetietojenmuutos.html');
    }
    
    public static function tuote_search(){
      View::make('Tuote/Tuotteenhakeminen.html');
    }
       
    //public static function handle_reg(){
    //   View::make('/Suunnitelmat/Paasivu.html');
    //}
    

    // Varastoon liittyvät funktiot
    
    public static function varasto_list(){
       View::make('Varasto/Varastonlistaus.html');
    }
    
    public static function varasto_edit(){
      View::make('Varasto/Varastotilanteenmuutos.html');
    }
    
    // Käyttäjään littyvät funktiot
    
    public static function kayttaja_list(){
       View::make('Kayttaja/Kayttajienlistaus.html');
    }
    
    public static function kayttaja_edit(){
       View::make('Kayttaja/Kayttajatietojenmuutos.html');
    }
  }
