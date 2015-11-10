<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kayttaja
 *
 * @author rotsten
 */
class Kayttaja extends BaseModel {
    
   // attribuutit
  public $kayttajatunnus, $salasana, $etunimi, $sukunimi, $kayttooikeus;
  

  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
  }
  
  /*
  public function __construct($kayttajatunnus, $salasana, $etunimi, $kayttooikeus){
    $this->kayttajatunnus = $kayttajatunnus;
    $this->salasana = $salasana;
    $this->etunimi = $etunimi;
    $this->kayttooikeus = $kayttooikeus; 
  }
  
  public function __construct($kayttajatunnus, $salasana, $etunimi, $sukunimi, $kayttooikeus){
    $this->kayttajatunnus = $kayttajatunnus;
    $this->salasana = $salasana;
    $this->etunimi = $etunimi;
    $this->sukunimi = $sukunimi;
    $this->kayttooikeus = $kayttooikeus;
  }
  */
  
  public static function kayttaja_list(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $kayttajat = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){

      $kayttajat[] = new Kayttaja(array(
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'kayttooikeus' => $row['kayttooikeus']
      ));
    } // end of foreach
    return $kayttajat;
  }  // end of kayttaja_list
  
  // olioon liittyvä julkinen metodi
  public function edit($salasana, $etunimi, $sukunimi, $kayttooikeus){
    // Käyttäjätunnusta ei voi editoida
    $this->salasana = $salasana;
    $this->etunimi = $etunimi;
    $this->sukunimi = $sukunimi;
    $this->kayttooikeus = $kayttooikeus;
  }     
  
  public static function db_search_kayttaja ($kayttajatunnus){
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus LIMIT 1');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus));
    $row = $query->fetch();

    if($row){
      $tuote = new Kayttaja(array(
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'kayttooikeus' => $row['kayttooikeus']
      ));
      
      return $kayttaja;
    } // end of if
  } // db_search_kayttaja ($kayttajatunnus) 
  
} // end of class

