<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Varasto
 *
 * @author rotsten
 */
class Varasto extends BaseModel{
    //put your code here
    
   // attribuutit
  public $tuote_id, $kayttajatunnus, $lukumaara;
  
  // konstruktori
  public function __construct ($attributes){
      parent::__construct($attributes);
  }
  
  public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
    $query = DB::connection()->prepare('SELECT * FROM VARASTO;');
    // Suoritetaan kysely
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $varastotilanne = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){

      $varastotilanne[] = new Varasto(array(
        'tuote_id' => $row['tuote_id'],
        'history_kuka_inventoi' => $row['history_kuka_inventoi']
      ));
    } // end of foreach
    
    return $varastotilanne;
  }   
  
  public static function index(){
    $varastotilanne = Varasto::all();
    View::make('varastotilanne/Varastotilanteenmuutos.html', array('varastotilanne' => $varastotilanne));
  }

  public static function varasto_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee varastotilanteen tietokannasta
     */
     $varastotilanne = Varasto::all();
     View::make('Varasto/Varastonlistaus.html', array('varastotilanne' => $varastotilanne));
    
  }  // end of varasto_list
  
  public static function varasto_edit($tuote_id){
    
    //Etsitään ensin tuote, mitä se koskee.
    $muutettava_varastotieto = TuoteController::find_tuote_with_tuote_id($tuote_id);
      
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee varastotilanteen tietokannasta
     */
      
     $varastotilanne = Varasto::all();
     View::make('Varasto/Varastonlistaus.html', array('varastotilanne' => $varastotilanne));
    
  }  // end of varasto_list
} // end of class


