<?php

/*
 * Koontitaulua VARASTO_TUOTE halllinnoiva olio. 
 */

/**
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
      
    $query = DB::connection()->prepare('SELECT * FROM VARASTO_TUOTE WHERE varasto_id = :varasto_id');
        // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $varaston_tuote_idt = array();
    
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
      
    $query = DB::connection()->prepare('SELECT * FROM VARASTO_TUOTE 
                                        LEFT JOIN TUOTE
                                        ON VARASTO_TUOTE.tuote_id = TUOTE.tuote_id
                                        WHERE varasto_id = :varasto_id
                                        ORDER BY TUOTE.tuotteen_nimi;');
        // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $varaston_tuotetiedot = $query->fetchAll();

    return $varaston_tuotetiedot;
  } // all_in_varasto($varasto_id)
  
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
} // end of class
