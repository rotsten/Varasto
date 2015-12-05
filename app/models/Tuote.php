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
  public $tuote_id, $tuotteen_nimi, $valmistaja, $kuvaus, $history_date;
  
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
      'validate_valmistaja');
  }
  
  public function count (){
      
    $query = DB::connection()->prepare('SELECT COUNT(tuote_id) FROM TUOTE');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit, taulukkomuodossa
    //$tulos = $query->fetchAll();
    $count = $query->fetchColumn(0); 
    
    //$count = $tulos[0];
    //Kint::dump($count);
    
    // Paluttaa, kuinka monta riviä taulussa oli dataa
    return $count;
  }
  
  public static function all_with_paging($page, $page_size){
    /*
     * Tämä funktio hakee kaikki tuotteet tietokannasta ja
     * palauttaa ne Tuotteet -nimisessä taulukossa
     */
          
    $query = DB::connection()->prepare('SELECT * FROM TUOTE ORDER BY TUOTTEEN_NIMI LIMIT :limit OFFSET :offset');
    // Suoritetaan kysely
    $query->execute(array('limit' => $page_size, 'offset' => $page_size * ($page-1)));
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
          'history_date' => $row['history_date']
       ));
    } // end of foreach
   
    //$tuotteet = ksort($tuotteet);
    return $tuotteet; // Tuotteet on Tuote-olioiden kokoelma
  } // end of function all
  
  public static function all(){
    /*
     * Tämä funktio hakee kaikki tuotteet tietokannasta ja
     * palauttaa ne Tuotteet -nimisessä taulukossa
     */
          
    $query = DB::connection()->prepare('SELECT * FROM TUOTE ORDER BY TUOTTEEN_NIMI');
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
          'history_date' => $row['history_date']
       ));
    } // end of foreach
   
    //$tuotteet = ksort($tuotteet);
    return $tuotteet; // Tuotteet on Tuote-olioiden kokoelma
  } // end of function all
  
  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Tuote (tuote_id,
            tuotteen_nimi, kuvaus, valmistaja, history_date)
            VALUES (:tuote_id, :tuotteen_nimi, :kuvaus, :valmistaja, 
            :history_date)');
   
     $query->execute(array('tuote_id' => $this->tuote_id, 
                           'tuotteen_nimi' => $this->tuotteen_nimi, 
                           'kuvaus' => $this->kuvaus,
                           'valmistaja' => $this->valmistaja, 
                           'history_date' => $this->history_date
                           ));      
  }
  
  public function modify () {
                    
    $query = DB::connection()->prepare('UPDATE TUOTE SET tuotteen_nimi = :new_tuotteen_nimi,
                                                         valmistaja = :new_valmistaja,
                                                         kuvaus = :new_kuvaus,
                                                         history_date = :new_history_date WHERE tuote_id =:tuote_id;');
    $query->execute(array('tuote_id' => $this->tuote_id, 
                          'new_tuotteen_nimi' => $this->tuotteen_nimi, 
                          'new_kuvaus' => $this->kuvaus,
                          'new_valmistaja' => $this->valmistaja, 
                          'new_history_date' => $this->history_date
                          )); 
  }
  
  public static function find($tuote_id){
      
    /* 
     * Kutsutaan, kun etsitään tarkkoja tuotetietoja
     */
    
    $query = DB::connection()->prepare('SELECT * FROM TUOTE WHERE tuote_id = :tuote_id LIMIT 1');
    
    $query->execute(array('tuote_id' => $tuote_id));
    $row = $query->fetch();
    
    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteen_nimi' => $row['tuotteen_nimi'],
        'kuvaus' => $row['kuvaus'],  
        'valmistaja' => $row['valmistaja']
      ));
    
      return $tuote;
            
    } // end of if
  } // end of find_tuote (tuote_id)

  public function find_tuotteen_nimi($tuotteen_nimi){
      
    $tuotteen_nimi = "%$tuotteen_nimi%";
        
    $query = DB::connection()->prepare('SELECT * FROM TUOTE WHERE (tuotteen_nimi) LIKE :tuotteen_nimi');
    $query->execute(array('tuotteen_nimi' => $tuotteen_nimi));
    $rows = $query->fetchAll();
    
    if ($rows){
      foreach($rows as $row){
        $tuotteet[] = new Tuote (array(
          'tuote_id' => $row['tuote_id'],
          'tuotteen_nimi' => $row['tuotteen_nimi'],
          'valmistaja' => $row['valmistaja'],
          'kuvaus' => $row['kuvaus']
        )); 
      } // end of for
          
      return $tuotteet;
    } // end of if
    
    // Jos ei löytynyt
    return null;
  } // end of find_tuotteen_nimi
  

  public function destroy () {
    
    Kint::dump($tuote_id);
    $query = DB::connection()->prepare ('DELETE FROM TUOTE WHERE tuote_id =:tuote_id');
    $query->execute(array('tuote_id' => $this->tuote_id));                  
  }
  
  public function validate_tuote_id($flag){
        
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
    
    if ($flag == true) {
        /* 
         * Tarkistaa ettei ID ole jo käytössä. Tämä tsekkaus on ainoastaan 
         * LISÄYS-komentoa varten. 
         */ 
      if (NULL !=($etsittava_tuote = Tuote::find($this->tuote_id))) {

        return $errors_tuote_id[]= 'Tuote-id on jo varattu!';
      } // end of if 
    } // end of if
    return $errors_tuote_id;
  }
  

  public function validate_tuotteen_nimi(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi merkkijonon pitää olla ainakin 3 merkkiä
     * pitkä.
     */
        
    $errors_tuotteen_nimi = array();
    if($this->tuotteen_nimi == '' || $this->tuotteen_nimi == null){
       $errors_tuotteen_nimi[] = 'Jätit tuotteen nimen antamatta!';
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
        $errors_valmistaja[] = 'Jätit valmistajan antamatta!';
     }
     if(strlen($this->valmistaja) < 2){
       $errors_valmistaja[] = 'Tuotteen valmistajan nimen pitää olla vähintään 2 merkkiä pitkä!';
     }                                   
     return $errors_valmistaja;
  }
                
  public function errors($flag){
    // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        
    /* Metodi, joka kutsuu näitä kaikkia validointimetoja ja kokoaa 
     * niiden palauttamat virheilmoitukset yhdeksi taulukoksi. 
     * 
     * Validators:
     * =========== 
     * -validate_tuote_id(), 
     * -validate_tuotteen_nimi(), 
     * -validate_valmistaja()
     */
        
    $errors = array();
      
    $errors = $this->validate_tuote_id($flag);
    $errors = array_merge($errors, $this->validate_tuotteen_nimi());
    $errors = array_merge($errors, $this->validate_valmistaja());  
   
    return $errors;
  }
} // THE END of class
