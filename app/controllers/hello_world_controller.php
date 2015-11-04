<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('Suunnitelmat/Aloitussivu.html');
      // echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
      // View::make('HelloWorld.html');
    }
    
    public static function Kayttaja_list(){
       View::make('suunnitelmat/Käyttäjienlistaus.html');
    }
    
    public static function Tuote_list(){
       View::make('suunnitelmat/Tuotelistaus.html');
    }
    
    public static function Varasto_list(){
       View::make('suunnitelmat/Varastonlistaus.html');
    }

    public static function Tuote_show(){
      View::make('suunnitelmat/Tuotesivu.html');
    }

    public static function login(){
       View::make('suunnitelmat/Aloitussivu.html');
    }
  }
