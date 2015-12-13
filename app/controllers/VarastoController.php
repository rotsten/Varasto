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
class VarastoController extends BaseController{
       
  public static function index(){
      
    self::check_logged_in(); 
    
    // Paluttaa, montako riviä taulussa on dataa (esim. 24)
    $varasto_count = Varasto::count();
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
    
    $varastotilanne = Varasto::all_with_paging($page, $page_size);
    View::make('varastotilanne/Varastotilanteenmuutos.html', array('varastotilanne' => $varastotilanne));
  }

  /*****************************************
   * 
   * Varaston lisäys
   * 
   *****************************************/
    
  // Näyttää varaston lisäyssivun
  public static function varasto_lisaa_show(){
   
    self::check_logged_in(); 
    View::make('Varasto/Lisaavarasto.html');
  }
   
  public static function varasto_create (){    

    self::check_logged_in(); 
    
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
     
    $uusi_varasto = new Varasto(array(
      'varasto_id' => $params['varasto_id'], 
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite']
    ));
    
    $errors = $uusi_varasto->errors();
    
    if(count($errors) == 0){
  
      Kint::dump($uusi_varasto);
      $uusi_varasto ->save();
      
      /* Ohjataan käyttäjä lisäyksen jälkeen varaston esittelysivulle. 
       */
      
      Redirect::to('/Varasto/Varastosivu/' . $params['varasto_id'], $uusi_varasto);
          
    } else{
        View::make('Varasto/Lisaavarasto.html', array('errors' => $errors, 'attiributes' => $params));
    }
    
    return;
  }
  
   /*****************************************
   * 
   * Tietyn varaston tietojen esittäminen
   * 
   *****************************************/
   public static function varasto_show($varasto_id){
       
      self::check_logged_in(); 
      $etsittava_varasto = VarastoController::find_with_varasto_id($varasto_id);
      //Kint::dump($etsittava_varasto);
       
      View::make('Varasto/Varastosivu.html', array('varasto' => $etsittava_varasto));
   }
  
  /*****************************************
   * 
   * Varaston listaaminen
   * 
   *****************************************/
  
    public static function varasto_list(){
    /*
     * Tämä funktio kutsuu, all-funktiota,
     * mikä hakee varastotilanteen tietokannasta VARASTO-taulusta
     */
        
    self::check_logged_in();    
    $varastot = Varasto::all();
    //Kint::dump($varastot);
    View::make('Varasto/Varastonlistaus.html', array('varastot' => $varastot));

  }  // end of varasto_list
  
  /*****************************************
   * 
   * Varaston etsiminen
   * 
   *****************************************/
  
  public static function find_with_varasto_id($varasto_id){
    
    $etsittava_varasto = Varasto::find($varasto_id);  
    return $etsittava_varasto;

  } // end of find_with_varasto_id[$varasto_id)
  
  /*****************************************
   * 
   * Varaston muuttaminen
   * 
   *****************************************/
  
  public static function varasto_edit($varasto_id){

    self::check_logged_in();
        
    //Etsitään ensin tuote, mitä se koskee.
    $muutettava_varastotieto = VarastoController::find_with_varasto_id($varasto_id);
    //Kint::dump($muutettava_varastotieto);

    View::make('Varasto/Varastonmuutos.html', array('Varasto' => $muutettava_varastotieto));
  
  }  // end of varasto_edit
  
  public static function varasto_edit_post($varasto_id){
    
    self::check_logged_in();  
    $uudet_tiedot = $_POST; 
    //Kint::dump($uudet_tiedot);
    
    //Luodaan uusi Varasto, jolla kutsutaan modifya. 
    $muuttujat = array(
      'varasto_id' => $uudet_tiedot['varasto_id'],
      'nimi' => $uudet_tiedot['nimi'],
      'osoite' => $uudet_tiedot['osoite']
    );

    $muuttunut_varasto = new Varasto($muuttujat);   
    
    $errors = $muuttunut_varasto->errors();
    // Kint::dump($errors);

    if(count($errors) == 0){     
      // Ei virheitä syötteissä
      $muuttunut_varasto ->modify();
      // Listataan varastotiedot, jotta muutos näkyy
      $varastot = Varasto::all();
      View::make('Varasto/Varastonlistaus.html', array('varastot' => $varastot));
    } else {
        Kint::dump($errors);
        View::make('Varastonmuutos.html', array('errors' => $errors, 'Varasto' => $muuttunut_varasto));
    }
  }  // end of varasto_edit_post
  
  /*****************************************
   * 
   * Varaston poisto
   * 
   *****************************************/
  
  public static function poista_varasto($varasto_id){
    
    self::check_logged_in();   
    $poistettava_varasto = new Varasto(array('varasto_id' => $varasto_id));  
    
    $poistettava_varasto->destroy();
       
    // Käyttäjä näkee kaikkien varastojen listauksesta, että varasto on poistunut      
    $Varastot = Varasto::all();

    Redirect::to('/Varasto/Varastojenlistaus', array('Varastot' => $Varastot));
  }
} // The end
