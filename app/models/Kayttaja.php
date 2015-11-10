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
  
/* 
 * Tietokantasovellus harjoitustyö, 2015 
 *  Kirsi Rotstén 
 *
 * This script receives two values from Home.html:
 * These are: käyttäjätunnus & salasana 
 * Returns the text, whether fields are empty or not.
 * Later add also other mechanisms to check the validity of the inputs... 
 */

public static function handle_login ($submit){

    // Success-flag setting
    $okay = TRUE;
   
    // Tsekkaa antoiko käyttäjä käyttäjätunnuksen:
    if (empty($submit['user_id'])) {
            print '<p class="error">Anna käyttäjätunnus.</p>';
            $okay = FALSE;
    }

    // Tsekkaa antoiko käyttäjä salasanan:
    if (empty($submit['password'])) {
            print '<p class="error">Anna salasana.</p>';
            $okay = FALSE;
    }
    /* Pitäisi tarkastella Käyttäjä-taulun tiedoista myös, löytyykö käyttäjä */

    if ($okay) {
        // print '<p>Onnistunut kirjautuminen.</p>';
        $query = DB::connection()->prepare ('SELECT * KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus and salasana = $salasana;');
        return TRUE;
    }
    else
    {
        //print '<p>Yritä uudelleen.</p>';
        return FALSE;
    } // end of if-else
} // end of function
  
  public static function kayttaja_list(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $Kayttajat = array();

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
    return $Kayttajat;
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
      $Found_Kayttaja = new Kayttaja(array(
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'kayttooikeus' => $row['kayttooikeus']
      ));
      
      return $Found_Kayttaja;
    } // end of if
  } // db_search_kayttaja ($kayttajatunnus) 
  
} // end of class

