<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Varasto
 *
 * @author rotsten
 */
class Varasto extends BaseModel{
    //put your code here
    
   // attribuutit
  public $tuote_id, $kayttajatunnus, $lukumaara;
  
  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
  }
  
  public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM VARASTO;');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $varastotilanne = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){

      $varastotilanne[] = new Varasto(array(
        'tuote_id' => $row['tuote_id'],
        'history_kuka_inventoi' => $row['history_kuka_inventoi']
      ));
    } // end of foreach
    
    return $varastotilanne;
  }    
} // end of class


