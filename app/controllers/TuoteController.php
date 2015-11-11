<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TuoteController
 *
 * @author rotsten
 */
class TuoteController extends BaseController{
 
  public static function tuote_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee kaikki tuotteet tietokannasta
     */
     $Tuotteet = Tuote::all();
     View::make('Tuote/Tuotteidenlistaus.html', array('Tuotteet' => $Tuotteet));
    
  }  // end of tuote_list

 /*
    // Toinen yritelmä samasta teemasta
  
    public static function db_list_tuote(){
        $query = DB::connection()->prepare('SELECT * FROM TUOTE');
        $query->execute(array('tuote_id' => $tuote_id));
        $Tuotteet = new array(Tuote);

        $Tuotteet = $query->fetchAll('tuote_id', 'tuotteennimi', 'valmistaja');
      return $Tuotteet;
  } // end of db_list_tuote
  
 */
  
  public function tallenna(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    
    $Uusi_tuote = new Tuote(array(
      'tuote_id' => $params['tuote_id'],  
      'tuotteen_nimi' => $params['tuotteen_nimi'],
      'valmistaja' => $params['valmistaja'],
      'kuvaus' => $params['kuvaus'],
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $Uusi_tuote->save();

    /* Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle. 
     * Sieltä voi mennä korjaamaan, mikäli jokin tieto meni ensimmäisellä 
     * kerralla väärin.
     */
    
    Redirect::to('/Tuote/Tuotesivu' . $Tuote_id->Tuote_id, $Uusi_tuote);
 
  }
  
  // olioon liittyvät julkiset metodit
  public function edit($tuote_id, $tuotteen_nimi, $valmistaja, $tuotekuvaus){
    
    /*
     *  Tuote-id on hakuavain. Sitä ei voi editoida.
     *  Lukumäärätietoa voisi varmaan päivittää myös tässäkin, mutta se vaatisi
     *  käyttäjäoikeuksien tarkastamista. On selkeämpää, jos koko tuotetietojenmuutos -sivu
     *  on inventointioikeuksilla estetty. --> Jatkokehityspohde.
     * 
     *  Muutoskomento vaatii myös attribuuttien aiempien tietojen
     *  antamista. Siispä ne pitää hakea
     */
  
    $temp_aiemmat_tuotetiedot = db_search_tuote_id($tuote_id);
  
    /*
     * UPDATE table
     *   SET column = REPLACE(column,old_text,new_text)
     *   WHERE condition
     */
    
    // Päivitetään tuotteen_nimi
    $temp_nimi = ($temp_aiemmat_tuotetiedot = $tuotteen_nimi);
    $query = DB::connection()->prepare ('UPDATE TUOTE SET tuotteen_nimi = REPLACE(temp_tuotteen_nimi, tuotteen_nimi, $tuotteen_nimi) WHERE tuote_id = $tuote_id;');
    
    // Päivitetään valmistajan tiedot
    $temp_valmistaja = ($temp_aiemmat_tuotetiedot = $valmistaja);
    $query = DB::connection()->prepare ('UPDATE TUOTE SET valmistaja = REPLACE(temp_valmistaja, valmistaja, $valmistaja) WHERE tuote_id = $tuote_id;');
    
    // Päivitetään tuotekuvaus
    $temp_tuotekuvaus = ($temp_aiemmat_tuotetiedot = $tuotekuvaus);
    $query = DB::connection()->prepare ('UPDATE TUOTE SET kuvaus = REPLACE(temp_tuotekuvaus, kuvaus, $tuotekuvaus) WHERE tuote_id = $tuote_id;');
      
  }     
  
  public function search ($tuote_id, $tuotteen_nimi){
      $tulos=0;
      
      if ($tuote_id != 0) {
        $tulos -> $this->find_tuote ($tuote_id);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat    
      }
      else {
        $tulos -> $this->find_tuotteennimi($tuotteen_nimi);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat
      }
      return $tulos;
  }
 
  public static function find_tuote ($tuote_id){
    $query = DB::connection()->prepare('SELECT * FROM TUOTE WHERE tuote_id = :tuote_id LIMIT 1');
    $query->execute(array('tuote_id' => $tuote_id));
    $row = $query->fetch();

    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteennimi' => $row['tuotteen_nimi'],
        'valmistaja' => $row['valmistaja'],
        'tuotekuvaus' => $row['kuvaus']
      ));
      
      return $tuote;
    } // end of if
  } // end of db_search_tuote_id
  
  public static function find_tuotteennimi($tuotteennimi){
      
      /*
       * Hakutulosta pitäisi laajentaa niin, että se listaisi useampia tuotteita.
       * Myös ne, joiden nimessä annettu sana esiintyy, ei vain niitä, jotka 
       * täydellisesti täyttävät hakuehdon.
       */
    
    $query = DB::connection()->prepare('SELECT Tuote_id, tuotteen_nimi, valmistaja, tuotekuvaus, lukumaara FROM TUOTE WHERE tuotteen_nimi = $tuotteennimi LIMIT 1');
    $query->execute(array('tuotteenimi' => $tuotteennimi));
    $row = $query->fetch();

    if($row){
      $tuote = new Tuote(array(
        'tuote_id' => $row['tuote_id'],
        'tuotteennimi' => $row['tuotteen_nimi'],
        'valmistaja' => $row['valmistaja'],
        'tuotekuvaus' => $row['kuvaus'],
        'lukumaara' => $row['lukumaara']
      ));
     
      return $tuote;
    } // end of if
    return null;
  } // end of db_search_tuotteennimi
  
  /*
  public static function db_lisaa_tuote($tuote_id, $tuotteennimi, $valmistaja, $tuotekuvaus, $lukumaara){
     
     // Voisi lisätä joitain tsekkauksia, että annettu data on ok.
     // Luodaan annettuja arvoja käyttäen uusi tuote.
      
     $uusi_tuote = new Tuote ($tuote_id, $tuotteennimi, $valmistaja, $tuotekuvaus, $lukumaara
     $query = DB::connection()->prepare('INSERT INTO TUOTE values $tuote_id, $tuotteennimi, $valmistaja, $tuotekuvaus, $lukumaara');
  
  }*/
}
