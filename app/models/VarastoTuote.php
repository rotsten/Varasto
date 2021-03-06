<?php

/*
 * Koontitaulua VARASTO_TUOTE halllinnoiva olio. 
 */

/*
 * Description of VARASTO_TUOTE
 *
 * @author rotsten
 */

class VarastoTuote extends BaseModel{
    
   // attribuutit
  public $varasto_id, $tuote_id, $lukumaara;
  
  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
      
      $this->validators = array(
      'validate_lukumaara');
  }
  
  public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
     
    $query = DB::connection()->prepare('SELECT * FROM VARASTO_TUOTE;');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $varasto_tuote = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){

      $varasto_tuote[] = new Varasto_tuote(array(
        'varasto_id' => $row['varasto_id'],
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara']
      ));   
    } // end of foreach
    
    return $varasto_tuote;
  }
  
  public static function all_in_varasto($varasto_id){
      
    //Tulostaa kaikki tuotteet, jotka ovat tietyssä varastossa      
    $query = DB::connection()->prepare('SELECT * FROM VARASTO_TUOTE WHERE varasto_id = :varasto_id;');
    
    // Suoritetaan kysely
    $query->execute(array('varasto_id' => $varasto_id));
    //$query->execute;
    
    // Haetaan kyselyn tuottamat rivit
    $varaston_tuote_idt = $query->fetchAll();
    
     // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      $varaston_tuote_idt[] = new Varasto_tuote(array(
        'varasto_id' => $row['varasto_id'],
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara']
      ));
             
    } // end of foreach
    return $varaston_tuote_idt;
  } // all_in_varasto($varasto_id)
   
  public static function all_in_varasto_join_tuote($varasto_id){
    /* Tulostaa kaikki tuotteet ja niiden tuotetiedot, 
     * jotka ovat tietyssä varastossa.
     */  
    
    $query = DB::connection()->prepare('SELECT * FROM varasto_tuote 
      RIGHT JOIN tuote ON varasto_tuote.tuote_id = tuote.tuote_id
      WHERE varasto_id = :varasto_id;');
    
    // ORDER BY TUOTE.tuotteen_nimi
    
    $query->execute(array('varasto_id' => $varasto_id));
    // Haetaan kyselyn tuottamat rivit

    $rows = $query->fetchAll();
    $varaston_tuotetiedot = array();
    
    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      $varaston_tuotetiedot[] = (array(
        'varasto_id' => $row['varasto_id'],
        'tuote_id' => $row['tuote_id'],
        'tuotteen_nimi' => $row['tuotteen_nimi'], 
        'valmistaja' => $row['valmistaja'],
        'kuvaus' => $row['kuvaus'], 
        'lukumaara' => $row['lukumaara']
       ));
    } // end of foreach
    
    return $varaston_tuotetiedot;
  } // all_in_varasto($varasto_id)
  
  public static function certain_varasto_join_certain_tuote($varasto_id, $tuote_id){    
    /* Tulostaa tuotteen tuotetiedot + lukumäärä niistä, 
     * jotka ovat tietyssä varastossa.
     */  
    
      // Ensin etsitään kaikki, jotka ovat oikeassa varastossa
    $query = DB::connection()->prepare('SELECT * FROM varasto_tuote 
      LEFT JOIN tuote ON varasto_tuote.tuote_id = tuote.tuote_id
      WHERE tuote.tuote_id = :tuote_id AND varasto_tuote.varasto_id = :varasto_id');
        
    // Suoritetaan kysely
    $query->execute(array('varasto_id' => $varasto_id,
                          'tuote_id' => $tuote_id
                          ));
    
    // Haetaan kyselyn tuottamat rivit
    $row = $query->fetch();

    if (!empty($row)) {
      $varastotuote = array(
        'varasto_id' => $varasto_id,
        'tuote_id' => $tuote_id,
        'tuotteen_nimi' => $row['tuotteen_nimi'], 
        'valmistaja' => $row['valmistaja'],
        'kuvaus' => $row['kuvaus'], 
        'lukumaara' => $row['lukumaara'],
        'history_date' => $row['history_date']
      );

      return $varastotuote;            
    } // end of if 
  } // all_in_varasto($varasto_id)

  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Varasto_Tuote
      (varasto_id, tuote_id, lukumaara)
      VALUES (:varasto_id, :tuote_id, :lukumaara)');
   
    $query->execute(array(
      'varasto_id' => $this->varasto_id,
      'tuote_id' => $this->tuote_id, 
      'lukumaara' => $this->lukumaara 
    ));      
  }
  
  public function modify () {
                    
    $query = DB::connection()->prepare(
      'UPDATE VARASTO_TUOTE SET 
       varasto_id = :varasto_id,
       lukumaara = :new_lukumaara WHERE tuote_id = :tuote_id');
    
    $query->execute(array(
      'varasto_id' => $this->varasto_id,   
      'tuote_id' => $this->tuote_id, 
      'new_lukumaara' => $this->lukumaara
    )); 
  }
  
  public function destroy () {
    
    Kint::dump($this->tuote_id);
    
    $query = DB::connection()->prepare ('DELETE FROM VARASTO_TUOTE WHERE tuote_id =:tuote_id AND varasto_id =:varasto_id');
    $query->execute(array('tuote_id' => $this->tuote_id,
                          'varasto_id' => $this->varasto_id));                  
  }
  
  public function validate_lukumaara(){     
    /* Tarkistaa, onko annettu merkkijono sisältää vain numeroita.
     * Lukumäärän antaminen ei ole välttämätöntä.
     */
        
     $errors_lukumaara = array();
      
     // tarkistaa, että sisältää vain numeroita
     if (is_numeric($this->lukumaara)) {
       // annettu
       if ($this->lukumaara < 0) {
           $errors_lukumaara[] = 'lukumäärä on aina positiivinen kokonaisluku!'; 
       }
     } 
     else {
         $errors_lukumaara[] = 'Lukumäärä ei saa sisältää muita merkkejä kuin numeroita!';
     }  
       
     return $errors_lukumaara;
  } // validate_lukumaara()
  
  public function errors(){
    // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        
    /* Metodi, joka kutsuu näitä kaikkia validointimetoja ja kokoaa 
     * niiden palauttamat virheilmoitukset yhdeksi taulukoksi. 
     * 
     * Validators:
     * =========== 
     * -validate_lukumaara
     */
        
    $errors = array();      
    $errors = $this->validate_lukumaara(); 
   
    return $errors;
  }
} // end of class
