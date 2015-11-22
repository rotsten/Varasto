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
      
      /* Validoidaan annetut syötteet
       * 
       * Kuvaus on vapaamuotoinen tieto ja sen antaminen on vapaaehtoista.
       * Näistä syistä syötettä ei validoida. 
       * 
       * Lukumäärä- tieto validoidaan. Tarkastetaan, että syöte on luku. 
       * On myös ajatus edelleen muuttaa toteutuksen rakenteita siten, että 
       * lukumäärä olisi vain Varasto-oliossa.
       * 
       * History-date tietoa ei validoida, koska on edelleen aikomus saada
       * tämän tieto automaattisesti tietokantaan.    
       */
      $this->validators = array(
          'validate_tuote_id', 
          'validate_tuotteen_nimi', 
          'validate_valmistaja', 
          'validate_lukumaara');
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
    return $tuotteet; // Tuotteet on Tuote-olioiden kokoelma
  } // end of function all
  
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
  
  public static function find($tuote_id){
      
    /* 
     * Kutsutaan, kun etsitään tarkkoja tuotetietoja
     */
    //Kint::dump($tuote_id);
    
    $query = DB::connection()->prepare('SELECT * FROM TUOTE WHERE tuote_id = :tuote_id LIMIT 1');
    $query->execute(array('tuote_id' => $tuote_id));
    $row = $query->fetch();
    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteen_nimi' => $row['tuotteen_nimi'],
        'kuvaus' => $row['kuvaus'],  
        'valmistaja' => $row['valmistaja'],
        'lukumaara' =>$row['lukumaara']
      ));
    
      //Kint::dump($tuote);
      return $tuote;
            
     } // end of if
  } // end of find_tuote (tuote_id)
  
  /*
   * Ei toistaiseksi käytössä
   *
  public function find_tuotteen_nimi($tuotteen_nimi){
      
      /*
       * Hakutulosta pitäisi laajentaa niin, että se listaisi useampia tuotteita.
       * Myös ne, joiden nimessä annettu sana esiintyy, ei vain niitä, jotka 
       * täydellisesti täyttävät hakuehdon.
       */
    /*
    $query = DB::connection()->prepare('SELECT tuote_id, tuotteen_nimi, valmistaja, tuotekuvaus, lukumaara FROM TUOTE WHERE tuotteen_nimi = $tuotteen_nimi LIMIT 1');
    $query->execute(array('tuotteen_nimi' => $tuotteen_nimi));
    $row = $query->fetch();
    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteen_nimi' => $row['tuotteen_nimi'],
        'valmistaja' => $row['valmistaja'],
        'kuvaus' => $row['kuvaus'],
        'lukumaara' => $row['lukumaara']
      ));
     
      return $tuote;
    } // end of if
    return null;
  } // end of find_tuotteen_nimi
  */

  public function destroy () {
                   
    $query = DB::connection()->prepare ('DELETE FROM TUOTE WHERE tuote_id =:tuote_id;');
    $query->execute(array('tuote_id' => $this->tuote_id));
                       
  }
  
 /*
  * Lisätään annettujen syötteiden validointifunktiot.
  *    -validate_tuote_id(), 
  *    -validate_tuotteen_nimi(), 
  *    -validate_valmistaja(), 
  *    -validate_lukumaara()
  */

  public function validate_tuote_id(){
        
   /* Tarkistaa, onko annettu merkkijono sisältää vain numeroita.
    * Merkkijonon pitää olla ainakin 5 merkkiä pitkä.
    */
        
    $errors_tuote_id = array();
    if($this->tuote_id == '' || $this->tuote_id == null){
       $errors_tuote_id[] = 'Tuote-id on pakollinen tieto!';
    }
     if(strlen($this->tuote_id) < 5){
       $errors_tuote_id[] = 'Tuote_id:n pitää olla vähintään 5 merkkiä pitkä!';
     } 
       
    // tarkistaa, että sisältää vain numeroita
    if (is_numeric($this->tuote_id)) {
      if ($this->tuote_id < 0) {
          $errors_tuote_id[] = 'Tuote-id on aina positiivinen kokonaisluku!'; 
      }
    } else {
        $errors_tuote_id[] = 'Tuote-id ei saa sisältää muita merkkejä kuin numeroita!';
    }  
       
    return $errors_tuote_id;
  }
              
  public function validate_tuotteen_nimi(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi merkkijonon pitää olla ainakin 3 merkkiä
     * pitkä.
     */
        
    $errors_tuotteen_nimi = array();
    if($this->tuotteen_nimi == '' || $this->tuotteen_nimi == null){
       $errors_tuotteen_nimi[] = 'Jätit tiedon antamatta!';
    }
    if(strlen($this->tuotteen_nimi) < 3){
      $errors_tuotteen_nimi[] = 'Tuotteen nimen pitää olla vähintään 3 merkkiä pitkä!';
    }                                   
    return $errors_tuotteen_nimi;
  }
    
  public function validate_valmistaja(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi merkkijonon pitää olla ainakin 3 merkkiä
     * pitkä.
     */
        
     $errors_valmistaja = array();
     if($this->valmistaja == '' || $this->valmistaja == null){
        $errors_valmistaja[] = 'Jätit tiedon antamatta!';
     }
     if(strlen($this->valmistaja) < 2){
       $errors_valmistaja[] = 'Tuotteen valmistajan nimen pitää olla vähintään 2 merkkiä pitkä!';
     }                                   
     return $errors_valmistaja;
  }
    
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
            
  public function errors(){
    // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        
    /* Metodi, joka kutsuu näitä kaikkia validointimetoja ja kokoaa 
     * niiden palauttamat virheilmoitukset yhdeksi taulukoksi. 
     * 
     * Validators:
     * =========== 
     * -validate_tuote_id(), 
     * -validate_tuotteen_nimi(), 
     * -validate_valmistaja(), 
     * -validate_lukumaara()
     *
     * Metodi tulee käyttöön kaikille sovellukseni malleille, joten 
     * se tulee lopullisessa toteutuksessa sijaitsemaan:
     * lib --> base_model.php-tiedostossa, 
     * jossa BaseModel-luokka sijaitsee. 
     * 
     * Lopullisessa versiossa metodi errors käy läpi validators-taulukon 
     * ja kutsuu sen sisältämiä validointimetodeja niiden nimellä.
     * 
     * Ensimmäiessä vaiheessa käytetään kovakoodattua versiota.
     */
        
    $errors = array();
      
    $errors = $this->validate_tuote_id();
    $errors = array_merge($errors, $this->validate_tuotteen_nimi());
    $errors = array_merge($errors, $this->validate_valmistaja());   
    $errors = array_merge($errors, $this->validate_lukumaara());
  
    return $errors;
  }
} // THE END of class
