<?php

/*
 * Tämä oli on eri varastojen hallinnointiin. 
 * Tuotteita voi olla säilytettynä 1-n:ään varastoon ja 
 * jokaisessa varastossa voi olla (tietysti) monia eri 1-n 
 * tuotearikkeileita (ja niitä voi olla kappalemääräisesti 0-n).
 */

/**
 * Description of Varasto
 *
 * @author rotsten
 */
class Varasto extends BaseModel{
    
   // attribuutit
  public $varasto_id, $nimi, $osoite;
  
  // Myöhemmin voidaan lisätä lisää attribuutteja, kuten vaikka osoite
  // Tai jokin kenttä kuvaukselle tai kommenteille.
  
  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
  }
  
  public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
     
    $query = DB::connection()->prepare('SELECT * FROM VARASTO ORDER BY NIMI;');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $varastotilanne = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      $varastotilanne[] = new Varasto(array(
        'varasto_id' => $row['varasto_id'],
        'nimi' => $row['nimi'],
        'osoite' => $row['osoite']
      ));
             
    } // end of foreach
    
    return $varastotilanne;
  }
  
  public function count (){
      
    $query = DB::connection()->prepare('SELECT COUNT(varasto_id) FROM VARASTO');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit, taulukkomuodossa
    //$tulos = $query->fetchAll();
    $count = $query->fetchColumn(0); 
    
    // Paluttaa, kuinka monta riviä taulussa oli dataa
    return $count;
  }
  
    public static function all_with_paging($page, $page_size){
    /*
     * Tämä funktio hakee kaikki tuotteet tietokannasta ja
     * palauttaa ne Tuotteet -nimisessä taulukossa
     */
          
    $query = DB::connection()->prepare('SELECT * FROM VARASTO ORDER BY NIMI :limit OFFSET :offset');
    // Suoritetaan kysely
    $query->execute(array('limit' => $page_size, 'offset' => $page_size * ($page-1)));
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    
    $tuotteet = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      $varastotilanne[] = new Varasto(array(
        'varasto_id' => $row['varasto_id'],
        'nimi' => $row['nimi'],
        'osoite' => $row['osoite']
      ));
             
    } // end of foreach
   
    return $varastotilanne; // Tuotteet on Tuote-olioiden kokoelma
  } // end of function all
  
  
  public static function getNimiById ($varasto_id) {
  
    $query = DB::connection()->prepare('SELECT nimi FROM VARASTO WHERE varasto_id = :varasto_id LIMIT 1');
    $query->execute(array('varasto_id' => $varasto_id));
    $varastonnimi = $query->fetch();
    
    return $varastonnimi;          
  }
  
  public static function find($varasto_id){
     
    $query = DB::connection()->prepare('SELECT * FROM VARASTO WHERE varasto_id = :varasto_id LIMIT 1');
    $query->execute(array('varasto_id' => $varasto_id));
    $row = $query->fetch();
    if($row){
      $varasto = new Varasto(array(
        'varasto_id' => $row['varasto_id'],
        'nimi' => $row['nimi'],
        'osoite' => $row['osoite']
      ));
    
      //Kint::dump($tuote);
      return $varasto;
            
     } // end of if
  } // end of find_tuote (tuote_id)
  
  public function save () {
      
    $query = DB::connection()->prepare('INSERT INTO VARASTO (varasto_id, nimi, osoite)
            VALUES (:varasto_id, :nimi, :osoite)');
   
     $query->execute(array('varasto_id' => $this->varasto_id, 
                           'nimi' => $this->nimi, 
                           'osoite' => $this->osoite
                           ));      
  }
  
  public function modify () {
                
    $query = DB::connection()->prepare ('UPDATE VARASTO SET nimi = :new_nimi, 
                                                            osoite =:new_osoite WHERE varasto_id =:varasto_id;');
    $query->execute(array('varasto_id' => $this->varasto_id, 
                          'new_nimi' => $this->nimi,
                          'new_osoite' => $this->osoite
                          )); 
  }
  
  public function destroy () {
    
    Kint::dump($this->varasto_id);
    
    $query = DB::connection()->prepare ('DELETE FROM VARASTO WHERE varasto_id =:varasto_id');
    $query->execute(array('varasto_id' => $this->varasto_id));                  
  }
  
  public function validate_varaston_nimi(){
        
    /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
     * Esimerkiksi merkkijonon pitää olla ainakin 3 merkkiä
     * pitkä.
     */
        
    $errors_varaston_nimi = array();
    if($this->nimi == '' || $this->nimi == null){
       $errors_varaston_nimi[] = 'Jätit varaston nimen antamatta!';
    }
    if(strlen($this->nimi) < 3){
      $errors_varaston_nimi[] = 'Varaston nimen pitää olla vähintään 3 merkkiä pitkä!';
    }                                   
    return $errors_varaston_nimi;
  }
  
  public function errors(){
       
    $errors = array();
    $errors = $this->validate_varaston_nimi(); 
   
    return $errors;
  }
} // end of class


