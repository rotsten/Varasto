<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KayttajaController
 *
 * @author rotsten
 */
class KayttajaController {
          
    public static function kayttaja_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee varastotilanteen tietokannasta
     */
     $kayttajat = Kayttaja::all();
     View::make('Kayttaja/Kayttajienlistaus.html', array('Kayttajat' => $kayttajat));
    
  }  // end of kayttaja_list
}
