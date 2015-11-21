<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VarastoController
 *
 * @author rotsten
 */
class VarastoController {
       
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

      //$varastotilanne = Varasto::all();
      //View::make('Varasto/Varastonlistaus.html', array('varastotilanne' => $varastotilanne));
      View::make('Varasto/Varastotilanteenmuutos.html', array('Varastotilanne' => $muutettava_varastotilanne));
  
    }  // end of varasto_edit
  
    public static function varasto_edit_post($tuote_id){
     
       $uudet_tiedot = $_POST; 
       
       /*
        * Asetetaan päivämäärä ja timestamp. 
        * Olisi järkevää, jos tämä tulisi aina automaattisesti.
        */
       
       /* 
        * Mikäli lukumäärää ei ole annettu, asetetaan arvoksi 
        * nolla FFFF:n sijasta.
        */
       if (empty($uudet_tiedot['lukumaara'])){
        $uudet_tiedot['lukumaara'] = 0;
       } 
        
        //Luodaan uusi tuote, jolla kutsutaan modifya...

        $muuttujat= array(
          'tuote_id' => $uudet_tiedot['tuote_id'],
          'tuotteen_nimi' => $uudet_tiedot['tuotteen_nimi'],
          'kuvaus'=> $uudet_tiedot['kuvaus'], 
          'valmistaja'=> $uudet_tiedot['valmistaja'],
          'lukumaara' => $uudet_tiedot['lukumaara'],
          'history_date'=> $uudet_tiedot['history_date']
        );
        
     // Käyttäjän nimi saadaan automaattisesti
     $uudet_tiedot['kayttajatunnus'] = base_controller::get_user_logged_in();
     
     $muuttujat = array(
       'tuote_id' => $uudet_tiedot['tuote_id'], 
       'kayttajatunnus' => $kayttajatunnus, 
       'lukumaara' => $uudet_tiedot['lukumaara']
       );

     $varastotilanne = new Varasto($muuttujat);
     //$errors = $Varasto->errors();
    
     $varastotilanne ->modify();
    
     // Listataan varastotiedot, jotta muutos näkyy
     $varastotilanne = Varasto::all();
     View::make('Varasto/Varastonlistaus.html', array('varastotilanne' => $varastotilanne));
    
  }  // end of varasto_edit_post
} // The end
