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
  /* 
   * Käyttöoikeudet voi myöhemmin olla taulukko, jossa on tarkemmin eriteltynä, 
   * mitä tälle käyttäjälle sallitaan.
   */ 

  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
      
      // tsekataan datojen oikeellisuus
        $this->validators = array(
          'validate_kayttajatunnus', 
          'validate_salasana',
          'validate_etunimi',
          'validate_kayttooikeudet');
  }
  
  public static function all(){
    /* 
     * Alustetaan kysely tietokantayhteydellämme
     * Listataan kaikki KAYTTAJA-tauluun lisätyt
     * käyttäjät käyttäjätunnuksen mukaan laskevasti
     * aakkosjärjestykseen. 
     */
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA ORDER BY KAYTTAJATUNNUS');
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
        'kayttooikeudet' => $row['kayttooikeudet']
      ));
    } // end of foreach
    return $kayttajat;
  }  // end of kayttaja_list
  
  public static function all_with_paging($page, $page_size){
    /*
     * Tämä funktio hakee kaikki tuotteet tietokannasta ja
     * palauttaa ne Tuotteet -nimisessä taulukossa
     */
    
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA ORDER BY KAYTTAJATUNNUS LIMIT :limit OFFSET :offset');
    // Suoritetaan kysely
    $query->execute(array('limit' => $page_size, 'offset' => $page_size * ($page-1)));
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    
    $tuotteet = array();

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
  } // end of function all
  
  public function count (){
      
    $query = DB::connection()->prepare('SELECT COUNT(kayttajatunnus) FROM KAYTTAJA');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit, taulukkomuodossa
    //$tulos = $query->fetchAll();
    $count = $query->fetchColumn(0); 
    
    // Paluttaa, kuinka monta riviä taulussa oli dataa
    return $count;
  }
  
  public static function edit($salasana, $etunimi, $sukunimi, $kayttooikeudet){
    // Käyttäjätunnusta ei voi editoida
    $this->salasana = $salasana;
    $this->etunimi = $etunimi;
    $this->sukunimi = $sukunimi;
    $this->kayttooikeudet = $kayttooikeudet;
  }     
  
  public static function find($kayttajatunnus){
      
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA WHERE kayttajatunnus = :kayttajatunnus LIMIT 1');
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
  
  /*
   public static function kayttaja_find ($kayttajatunnus){
      
    $query = DB::connection()->prepare ('SELECT * KAYTTAJA WHERE kayttajatunnus = :kayttajatunnus LIMIT 1');
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
  */
  
  public function save(){
    
  $query = DB::connection()->prepare('INSERT INTO KAYTTAJA (kayttajatunnus,
            salasana, etunimi, sukunimi, kayttooikeudet)
            VALUES (:kayttajatunnus, :salasana, :etunimi, :sukunimi, :kayttooikeudet)');
   
  $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 
                        'salasana' => $this->salasana,
                        'etunimi' => $this->etunimi, 
                        'sukunimi' => $this->sukunimi,
                        'kayttooikeudet' => $this->kayttooikeudet
                        ));      
  } // end of save
  
  public function modify () {
                   
    $query = DB::connection()->prepare ('UPDATE KAYTTAJA SET salasana = :new_salasana,
                                                             etunimi = :new_etunimi,
                                                             sukunimi = :new_sukunimi,
                                                             kayttooikeudet = :new_kayttooikeudet WHERE kayttajatunnus =:kayttajatunnus;');
    $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 
                          'new_salasana' => $this->salasana,
                          'new_etunimi' => $this->etunimi, 
                          'new_sukunimi' => $this->sukunimi,
                          'new_kayttooikeudet' => $this->kayttooikeudet
                          )); 
  } // end of modify
  
  public function destroy () {
                   
    $query = DB::connection()->prepare ('DELETE FROM KAYTTAJA WHERE kayttajatunnus =:kayttajatunnus');
    $query->execute(array('kayttajatunnus' => $this->kayttajatunnus));                  
  } // end of destroy
   
  public function validate_kayttajatunnus(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi kayttajatunnuksen pitää olla ainakin 4 merkkiä
     * pitkä.
     */
        
     $errors_kayttajatunnus = array();
     if($this->kayttajatunnus == '' || $this->kayttajatunnus == null){
        $errors_kayttajatunnus[] = 'Jätit käyttäjätunnuksen antamatta!';
     }
     if(strlen($this->kayttajatunnus) < 4){
       $errors_kayttajatunnus[] = 'Kayttajatunnuksen pitää olla vähintään 4 merkkiä pitkä';
     } 
     
     if(strlen($this->kayttajatunnus) > 8){
       $errors_kayttajatunnus[] = 'Kayttajatunnus ei saa olla yli 8 merkkiä pitkä';
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
        $errors_salasana[] = 'Jätit salasanan antamatta!';
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
        $errors_etunimi[] = 'Jätit etunimen antamatta!';
     }
     /*
      * Koska 1 merkki voi olla ihmisen nimi, ei oikeastaan voi määrittää
      * kuinka pitkä nimen kuuluu olla. Mikä vain nollsta poikkeava käy.
      * Myöhemmin voisi lisätä tänne erikoismerkkien tsekkaamisen. Ne eivät
      * kuulu nimeen. 
      */                            
     return $errors_etunimi;
  } // End of validate_etunimi
  
  public function validate_kayttooikeudet(){
        
    /* Tarkistaa, onko annettu käyttöoikeus -tieto on "t", "T", "f" tai "F". 
     * Listauksessa arvona on 1 tai 0... 
     */
        
    $errors_kayttooikeudet = array();
    if($this->kayttooikeudet == '' || $this->kayttooikeudet == null){
        $this->kayttooikeudet =false;
    }
    
    if($this->kayttooikeudet != true && 
       $this->kayttooikeudet != false)
    {
       $errors__kayttooikeudet[] = 'Virheellinen käyttöoikeustieto annettu!';
    }
                                
    return $errors_kayttooikeudet;
  }
  
  public function errors(){
    // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        
    /* Metodi, joka kutsuu näitä kaikkia validointimetoja ja kokoaa 
     * niiden palauttamat virheilmoitukset yhdeksi taulukoksi. 
     * 
     * Validators:
     * =========== 
     * -validate_kayttajatunnus(), 
     * -validate_salasana(), 
     * -validate_etunimi(), 
     * -validate_kayttooikeudet();
     */
        
    $errors = array();  
    $errors = $this->validate_kayttajatunnus();
    $errors = array_merge($errors, $this->validate_salasana());
    $errors = array_merge($errors, $this->validate_kayttooikeudet());
    $errors = array_merge($errors, $this->validate_etunimi()); 
    
    return $errors;
  }
} // THE END of class KAYTTAJA

