<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tuote
 *
 * @author rotsten
 */

class Tuote extends BaseModel {
  // attribuutit
  public $tuote_id, $tuotteen_nimi, $valmistaja, $kuvaus;
  
  // konstruktori
  /*public function __construct ($attributes){
      parent::__construct($attributes);
  }
  
  /*
  public function __construct($tuote_id, $tuotteen_nimi){
    // vain tuotteen pakolliset tiedot
    $this->tuote_id = $tuote_id;
    $this->tuotteen_nimi = $tuotteen_nimi;
  }
 */ 
  public function __construct($tuote_id, $tuotteen_nimi, $valmistaja, $tuotekuvaus){
      parent::__construct();
    // Kun annetaan kaikki tiedot
    $this->tuote_id = $tuote_id;
    $this->tuotteen_nimi = $tuotteen_nimi;
    $this->valmistaja = $valmistaja;
    $this->kuvaus = $tuotekuvaus;
  }

   public static function all(){
    /*
     * Tämä funktio hakee kaikki tuotteet tietokannasta ja
     * palauttaa ne Tuotteet -nimisessä taulukossa
     */
   
      $query = DB::connection()->prepare('SELECT * FROM TUOTE');
      // Suoritetaan kysely
      $query->execute();
      // Haetaan kyselyn tuottamat rivit
      $rows = $query->fetchAll();
      $tuotteet = array();

      // Käydään kyselyn tuottamat rivit läpi
      foreach($rows as $row){
          $tuotteet[] = new Tuote (array(
            'tuote_id' => $row['tuote_id'],
            'tuotteen_nimi' => $row['tuotteen_nimi'],
            'valmistaja' => $row['valmistaja'],
            'kuvaus' => $row['kuvaus']
          ));
      } // end of foreach
    return $tuotteet;
   } // end of function all

  public function find_tuote($Tuote_id){
      // Ei järin fksu funtio, mutta....
      $etsitty_tuote = find_tuote($Tuote_id);
      
   return $etsitty_tuote;
  }
  
  public function save() {
    
    $timestamp = strtotime(time,now); 
    
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Tuote (tuote_id,
            tuotteen_nimi, kuvaus, valmistaja, lukumaara, history_date)
            VALUES (:tuote_id, :tuotteen_nimi, :kuvaus, :valmistaja, lukumaara, 
            timestamp) RETURNING id');
    
    $query->execute(array('tuote_id' => $this->tuote_id, 
                          'tuotteen_nimi' => $this->tuotteen_nimi, 
                          'kuvaus' => $this->kuvaus,
                          'valmistaja' => $this->valmistaja, 
                          'lukumaara' => $this->lukumaara,
                          'history_date' => $timestamp
                          ));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
    $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
    //$this->tuote_id = $row['id'];
  }
  
  public function validate_tuotteen_nimi(){
    $errors = array();
    if($this->tuotteen_nimi == '' || $this->tuotteen_nimi == null){
      $errors[] = 'Nimi ei saa olla tyhjä!';
    }
    
    if(strlen($this->tuotteen_nimi) < 2){
      $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä!';
    }

  return $errors;
}
   
} // end of class
