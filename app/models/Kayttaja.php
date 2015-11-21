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
  public $kayttajatunnus, $salasana, $etunimi, $sukunimi, $kayttooikeudet; 

  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
  }
  
  public static function all(){
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
        'kayttooikeudet' => $row['kayttooikeudet']
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
  
  public static function find ($kayttajatunnus){
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus LIMIT 1');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus));
    $row = $query->fetch();
    
    if($row){
      // Käyttäjä löytyi!
      $Found_Kayttaja = new Kayttaja(array(
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'kayttooikeus' => $row['kayttooikeus']
      ));
      
      return $Found_Kayttaja;
    } 
    else
    {
        // Käyttäjää ei löytynyt
        return null;
    }// end of if
  } // Find(kayttajatunnus)
  
   public static function kayttaja_find ($kayttajatunnus){
  /*
   * Pitää ensin etsiä halutun käyttäjän tiedot tietokannasta.
   */
      
    $query = DB::connection()->prepare ('SELECT * KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus));
    $row = $query->fetch();

    if($row){
       $muutettava_kayttaja = new Kayttaja(array(
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'kayttooikeudet' => $row['kayttooikeudet']
      ));
    }
    return $kayttaja;
    
  } // end of kayttaja_find
  
  public function save(){
    
  $query = DB::connection()->prepare('INSERT INTO KAYTTAJA (kayttajatunnus,
            salasana, etunimi, sukunimi, kayttooikeudet)
            VALUES (:kayttajatunnus, :salasana, :etunimi, :sukunimi, :kayttooikeudet)');
   
  $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 
                        'new_salasana' => $this->salasana,
                        'new_etunimi' => $this->etunimi, 
                        'new_sukunimi' => $this->sukunimi,
                        'new_kayttooikeudet' => $this->kayttooikeudet
                        ));      
  } // ebd of save
  
  public function modify () {
                   
    $query = DB::connection()->prepare ('UPDATE KAYTTAJA SET salasana =: new_salasana,
                                                             etunimi =: new_etunimi,
                                                             sukunimi =: new_sukunimi,
                                                             kayttooikeudet =: new_kayttooikedet WHERE kayttajatunnus =:kayttajatunnus;');
    $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 
                          'new_salasana' => $this->salasana,
                          'new_etunimi' => $this->etunimi, 
                          'new_sukunimi' => $this->sukunimi,
                          'new_kayttooikeudet' => $this ->kayttooikeudet
                          )); 
  } // end of modify
  
} // THE END of class KAYTTAJA

