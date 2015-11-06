<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('Suunnitelmat/Aloitussivu.html');
      // echo 'Tämä on etusivu!';
    }

    public static function login(){
       View::make('Suunnitelmat/Aloitussivu.html');
    }
    
    public static function tuote_show(){
      View::make('Suunnitelmat/Tuotesivu.html');
    }
    
    public static function tuote_edit(){
      View::make('Suunnitelmat/Tuotetietojenmuutos.html');
    }
    
    public static function tuote_search(){
      View::make('Suunnitelmat/Tuotteenhakeminen.html');
    }
    
    public static function tuote_list(){
       View::make('Suunnitelmat/Tuotteidenlistaus.html');
    }
    
    //public static function handle_reg(){
    //   View::make('/Suunnitelmat/Paasivu.html');
    //}
    
    public static function paasivu_show(){
      View::make('Suunnitelmat/Paasivu.html');
    }
    
    public static function varasto_list(){
       View::make('Suunnitelmat/Varastonlistaus.html');
    }
    
    public static function varasto_edit(){
      View::make('Suunnitelmat/Varastotilanteenmuutos.html');
    }
    
    public static function kayttaja_list(){
       View::make('Suunnitelmat/Käyttäjienlistaus.html');
    }
    
    public static function sandbox(){
      // Testaa koodiasi täällä
      // echo 'Hello World!';
      // View::make('HelloWorld.html');
    }
  }
