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
  
  public static function varasto_edit($tuote_id){
    
      //Etsitään ensin tuote, mitä se koskee.
      $muutettava_varastotieto = find_tuote_with_tuote_id($tuote_id);
      
      //Sitten pitäisi olla luotuna psql.näkymä, johon päivitys tulis...   
      // Ensi viikkolla sitten
      
      /*
       * Tämä funktio kutsuu, all-funktiota,
       * mikä hakee varastotilanteen tietokannasta
       */
      
     $varastotilanne = Varasto::all();
     View::make('Varasto/Varastonlistaus.html', array('varastotilanne' => $varastotilanne));
    
  }  // end of varasto_list
}
