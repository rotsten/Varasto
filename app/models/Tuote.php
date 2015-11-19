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
  public $tuote_id, $tuotteen_nimi, $valmistaja, $kuvaus, $lukumaara, $history_date;
  
  //konstruktori
  
  public function __construct ($attributes){
      parent::__construct($attributes);
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
             'kuvaus' => $row['kuvaus'],
             'lukumaara' => $row['lukumaara'], 
             'history_date' => $row['history_date']
           ));
      } // end of foreach
      return $tuotteet;
    } // end of function all

  public function find_tuote($tuote_id){
    // Ei järin fiksu funtio, mutta....
    $etsitty_tuote = TuoteController::find_tuote($tuote_id);
      
    return $etsitty_tuote;
  }
  
  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Tuote (tuote_id,
            tuotteen_nimi, kuvaus, valmistaja, lukumaara, history_date)
            VALUES (:tuote_id, :tuotteen_nimi, :kuvaus, :valmistaja, :lukumaara, 
            :history_date)');
   
     $query->execute(array('tuote_id' => $this->tuote_id, 
                          'tuotteen_nimi' => $this->tuotteen_nimi, 
                          'kuvaus' => $this->kuvaus,
                          'valmistaja' => $this->valmistaja, 
                          'lukumaara' => $this->lukumaara,
                          'history_date' => $this->history_date
                          ));      
  }
  
  public function modify () {
                 
    /*
     * UPDATE TUOTE SET tuotteen_nimi = 'uusi nimi', 
     *                  kuvaus = 'uusi kuvaus', 
     *                  valmistaja = 'uusi valmistaja', 
     *                  lukumaara = 5, 
     *                  history_date = '2015-11-18 17:05:00' WHERE tuote_id = '345345';
     */
    
    /*
    $new_tuotteen_nimi = $uudet_tiedot['tuotteen_nimi'];
    $new_valmistaja = $uudet_tiedot['valmistaja'];
    $new_kuvaus = $uudet_tiedot['kuvaus'];
    $new_lukumaara = $uudet_tiedot['lukumaara'];
    $new_history_date =$uudet_tiedot['history_date'];
    */
    
    // public $tuote_id, $tuotteen_nimi, $valmistaja, $kuvaus, $lukumaara, $history_date;
    
    $query = DB::connection()->prepare ('UPDATE TUOTE SET tuotteen_nimi = :new_tuotteen_nimi,
                                                          valmistaja = :new_valmistaja,
                                                          kuvaus = :new_kuvaus,
                                                          lukumaara = :new_lukumaara,
                                                          history_date = :new_history_date WHERE tuote_id =:tuote_id;');
    $query->execute(array('tuote_id' => $this->tuote_id, 
                          'new_tuotteen_nimi' => $this->tuotteen_nimi, 
                          'new_kuvaus' => $this-> kuvaus,
                          'new_valmistaja' => $this ->valmistaja, 
                          'new_lukumaara' => $this ->lukumaara,
                          'new_history_date' => $this->history_date
                          )); 
  }
  
  public function validate_tuotteen_nimi(){
    $errors = array();
    if($this->tuotteen_nimi == '' || $this->tuotteen_nimi == null){
      $errors[] = 'Nimi ei saa olla tyhjä!';
    } // end of if
    
    if(strlen($this->tuotteen_nimi) < 2){
      $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä!';
    } // end of if

    return $errors;
  } // The end of validate_tuotteen_nimi 
} // The end of class
