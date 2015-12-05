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
  
  /*****************************************
   * 
   * Tuotteiden listaus
   * 
   *****************************************/
    
  public static function index(){
     View::make('Aloitussivu.html');
  }  
  
  public static function tuote_list($page){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee kaikki tuotteet tietokannasta
     * 
     * Näyttää tuotteen listaussivun. 
     */

    self::check_logged_in();
    
    // Paluttaa, montako riviä taulussa on dataa (esim. 24)
    $tuote_count = Tuote::count();
    $page_size = 10;
    
    // Leikkaa desimaalit pois ja antaa osamäärää yhtä isomman kokonaisluvun.
    $pages = ceil($tuote_count/$page_size);
    
    if ($page+1 < $pages) {
      $nextpage = $page +1;
    }
    else {
      $nextpage = $pages;
    }
    
    if ($page -1 < 1) {
      $prevpage = 1;
    }
    else {
      $prevpage = $page-1;
    }
        
    $Tuotteet = Tuote::all_with_paging($page, $page_size);
    $paakayttaja= TuoteController::check_user_rights();
    
    View::make('Tuote/Tuotteidenlistaus.html', array('oikeudet' => $paakayttaja, 
                                                     'Tuotteet' => $Tuotteet, 
                                                     'curr_page' => $page, 
                                                     'pages' => $pages, 
                                                     'next_page' => $nextpage, 
                                                     'prev_page' => $prevpage));
       
  }  // end of tuote_list  
  
  public static function tuote_list_all(){

    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee kaikki tuotteet tietokannasta
     * 
     * Palauttaa Tuotteet -taulukon. 
     * Kutsutaan VarastoTuoteControllerista 
     */

    self::check_logged_in();
    $paakayttaja= KayttajaController::check_user_rights();  

    $kayttaja = self::get_user_logged_in();
    //Kint::dump($kayttaja);
    //$kayttajan_tiedot = Kayttaja::find($kayttaja);
    //Kint::dump($kayttajan_tiedot['kayttooikeudet']);
    
    return $Tuotteet = Tuote::all();
       
  }  // end of tuote_list 

  /*****************************************
   * 
   * Tuotteen esittelysivu
   * 
   *****************************************/
  
   public static function tuote_show($tuote_id) {
    
     /* Etsitään näytettävän tuotteen
      * tiedot. 
      * 
      * Tätä käytetään esimerkiksi listaussivun 
      * tai hakutoiminnon jälkeen
      */
     
     self::check_logged_in();
     $listattava_tuote = Tuote::find($tuote_id);
     $paakayttaja= self::check_user_rights();
     
     //Kint::dump($listattava_tuote);

     View::make('Tuote/Tuotesivu.html', array('tuote' => $listattava_tuote, 'oikeudet' => $paakayttaja));
                   
  } // The end of tuote_show

  /*****************************************
   * 
   * Tuotteen lisäys
   * 
   *****************************************/
    
  // Näyttää tuotteen lisäyssivun
  public static function tuote_lisaa_show(){
    self::check_logged_in();

    View::make('Tuote/Lisaatuote.html');
  }
   
  public static function tuote_create (){    
    
    self::check_logged_in();
    
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
      
    $uusi_tuote = new Tuote(array(
      'tuote_id' => $params['tuote_id'],  
      'tuotteen_nimi' => $params['tuotteen_nimi'],
      'valmistaja' => $params['valmistaja'],
      'kuvaus' => $params['kuvaus'],
      'history_date' => $params['history_date']
    ));
    
    $flag = true; // Koska kyseessä on lisäyskomento
    $errors = $uusi_tuote->errors($flag);
    
    if(count($errors) == 0) {
  
      //Kint::dump($uusi_tuote);
      $uusi_tuote ->save();
      
      /* Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle. 
       * Sieltä voi mennä korjaamaan, mikäli jokin tieto meni ensimmäisellä 
       * kerralla väärin.
       */
      
      Redirect::to('/Tuote/Tuotesivu/' . $params['tuote_id'], $uusi_tuote);      
    } 
    else {
      // Annetuissa arvoissa oli jotain vikaa.            
      View::make('Tuote/Lisaatuote.html', array('errors' => $errors, 'attiributes' => $params));
    } 
    return;
  }
  
  /*****************************************
   * 
   * Tuotteen muuttaminen
   * 
   *****************************************/
  
  public static function tuote_edit($tuote_id){    
    /*
     *  Tuote-id on hakuavain. Sitä ei voi editoida.
     *  Käyttäjän pitää tietysti ensin nähdä tuotteen nykyiset tiedot.
     */
    
    self::check_logged_in();
    
    $muutettava_tuote= Tuote::find($tuote_id);
    View::make('Tuote/Tuotetietojenmuutos.html', array('muutettava_tuote' => $muutettava_tuote));    
  }
  
  public static function tuote_edit_post($tuote_id){

    self::check_logged_in();  
    $uudet_tiedot = $_POST; 
  
    /*
     * Asetetaan päivämäärä ja timestamp. 
     * Olisi järkevää, jos tämä tulisi aina automaattisesti.
     */
    if (empty($uudet_tiedot['history_date'])){
        $t=time();
        $uudet_tiedot['history_date'] = (date("Y-m-d",$t));
    }
    
    //Luodaan uusi tuote, jolla kutsutaan modifya...  
    $muuttujat= array(
      'tuote_id' => $uudet_tiedot['tuote_id'],
      'tuotteen_nimi' => $uudet_tiedot['tuotteen_nimi'],
      'kuvaus'=> $uudet_tiedot['kuvaus'], 
      'valmistaja'=> $uudet_tiedot['valmistaja'],
      'history_date'=> $uudet_tiedot['history_date']
    );
    
    $muutettava_tuote = new Tuote ($muuttujat);
    
    // tsekataan syötteet
    $flag = false; // Koska ei ole lisäyskomento
    $errors = $muutettava_tuote->errors($flag);
    
    if(count($errors) == 0){
        
      // Ei virheitä syötteissä
      $muutettava_tuote ->modify();    
      
      /* 
       * Listataan tuotetiedot, jotta muutos näkyy
       * Siirrytään ensimmäiselle sivulle.
       * 
       */
      TuoteController::tuote_list(1); 
      
    } 
    else {
      //Kint::dump($errors);
      View::make('Tuote/Tuotetietojenmuutos.html', array('errors' => $errors, 'muutettava_tuote' => $muutettava_tuote));
    }
  }     
  
  /*****************************************
   * 
   * Tuotteen hakeminen
   * 
   *****************************************/
  
  // Näyttää tuotteen hakusivun
  public static function tuote_hae_show(){
    
    self::check_logged_in();
    View::make('Tuote/Tuotteenhakeminen.html');
  }

  public function tuote_search (){

    self::check_logged_in();
    $params = $_POST;   
    
    $empty_parameters_counter=0;
    
    if (empty($params['tuote_id'])) {
    
       // Tuote_id:tä ei ole annettu.
       $empty_parameters_counter++;
    }
    else { 
      TuoteController::find_tuote_post_tuote_id ($params['tuote_id']);
      // Mikäli löytyy, ohjataan tuotesivulle    
    }
    
    if (empty($params['tuotteen_nimi'])){
      $empty_parameters_counter++;
      // Tuotteen nimeä ei ole annettu
    }
    else {
      TuoteController::find_tuote_post_tuotteennimi($params['tuotteen_nimi']);
      // Mikäli löytyy, ohjataan tuotteiden listaussivulle 
    }
    
    if ($empty_parameters_counter==2) {
      $errors = 'Et antanut hakuehtoja';
      View::make('Tuote/Tuotteenhakeminen.html', array('errors' => $errors));
    }
  }
    
  public static function find_tuote_with_tuote_id($tuote_id){
   
    $etsittava_tuote = Tuote::find($tuote_id);  
    
    return $etsittava_tuote;

  } // end of find_tuote_with_tuote_id[$tuote_id)
 
  public static function find_tuote_post_tuote_id ($tuote_id){

    self::check_logged_in();
    //$input_params = $_POST;   
    //$tuote_id = $input_params['tuote_id'];
       
    $etsittava_tuote = Tuote::find($tuote_id);  
        
    if (empty($etsittava_tuote)) {
        // Ei löytynyt
        $errors='Etsittävää tuotetta ei löytynyt $tuote_id';
        View::make('Tuote/Tuotesivu.html', array('errors' => $errors, 'tuote' => $etsittava_tuote));
    }
    
    View::make('Tuote/Tuotesivu.html', array('tuote' => $etsittava_tuote));
    
  } // end of find_tuote_post
  
 public static function find_tuote_post_tuotteennimi ($tuotteen_nimi){
         
    self::check_logged_in();
    $tulokset = Tuote::find_tuotteen_nimi($tuotteen_nimi);  
    
    if(empty ($tulokset)) {
      // Ei löytynyt
      $errors= 'Tuotetta $tuotteen_nimi ei löytynyt.';
      
      View::make('Tuote/Tuotteidenlistaus.html', array('errors' => $errors, 'Tuotteet' => $tulokset));
    }

    View::make('Tuote/Tuotteidenlistaus.html', array('Tuotteet' => $tulokset));
    
  } // end of find_tuote_post
   
  /*****************************************
   * 
   * Tuotteen poisto
   * 
   *****************************************/
  
  public static function poista_tuote($tuote_id){
    
    self::check_logged_in();
      
    /*
     * Tämän funktion avulla käyttäjä pystyy poistamaan tuotteen
     * kokonaan varastokirjanpidosta (tuote poistuu valikoimasta).
     */
 
    $input_params = $_POST;   
    $tuote_id = $input_params['tuote_id'];
    
    $poistettava_tuote = new Tuote(array('tuote_id' => $tuote_id));        
    $poistettava_tuote->destroy();
       
    // Käyttäjä näkee kaikkien tuotteiden listauksesta, että tuote on poistunut      
    $Tuotteet = Tuote::all();

    Redirect::to('/Tuote/Tuotteidenlistaus', array('Tuotteet' => $Tuotteet));
  }
}