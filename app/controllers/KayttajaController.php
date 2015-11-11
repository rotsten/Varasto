<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KayttajaController
 *
 * @author rotsten
 */
class KayttajaController {
    
    /*
    public static function index(){
       $kayttajat = Kayttaja::all();
       View::make('kayttajat/Kayttajienlistaus.html', array('kayttajat' => $kayttajat));
    } */
    
    public static function kayttaja_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee varastotilanteen tietokannasta
     */
         $kayttajat = Kayttaja::all();
         View::make('Kayttaja/Kayttajienlistaus.html', array('kayttajat' => $kayttajat));
     }  // end of kayttaja_list
    
    public static function kayttaja_find ($kayttajatunnus){
    /*
     * Pitää ensin etsiä halutun käyttäjän tiedot tietokannasta.
     */
         $query = DB::connection()->prepare ('SELECT * KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus');
         $query->execute(array('tuote_id' => $tuote_id));
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
    }  // end of kayttaja_find
     
    public static function kayttaja_edit($kayttajatunnus){
    /*
     * Pitää ensin etsiä halutun käyttäjän tiedot tietokannasta.
     */
         $muutettava_kayttaja = Kayttaja::find($kayttajatunnus);
         View::make('Kayttaja/Kayttajatietojenmuutos.html', $muutettava_kayttaja);
     }  // end of kayttaja_edit
}
