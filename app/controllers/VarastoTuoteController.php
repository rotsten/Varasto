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
class VarastoTuoteController extends BaseController{
  
  /*****************************************
   * 
   * Tuotteiden listaus
   * 
   *****************************************/
 
  public static function varasto_tuotteet_list($varasto_id){

    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee kaikki tietyn varaston tuotteet 
     * 
     * Näyttää varston tuotteiden listaussivun. 
     */
   
    // Etsi annetussa varastossa talletettujen tuotteiden id:t 
    $varaston_tuotteet =VarastoTuote::all_in_varasto($varasto_id);
    
    foreach($rows as $row){
      $varaston_tuotteet[] = new Varasto_tuote(array(
        'varasto_id' => $row['varasto_id'],
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara']
      ));
    }
    
    View::make('Tuote/Tuotteidenlistaus.html', array('Tuotteet' => $varaston_tuotteet));
       
  }  // end of tuote_list  
  
  
// Näyttää varastotilanteen listaus
  /*
   * 
  public static function varastotilanne_show(){
    View::make('Varasto/Varastotilannelistaus.html');
  } 
   */

  public static function varastotilanne_show($varasto_id){

    /*
     * Tämä funktio kutsuu xx -fuktiota, joka 
     * poimii halutut tiedot TUOTE-taulusta 
     * 
     * Näyttää varston tuotteiden listaussivun. 
     */
   
    Kint::dump($varasto_id);
    
    // Etsi annetussa varastossa talletettujen tuotteiden tiedot
    $varaston_tuotteet = VarastoTuote::all_in_varasto_join_tuote($varasto_id);
    Kint::dump($varaston_tuotteet);
    
    $varaston_nimi = Varasto::getNimiById($varasto_id);

    View::make('Varasto/Varastotilannelistaus.html', array('Varaston_tuotteet' => $varaston_tuotteet, 'varastonnimi' => $varaston_nimi));
       
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
     
     $listattava_tuote = Tuote::find($tuote_id);
     //Kint::dump($listattava_tuote);

     View::make('Tuote/Tuotesivu.html', array('tuote' => $listattava_tuote));
                   
  } // The end of tuote_show

  /*****************************************
   * 
   * Tuotteen lisäys
   * 
   *****************************************/
    
