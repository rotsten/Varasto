<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VarastoController
 *
 * @author rotsten
 */
class VarastoController {
    
    
    public static function index(){
       $varastotilanne = Varasto::all();
       View::make('varastotilanne/Varastotilanteenmuutos.html', array('varastotilanne' => $varastotilanne));
    }
    
    
    public static function varasto_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee varastotilanteen tietokannasta
     */
     $varastotilanne = Varasto::all();
     View::make('Varasto/Varastonlistaus.html', array('varastotilanne' => $varastotilanne));
    
  }  // end of varasto_list
}
