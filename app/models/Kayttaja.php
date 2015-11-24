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
      
        $this->validators = array(
          'validate_kayttajatunnus', 
          'validate_salasana',
          'validate_etunimi');
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
  
  public static function edit($salasana, $etunimi, $sukunimi, $kayttooikeudet){
    // Käyttäjätunnusta ei voi editoida
    $this->salasana = $salasana;
    $this->etunimi = $etunimi;
    $this->sukunimi = $sukunimi;
    $this->kayttooikeudet = $kayttooikeudet;
  }     
  
  public static function find ($kayttajatunnus){
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA WHERE kayttajatunnus =:kayttajatunnus LIMIT 1');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus));
    $row = $query->fetch();
    
    if($row){
      // Käyttäjä löytyi!
      $Found_Kayttaja = new Kayttaja(array(
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'etunimi' => $row['etunimi'],
        'sukunimi' => $row['sukunimi'],
        'kayttooikeudet' => $row['kayttooikeudet']
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
  } // end of save
  
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
             
  public function validate_kayttajatunnus(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi kayttajatunnuksen pitää olla ainakin 4 merkkiä
     * pitkä.
     */
        
     $errors_kayttajatunnus = array();
     if($this->kayttajatunnus == '' || $this->kayttajatunnus == null){
        $errors_kayttajatunnus[] = 'Jätit tiedon antamatta!';
     }
     if(strlen($this->kayttajatunnus) < 4){
       $errors_kayttajatunnus[] = 'Kayttajatunnuksen pitää olla vähintään 4 merkkiä pitkä!';
     }                                   
     return $errors_kayttajatunnus;
  } // end of validate_kayttajatunnus
  
  public function validate_salasana(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi salasanan pitää olla ainakin 4 merkkiä
     * pitkä.
     */
        
     $errors_salasana = array();
     if($this->salasana == '' || $this->salasana == null){
        $errors_salasana[] = 'Jätit tiedon antamatta!';
     }
     if(strlen($this->salasana) < 4){
       $errors_salasana[] = 'Salasanan pitää olla vähintään 4 merkkiä pitkä!';
     }                                   
     return $errors_salasana;
  } // end of validate_salasana
  
    public function validate_etunimi(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi salasanan pitää olla ainakin 4 merkkiä
     * pitkä.
     */
        
     $errors_etunimi = array();
     if($this->etunimi == '' || $this->salasana == null){
        $errors_etunimi[] = 'Jätit tiedon antamatta!';
     }
     /*
      * Koska 1 merkki voi olla ihmisen nimi, ei oikeastaan voi määrittää
      * kuinka pitkä nimen kuuluu olla. Mikä vain nollsta poikkeava käy.
      * Myöhemmin voisi lisätä tänne erikoismerkkien tsekkaamisen. Ne eivät
      * kuulu nimeen. 
      */                            
     return $errors_etunimi;
  } // End of validate_etunimi
} // THE END of class KAYTTAJA

