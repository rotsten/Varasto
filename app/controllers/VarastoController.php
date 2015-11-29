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
    $varastotilanne = Varasto::all();
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
    View::make('Varasto/LisaaVarasto.html');
  }
   
  public static function varasto_create (){    

     
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    self::check_logged_in(); 
        
    $uusi_varasto = new VarastoTuote(array(
      'varasto_id' => $params['varasto_id'], 
      'nimi' => $params['nimi']
    ));
    
    $errors = $uusi_varasto->errors();
    
    if(count($errors) == 0){
  
      //Kint::dump($uusi_varasto);
      $uusi_varasto ->save();
      
      /* Ohjataan käyttäjä lisäyksen jälkeen varaston esittelysivulle. 
       */
      
      Redirect::to('/Varasto/Varastosivu/' . $params['varasto_id'], $uusi_varasto);
          
    } else{
        View::make('Varasto/LisaaVarasto.html', array('errors' => $errors, 'attiributes' => $params));
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

    Kint::dump($varasto_id);
    self::check_logged_in(); 
    
    //Etsitään ensin tuote, mitä se koskee.
    $muutettava_varastotieto = VarastoController::find_with_varasto_id($varasto_id);
    Kint::dump($muutettava_varastotieto);

    View::make('Varasto/Varastonmuutos.html', array('Varasto' => $muutettava_varastotieto));
  
  }  // end of varasto_edit
  
  public static function varasto_edit_post($varasto_id){
     
    $uudet_tiedot = $_POST; 
    self::check_logged_in(); 

    //$uudet_tiedot['kayttajatunnus'] = base_controller::get_user_logged_in();
    
    $muuttujat = array(
      'varasto_id' => $uudet_tiedot['varasto_id'],
      'nimi' => $uudet_tiedot['nimi'],
      'osoite' => $uudet_tiedot['osoite']
    );

    $muuttunut_varasto = new Varasto($muuttujat);
    //$errors = $Varasto->errors();

    $muuttunut_varasto ->modify();

    // Listataan varastotiedot, jotta muutos näkyy
    $muuttunut_varasto = Varasto::all();
    View::make('Varasto/Varastonlistaus.html', array('varastot' => $muuttunut_varasto));
    
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
