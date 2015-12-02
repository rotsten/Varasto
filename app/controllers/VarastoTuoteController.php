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
   
    //self::check_logged_in(); 
    
    // Etsi annetussa varastossa talletettujen tuotteiden id:t 
    $varaston_tuotteet =VarastoTuote::all_in_varasto($varasto_id);
    
    foreach($rows as $row){
      $varaston_tuotteet[] = new Varasto_tuote(array(
        'varasto_id' => $row['varasto_id'],
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara']
      ));
    }
    
    View::make('VarastoTuote/Tuotteidenlistaus.html', array('Tuotteet' => $varaston_tuotteet));
       
  }  // end of tuote_list  
  
  public static function varastotilanne_show($varasto_id){

    /*
     * Tämä funktio kutsuu xx -fuktiota, joka 
     * poimii halutut tiedot TUOTE-taulusta 
     * 
     * Näyttää varston tuotteiden listaussivun. 
     */
   
    //self::check_logged_in(); 
    //Kint::dump($varasto_id);
    
    // Etsi annetussa varastossa talletettujen tuotteiden tiedot
    $varaston_tuotteet = VarastoTuote::all_in_varasto_join_tuote($varasto_id);
    //Kint::dump($varaston_tuotteet);
    
    $varaston_nimi = Varasto::getNimiById($varasto_id);
    //Kint::dump($varaston_nimi);

    View::make('VarastoTuote/Varastotilannelistaus.html', array('Varaston_tuotteet' => $varaston_tuotteet, 'varastonnimi' => $varaston_nimi));
       
  }  // end of tuote_list
    

  /*****************************************
   * 
   * Tuotteiden lisäys varastoon
   * 
   ******************************************/
  public static function varastotuote_lisaa_show (){
      
    $varaston_tuotteet =VarastoTuote::all_in_varasto($varasto_id);
    
    foreach($rows as $row){
      $varaston_tuotteet[] = new Varasto_tuote(array(
        'varasto_id' => $row['varasto_id'],
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara']
      ));
    }
    // Ei antaisi välittää tässä taulukkoa.
    
    //View::make('/Varasto/Lisaauusituotevarastotuote.html' array('Tuotteet' => $varaston_tuotteet));     
  }
  
    public static function varastotuote_lisaa_post (){
    
    /*
     *  - Otetaan POST:n sisältö
     *  - validointi
     * 
     *  - luodaan uusi tuote
     *  - Kutsutaan Savea.
     *  - Lopulta palautetaan listaussivulle.
     *     
    $varaston_tuotteet =VarastoTuote::all_in_varasto($varasto_id);
    
    foreach($rows as $row){
      $varaston_tuotteet[] = new Varasto_tuote(array(
        'varasto_id' => $row['varasto_id'],
        'tuote_id' => $row['tuote_id'],
        'lukumaara' => $row['lukumaara']
      ));
    }
    View::make('/Varasto/Lisaauusituotevarastotuote.html' array('Tuotteet' => $varaston_tuotteet));     
  */
    
    }
  
  
  /*****************************************
   * 
   * Tuotteiden lukumäärän muutos
   * 
   *****************************************/

  public static function varastotuote_edit($tuote_id){
    /*
     *  Tuote-id on hakuavain. Sitä ei voi editoida.
     *  Käyttäjän pitää tietysti ensin nähdä tuotteen nykyiset tiedot.
     */
    
    //self::check_logged_in(); 
    $muutettava_tuote= Varasto_Tuote::all_in_certain_varasto_join_tuote($tuote_id);
    //Kint::dump($muutettava_tuote);
    View::make('VarastoTuote/Lukumaaratietojenmuuttaminen.html', array('muutettava_tuote' => $muutettava_tuote));
    
  }
  
  public static function varastotuote_edit_post(){
    
    $uudet_tiedot = $_POST; 
    Kint::dump($uudet_tiedot);

    //self::check_logged_in(); 
  
    //Luodaan uusi tuote, jolla kutsutaan modifya...  
    $muuttujat= array(
      'varasto_id' => $uudet_tiedot['varasto_id'],
      'tuote_id' => $uudet_tiedot['tuote_id'],
      'lukumaara'=> $uudet_tiedot['lukumaara']
    );
    
    $muutettava_tuote = new VarastoTuote($muuttujat);
    
    // tsekataan syötteet
    $errors = $muutettava_tuote->errors();
    Kint::dump($errors);
    
    if(count($errors) == 0){
        
      // Ei virheitä syötteissä
      $muutettava_tuote ->modify();    
      
      // Listataan tuotetiedot, jotta muutos näkyy
      $varaston_tuotteet = VarastoTuote::all_in_varasto_join_tuote($varasto_id);
      $varaston_nimi = Varasto::getNimiById($varasto_id);
      View::make('VarastoTuote/Varastotilannelistaus.html', array('Varaston_tuotteet' => $varaston_tuotteet, 'varastonnimi' => $varaston_nimi)); 
    } 
    else {
       //Kint::dump($errors);
       View::make('VarastoTuote/Lukumaaratietojenmuuttaminen.html', array('errors' => $errors, 'Varaston_tuotteet' => $varaston_tuotteet, 'varastonnimi' => $varaston_nimi));     
    }  // end of if
  } // end of tuote_edit_post()    
  
  /*****************************************
   * 
   * Tuotteen hakeminen
   * 
   *****************************************/
  
  // Näyttää tuotteen hakusivun
  public static function tuote_hae_show(){
    
    //self::check_logged_in(); 
    View::make('Tuote/Tuotteenhakeminen.html');
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
    
    /*  POST on aina taulukkotyyppinen, tosin nyt se kantaa vain yhtä arvoa.
     *  Parametrina saatavaa tuote_id:tä käytetään jatkossa mm.
     *  merkkijono-tyyppisenä muuttujana, siksi ei voida käyttää suoraa
     *  sijoitusta.
     */
      
    $input_params = $_POST;   
    $tuote_id = $input_params['tuote_id'];
    //self::check_logged_in(); 
    
    //Kint::dump($tuote_id);
    
    $etsittava_tuote = Tuote::find($tuote_id);  
    //Kint::dump($etsittava_tuote);
    
    if (empty($etsittava_tuote)) {
      // Ei löytynyt
      $errors='Etsittävää tuotetta ei löytynyt $tuote_id';
      View::make('VarastoTuote/VarastoTuotesivu.html', array('errors' => $errors, 'tuote' => $etsittava_tuote));
    }
    
    //Redirect::to('/Tuote/Tuotesivu.html{{$tuote_id}}', array('tuote' => $etsittava_tuote));
    View::make('VarastoTuote/VarastoTuotesivu.html', array('tuote' => $etsittava_tuote));
    
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
    
    //self::check_logged_in(); 
    $poistettava_tuote = new Tuote(array('tuote_id' => $tuote_id));        
    $poistettava_tuote->destroy();
       
    // Käyttäjä näkee kaikkien tuotteiden listauksesta, että tuote on poistunut      
    $Tuotteet = Tuote::all();

    Redirect::to('/Tuote/Tuotteidenlistaus', array('Tuotteet' => $Tuotteet));
  }
}

