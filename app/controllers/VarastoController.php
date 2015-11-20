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
    
    public static function varasto_list(){
       View::make('Varasto/Varastonlistaus.html');
    }
    
    public static function varasto_edit(){
      View::make('Varasto/Varastotilanteenmuutos.html');
    }
}
