<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VarastotilanneController
 *
 * @author rotsten
 */
class VarastotilanneController extends BaseController{
       
  public static function varastotilanne_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee varastotilanteen tietokannasta
     */
    
    //self::check_logged_in(); 
    $varastotilanne = Varastotilanne::all();
    View::make('Varasto/Varastonlistaus.html', array('varastotilanne' => $varastotilanne));

  }  //end of varasto_list
}
