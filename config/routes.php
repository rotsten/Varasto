<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
 
  $routes->get('/Kirjaudu', function() {
    HelloWorldController::kirjaudu();
  });
  
  $routes->post('/Kirjaudu', function(){
    // Kirjautumisen käsittely
    KayttajaController::handle_login();
  });
    
  $routes->get('/Paasivu', function() {
    HelloWorldController::paasivu_show();
  });
  
  // Käyttäjään liittyvät
  $routes->get('/Kayttaja/Kayttajienlistaus', function() {
    KayttajaController::kayttaja_list();
  });
  
  $routes->get('/Kayttaja/Kayttajatietojenmuutos-testi', function() {
    KayttajaController::kayttaja_edit();
  });
  
  // Tuotteisiin liittyvät

  $routes->get('/Tuotesivu/:tuote_id', function($tuote_id) {
    TuoteController::tuote_show_with_tuote_id($tuote_id);
  });
 
  /*
  $routes->get('/Tuote/Tuotesivu', function() {
    TuoteController::tuote_show();
  });
  */
    
  $routes->post('/Tuote', function() {
    Tuote::Save();
  });
   
  // Pelin lisäyslomakkeen näyttäminen
  $routes->get('/Tuote/Lisaatuote', function(){
    TuoteController::tuote_lisaa_show();
  });
  
  $routes->post('/Tuote/Lisaatuote', function(){
    TuoteController::tuote_create();
  });
  
  /*
  $routes->post('/Tuote/Tallenna/:tuote_id', function($tuote_id){
    TuoteController::tallenna($tuote_id);
  });
  */
  
  $routes->get('/Tuote/Tuotteidenlistaus', function() {
    TuoteController::tuote_list();
  });
  
  $routes->get('/Tuote/Tuotteenhakeminen', function() {
    TuoteController::tuote_hae_show();
  });
  
  $routes->post('/Tuote/Tuotteenhakeminen', function($tuote_id) {
    TuoteController::find_tuote_with_tuote_id($tuote_id);
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
*/
  $routes->post('/find_tuotteennimi', function(){
    TuoteController::find_tuotteennimi();
  });
  
  /*
  $routes->post('/Tuote/Tuotteidenhakeminen', function(){
    TuoteController::tallenna();
  });
  */
  $routes->get('/Tuotetietojenmuutos/:tuote_id', function($tuote_id) {
    TuoteController::tuote_edit($tuote_id);
  });

  // Jotenkin pitäisi välittää myös ne aiemmat tiedot.
  $routes->post('/Tuotetietojenmuutos/:tuote_id', function($tuote_id) {
    TuoteController::tuote_edit_post($tuote_id);
  });
           
  // Varastoon liittyvät
  $routes->get('/Varasto/Varastotilanteenmuutos/:tuote_id', function($tuote_id) {
    VarastoController::varasto_edit($tuote_id);
  });
  
  $routes->get('/Varasto/Varastonlistaus', function() {
    VarastoController::varasto_list();
  });



