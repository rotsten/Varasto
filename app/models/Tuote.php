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
  public $tuote_id, $tuotteen_nimi, $valmistaja, $tuotekuvaus;
  
  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
  }
  
  /*
  public function __construct($tuote_id, $tuotteen_nimi){
    // vain tuotteen pakolliset tiedot
    $this->tuote_id = $tuote_id;
    $this->tuotteen_nimi = $tuotteen_nimi;
  }
  
  public function __construct($tuote_id, $tuotteen_nimi, $valmistaja, $tuotekuvaus){
    // Kun annetaan kaikki tiedot
    $this->tuote_id = $tuote_id;
    $this->tuotteen_nimi = $tuotteen_nimi;
    $this->valmistaja = $valmistaja;
    $this->tuotekuvaus = $tuotekuvaus;
  }
  */
  
  public static function tuote_list(){
    // Alustetaan kysely tietokantayhteydellämme
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
        'tuotteennimi' => $row['tuotteennimi'],
        'valmistaja' => $row['valmistaja'],
        'tuotekuvaus' => $row['tuotekuvaus'],
        'added' => $row['added']
      ));
    } // end of foreach
    return $tuotteet;
  }  // end of tuote_list

 /*
    // Toinen yritelmä samasta teemasta
  
    public static function db_list_tuote(){
        $query = DB::connection()->prepare('SELECT * FROM TUOTE');
        $query->execute(array('tuote_id' => $tuote_id));
        $Tuotteet = new array(Tuote);

        $Tuotteet = $query->fetchAll('tuote_id', 'tuotteennimi', 'valmistaja');
      return $Tuotteet;
  } // end of db_list_tuote
  
 */
  
  // olioon liittyvät julkiset metodit
  public function edit($tuotteen_nimi, $valmistaja, $tuotekuvaus){
    // Tuote-id on hakuavain ja sitä ei voi editoida
    $this->tuotteen_nimi = $tuotteen_nimi;
    $this->valmistaja = $valmistaja;
    $this->tuotekuvaus = $tuotekuvaus;
  }     
  
  public function search ($tuote_id, $tuotteen_nimi){
      $tulos=0;
      
      if ($tuote_id != 0) {
        $tulos -> $this->db_search_tuote_id ($tuote_id);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat    
      }
      else {
        $tulos -> $this->db_search_tuotteennimi($tuotteen_nimi);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat
      }
      return $tulos;
  }
 
  public static function db_search_tuote_id($tuote_id){
    $query = DB::connection()->prepare('SELECT * FROM TUOTE WHERE tuote_id = :tuote_id LIMIT 1');
    $query->execute(array('tuote_id' => $tuote_id));
    $row = $query->fetch();

    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteennimi' => $row['tuotteennimi'],
        'valmistaja' => $row['valmistaja'],
        'tuotekuvaus' => $row['tuotekuvaus'],
        'added' => $row['added']
      ));
      
      return $tuote;
    } // end of if
  } // end of db_search_tuote_id
  
  public static function db_search_tuotteennimi($tuotteennimi){
      
      /*
       * Hakutulosta pitäisi laajentaa niin, että se listaisi useampia tuotteita.
       * Myös ne, joiden nimessä annettu sana esiintyy, ei vain niitä, jotka 
       * täydellisesti täyttävät hakuehdon.
       */
    
    $query = DB::connection()->prepare('SELECT Tuote_id, tuotteen_nimi, valmistaja, tuotekuvaus, lukumaara FROM TUOTE WHERE tuotteen_nimi = $tuotteennimi LIMIT 1');
    $query->execute(array('tuotteenimi' => $tuotteennimi));
    $row = $query->fetch();

    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteennimi' => $row['tuotteennimi'],
        'valmistaja' => $row['valmistaja'],
        'tuotekuvaus' => $row['tuotekuvaus'],
        'lukumaara' => $row['lukumaara'],
        'added' => $row['added']
      ));
     
      return $tuote;
    } // end of if
    return null;
  } // end of db_search_tuotteennimi
  
  /*
  public static function db_lisaa_tuote($tuote_id, $tuotteennimi, $valmistaja, $tuotekuvaus, $lukumaara){
     
     // Voisi lisätä joitain tsekkauksia, että annettu data on ok.
     // Luodaan annettuja arvoja käyttäen uusi tuote.
      
     $uusi_tuote = new Tuote ($tuote_id, $tuotteennimi, $valmistaja, $tuotekuvaus, $lukumaara
     
    $query = DB::connection()->prepare('INSERT INTO TUOTE values $tuote_id, $tuotteennimi, $valmistaja, $tuotekuvaus, $lukumaara');
  
     
     return uusi_tuote;
  }*/
  
} // end of class