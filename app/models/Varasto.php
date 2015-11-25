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
    
   // attribuutit
  public $tuote_id, $lukumaara, $history_kuka_inventoi;
  
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

      $varastotilanne[] = new Varastotilanne(array(
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara'],  
        'history_kuka_inventoi' => $row['history_kuka_inventoi']
      ));
             
    } // end of foreach
    
    return $varastotilanne;
  }
  
  public static function find($tuote_id){
      
    //Kint::dump($tuote_id);
    
    $query = DB::connection()->prepare('SELECT * FROM VARASTO WHERE tuote_id = :tuote_id LIMIT 1');
    $query->execute(array('tuote_id' => $tuote_id));
    $row = $query->fetch();
    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara'],
        'history_kuka_inventoi' => $row['history_kuka_inventoi'] 
      ));
    
      //Kint::dump($tuote);
      return $tuote;
            
     } // end of if
  } // end of find_tuote (tuote_id)
  
  public function validate_lukumaara(){
      
    /* Tarkistaa, onko annettu merkkijono sisältää vain numeroita.
     * Lukumäärän antaminen ei ole välttämätöntä.
     */
        
     $errors_lukumaara = array();
      
     // tarkistaa, että sisältää vain numeroita
     if (is_numeric($this->tuote_id)) {
       if ($this->tuote_id < 0) {
           $errors_lukumaara[] = 'lukumäärä on aina positiivinen kokonaisluku!'; 
       }
     } else {
         $errors_lukumaara[] = 'Lukumäärä ei saa sisältää muita merkkejä kuin numeroita!';
     }  
       
     return $errors_lukumaara;
  }
} // end of class


