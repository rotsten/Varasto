<?php

/*
  $routes->get('/', function() {
    TuoteController::index();
  });
*/  
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
 
  $routes->get('/Kayttaja/Kirjaudu', function() {
    KayttajaController::Kirjaudu();
  });
   
  $routes->post('/Kayttaja/Kirjaudu', function(){
    // Kirjautumisen käsittely
    KayttajaController::handle_login();
  });
    
  $routes->get('/Paasivu', function() {
    HelloWorldController::paasivu_show();
  });
  
  // Käyttäjään liittyvät
  $routes->get('/Kayttaja/kayttajalistaus', function() {
    KayttajaController::kayttajalistaus();
  });
  
  $routes->get('/Kayttaja/Kayttajatietojenmuutos-testi', function() {
    KayttajaController::kayttaja_edit();
  });
  
  // Tuotteisiin liittyvät
      
  /*
  $routes->post('/Tuote', function() {
    Tuote::Save();
  }); 
   */
   
  // Pelin lisäyslomakkeen näyttäminen
  $routes->get('/Tuote/Lisaatuote', function(){
    TuoteController::tuote_lisaa_show();
  });
  
  // uuden tuotteen lisääminen
  $routes->post('/Tuote/Lisaatuote', function(){
    TuoteController::tuote_create();
  });
    
  $routes->get('/Tuote/Tuotteidenlistaus', function() {
    TuoteController::tuote_list();
  });
  
  // Tulostaa tuotteen hakusivun
  $routes->get('/Tuote/Tuotteenhakeminen', function() {
    TuoteController::tuote_hae_show();
  });
  
   /*
    * Kun haetaan joko Tuote-id:llä tai tuotenimellä, kutsu
    * taan tuote_search() -funktiota.
    * 
    * Tällä hetkellä tekstihaku on edelleen kehittelyvaiheessa.
    */
/*
  $routes->get('/Tuote/Tuotteenhakeminen', function() {
    TuoteController::tuote_search();
  });
  $routes->post('/find_tuotteennimi', function(){
    TuoteController::find_tuotteennimi();
  });
*/ 
  /*
  $routes->post('/find_tuote', function($tuote_id){
    TuoteController::find_tuote_post($tuote_id);
  });
  */
  
  // Tulostaa tuotteen hakutulokset tuotesivulle 
  $routes->post('/Tuote/Tuotteenhakeminen', function($tuote_id){
    TuoteController::tuote_show($tuote_id);
    //TuoteController::find_tuote_post($tuote_id);
    //TuoteController::find_tuote_with_tuote_id($tuote_id);
  });
  
  $routes->post('/Tuote/Tallenna/', function(){
    TuoteController::tallenna();
  });  
  
  $routes->get('/Tuote/Tuotetietojenmuutos/:tuote_id', function($tuote_id) {
    TuoteController::tuote_edit($tuote_id);
  });
   
  $routes->post('/Tuote/Tuotetietojenmuutos/:tuote_id', function($tuote_id) {
    TuoteController::tuote_edit_post($tuote_id);
  });
  
  $routes->get('/Tuote/Tuotesivu/:tuote_id', function($tuote_id) {
    TuoteController::tuote_show($tuote_id);
  });
   
  // Varastoon liittyvät
  $routes->get('/Varasto/Varastotilanteenmuutos/:tuote_id', function($tuote_id) {
    VarastoController::varasto_edit($tuote_id);
  });
  
  $routes->get('/Varasto/Varastonlistaus', function() {
    VarastoController::varasto_list();
  });