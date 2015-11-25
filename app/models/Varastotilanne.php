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
  
    public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
     
    $query = DB::connection()->prepare('SELECT Varasto.tuote_id, 
                                               Tuote.tuotteen_nimi, 
                                               Varasto.lukumaara, 
                                               Varasto.history_kuka_inventoi
      FROM Varasto 
      INNER JOIN Tuote ON Varasto.tuote_id = Varasto.tuote_id;');

    // $query = DB::connection()->prepare('SELECT * FROM VARASTO;');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $varastotilanne = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){

      // Kysymyksessä ei ole enää Varasto-olio, vaan Varastotilanne -olio
      $varastotilanne[] = new Varastotilanne(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteen_nimi' => $row['tuotteen_nimi'],
        'lukumaara' => $row['lukumaara'],  
        'history_kuka_inventoi' => $row['history_kuka_inventoi']
      ));
             
    } // end of foreach
    
    return $varastotilanne;
  }
   
}
