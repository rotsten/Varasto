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
    
  public static function index(){
    $Tuotteet = Tuote::all();
    View::make('Tuotteet/Tuotteidenlistaus.html', array('Tuotteet' => $Tuotteet));
  }
     
  public static function tuote_lisaa_show(){
    View::make('Tuote/Lisaatuote.html');
  }
  
  public static function tuote_hae_show(){
    View::make('/Tuote/Tuotteenhakeminen.html');
  }
  
  public static function tuote_create (){    
     // Voisi lisätä joitain tsekkauksia, että annettu data on ok.
     // Luodaan annettuja arvoja käyttäen uusi tuote.
     
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    
    /*
     * Asetetaan päivämäärä ja timestamp. 
     * Olisi järkevää, jos tämä tulisi aina automaattisesti.
     */
    if (empty($params['history_date'])){
        $t=time();
        $params['history_date'] = (date("Y-m-d",$t));
    }

    /* 
     * Mikäli lukumäärää ei ole annettu, asetetaan arvoksi 
     * nolla FFFF:n sijasta.
     */
    if (empty($params['lukumaara'])){
      $params['lukumaara'] = 0;
    } 
      
    $uusi_tuote = new Tuote(array(
      'tuote_id' => $params['tuote_id'],  
      'tuotteen_nimi' => $params['tuotteen_nimi'],
      'valmistaja' => $params['valmistaja'],
      'kuvaus' => $params['kuvaus'],
      'lukumaara' => $params['lukumaara'],
      'timestamp' => $params['history_date']
    ));
         
     $uusi_tuote ->save();
     
    /* Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle. 
     * Sieltä voi mennä korjaamaan, mikäli jokin tieto meni ensimmäisellä 
     * kerralla väärin.
     */
    
    Redirect::to('/Tuote/Tuotesivu/' . $params['tuote_id'], $uusi_tuote);
     
    return;
  }
  
  public function tallenna(){
    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $uusi_tuote->save();
    /* Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle. 
     * Sieltä voi mennä korjaamaan, mikäli jokin tieto meni ensimmäisellä 
     * kerralla väärin.
     */
  }
  
  public static function tuote_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee kaikki tuotteet tietokannasta
     */
     $Tuotteet = Tuote::all();
     View::make('Tuote/Tuotteidenlistaus.html', array('Tuotteet' => $Tuotteet));
    
  }  // end of tuote_list
  
  public function tuote_edit($tuote_id){
    
    /*
     *  Tuote-id on hakuavain. Sitä ei voi editoida.
     *  Lukumäärätietoa voisi varmaan päivittää myös tässäkin, mutta se vaatisi
     *  käyttäjäoikeuksien tarkastamista. On selkeämpää, jos koko tuotetietojenmuutos -sivu
     *  on inventointioikeuksilla estetty. --> Jatkokehityspohde.
     * 
     *  Muutoskomento vaatii myös attribuuttien aiempien tietojen
     *  antamista. Siispä ne pitää hakea
     */
  
    Kint::dump($tuote_id);
    $muutettava_tuote ->find_tuote($tuote_id);
    Kint::dump($muutettava_tuote);
    View::make('Tuote/Tuotetietojenmuutos.html', array('muutettava_tuote' => $muutettava_tuote));
      
  }
  
   public function tuote_edit_post($tuote_id){
    
    $uudet_tiedot = $_POST; 
    //$muutettava_tuote = TuoteController::find_tuote($tuote_id);
  
    /*
     * Asetetaan päivämäärä ja timestamp. 
     * Olisi järkevää, jos tämä tulisi aina automaattisesti.
     */
    if (empty($uudet_tiedot['history_date'])){
        $t=time();
        $uudet_tiedot['history_date'] = (date("Y-m-d",$t));
    }

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

    $muutettava_tuote = new Tuote ($muuttujat);
    //$errors = $Tuote->errors();
    
    $muutettava_tuote ->modify();
    
    // Listataan tuotetiedot, jotta muutos näkyy
    TuoteController::tuote_list(); 
  }     
  
  public function tuote_search ($tuote_id, $tuotteen_nimi){
      $tulos=0;
      
      if ($tuote_id != 0) {
        $tulos -> $this->find_tuote ($tuote_id);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat    
      }
      else {
        $tulos -> $this->find_tuotteen_nimi($tuotteen_nimi);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat
      }
      return $tulos;
  }
    
   public static function find_tuote_with_tuote_id($tuote_id){
    
    $etsittava_tuote->find($tuote_id);            
    return $etsittava_tuote;

  } // end of _find_tuote_eith_tuote_id[$tuote_id)
 
 
  /*
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
  
   public static function tuote_show($tuote_id) {
    
     /* Etsitään näytettävän tuotteen
      * tiedot
      */
     Kint::dump($tuote_id);
     $listattava_tuote ->find_tuote($tuote_id);
     
     Kint::dump($listattava_tuote);
     
     View::make('/Tuote/Tuotesivu.html', array('tuote' => $listattava_tuote));
                   
  } // The end of tuote_show
  
  public static function tuote_delete($tuote_id){
    
    /*
     * Tämän funktion avulla käyttäjä pystyy poistamaan tuotteen
     * kokonaan varastokirjanpidosta (tuote poistuu valikoimasta).
     */
      
    $poistettava_tuote = new Tuote(array('tuote_id' => $tuote_id));
    $poistettava_tuote->destroy();
    // Käyttäjä näkee listauksesta, että tuote on poistunut 
    Redirect::to('/Tuote', array());
  }
}