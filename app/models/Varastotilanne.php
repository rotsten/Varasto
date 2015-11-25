<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Varastotilanne
 *
 * @author rotsten
 */
class Varastotilanne extends Varasto{
    
  // attribuutit
  public $tuotteen_nimi;
  
  // konstruktori
  public function __construct ($varaston_tiedot){
      
      parent::__construct($varaston_tiedot);
      $this->tuote_id = $varaston_tiedot['tuote_id'];
      $this->tuotteen_nimi = $varaston_tiedot['tuotteen_nimi'];
      $this->lukumaara = $varaston_tiedot['lukumaara'];
      $this->history_kuka_inventoi = $varaston_tiedot['history_kuka_inventoi'];
  }
  
}