  // Näyttää tuotteen lisäyssivun
  public static function tuote_lisaa_show(){
    View::make('Tuote/Lisaatuote.html');
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
      'history_date' => $params['history_date']
    ));
    
    $errors = $uusi_tuote->errors();
    
    if(count($errors) == 0){
  
      //Kint::dump($uusi_tuote);
      $uusi_tuote ->save();
      
      /* Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle. 
       * Sieltä voi mennä korjaamaan, mikäli jokin tieto meni ensimmäisellä 
       * kerralla väärin.
       */
      
      Redirect::to('/Tuote/Tuotesivu/' . $params['tuote_id'], $uusi_tuote);
          
    } else{
       // Annetuissa arvoissa oli jotain vikaa.     
        //Kint::dump($uusi_tuote);
        //Kint::dump($errors);
        View::make('Tuote/Lisaatuote.html', array('errors' => $errors, 'attiributes' => $params));
    }
    
    return;
  }
  
  /*****************************************
   * 
   * Tuotteen muuttaminen
   * 
   *****************************************/
  /*
   *
   * Aiemmin pelkkä esittely ja sivun näyttäminen
   *    
  // Näyttää tuotteen muokkaussivun
  public static function tuote_edit(){
    View::make('Tuote/Tuotetietojenmuutos.html');
  }
   */
  
  public static function tuote_edit($tuote_id){
    
    /*
     *  Tuote-id on hakuavain. Sitä ei voi editoida.
     *  Käyttäjän pitää tietysti ensin nähdä tuotteen nykyiset tiedot.
     */
       
    $muutettava_tuote= Tuote::find($tuote_id);
    //Kint::dump($muutettava_tuote);
    View::make('Tuote/Tuotetietojenmuutos.html', array('muutettava_tuote' => $muutettava_tuote));
    
  }
  
  public static function tuote_edit_post($tuote_id){
    
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
    $errors = $muutettava_tuote->errors();
    //Kint::dump($errors);
    
    if(count($errors) == 0){
        
        // Ei virheitä syötteissä
        $muutettava_tuote ->modify();    
      
        // Listataan tuotetiedot, jotta muutos näkyy
        TuoteController::tuote_list(); 
    } 
    else {
        //Kint::dump($errors);
        View::make('Tuotetietojenmuutos.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }     
  
  /*****************************************
   * 
   * Tuotteen hakeminen
   * 
   *****************************************/
  
  // Näyttää tuotteen hakusivun
  public static function tuote_hae_show(){
    View::make('Tuote/Tuotteenhakeminen.html');
  }

  /*
  public static function tuote_search(){
    View::make('Tuote/Tuotteenhakeminen.html');
  }
  */ 
  public function tuote_search ($tuote_id, $tuotteen_nimi){
      $tulos=0;
      
      if ($tuote_id != 0) {
        $tulos -> $this->find($tuote_id);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat    
      }
      else {
        $tulos -> $this->find_tuotteen_nimi($tuotteen_nimi);
        // Tänne pitää tallentaan haun tuloksena saadun olion datat
      }
      return $tulos;
  }
    
  public static function find_tuote_with_tuote_id($tuote_id){
    
    //$etsittava_tuote = new Tuote();
    $etsittava_tuote = Tuote::find($tuote_id);  
    //Kint::dump($etsittava_tuote);
    
    return $etsittava_tuote;

  } // end of find_tuote_with_tuote_id[$tuote_id)
 
  public static function find_tuote_post (){
         
     /* Tätä funktiota käytetään tuotteen hakutoiminnossa.
      * Funktion päätteeksi palautetaan tulos suoraan Tuotesivulle
      */
    
      /*
       *  POST on aina taulukkotyyppinen, tosin nyt se kantaa vain yhtä arvoa.
       *  Parametrina saatavaa tuote_id:tä käytetään jatkossa mm.
       *  merkkijono-tyyppisenä muuttujana, siksi ei voida käyttää suoraa
       *  sijoitusta.
       */
      
    $input_params = $_POST;   
    $tuote_id = $input_params['tuote_id'];
           
    //Kint::dump($tuote_id);
    
    $etsittava_tuote = Tuote::find($tuote_id);  
    //Kint::dump($etsittava_tuote);
    
    if (empty($etsittava_tuote)) {
        // Ei löytynyt
        $errors='Etsittävää tuotetta ei löytynyt $tuote_id';
        View::make('Tuote/Tuotesivu.html', array('errors' => $errors, 'tuote' => $etsittava_tuote));
    }
    
    //Redirect::to('/Tuote/Tuotesivu.html{{$tuote_id}}', array('tuote' => $etsittava_tuote));
    View::make('Tuote/Tuotesivu.html', array('tuote' => $etsittava_tuote));
    
  } // end of find_tuote_post

   
  /*****************************************
   * 
   * Tuotteen poisto
   * 
   *****************************************/
  
  public static function poista_tuote($tuote_id){
    
    /*
     * Tämän funktion avulla käyttäjä pystyy poistamaan tuotteen
     * kokonaan varastokirjanpidosta (tuote poistuu valikoimasta).
     */
      
    $poistettava_tuote = new Tuote(array('tuote_id' => $tuote_id));        
    $poistettava_tuote->destroy();
       
    // Käyttäjä näkee kaikkien tuotteiden listauksesta, että tuote on poistunut      
    $Tuotteet = Tuote::all();

    Redirect::to('/Tuote/Tuotteidenlistaus', array('Tuotteet' => $Tuotteet));
 
  }
}
