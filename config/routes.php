<?php

  $routes->get('/', function() {
    TuoteController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
 
  // Käyttäjään liittyvät
  $routes->get('/Kayttaja/Kirjaudu', function() {
    KayttajaController::Kirjaudu();
  });
   
  // Kirjautumisen käsittely
  $routes->post('/Kayttaja/Kirjaudu', function(){
    KayttajaController::handle_login();
  });
  
  // Kirjautumisen jälkeen pääsivun esittely
  $routes->get('/Paasivu', function() {
    KayttajaController::paasivu_show();
  });
  
  // Käyttäjien listaussivun näyttäminen
  $routes->get('/Kayttaja/Kayttajienlistaus', function() {
    KayttajaController::kayttajalistaus();
  });
  
  $routes->get('/Kayttaja/Kayttajatietojenmuutos-testi', function() {
    KayttajaController::kayttaja_edit();
  });
  
  // Tuotteisiin liittyvät 
  // Pelin lisäyslomakkeen näyttäminen
  $routes->get('/Tuote/Lisaatuote', function(){
    TuoteController::tuote_lisaa_show();
  });
  
  // uuden tuotteen lisääminen
  $routes->post('/Tuote/Lisaatuote', function(){
    TuoteController::tuote_create();
  });
   
   // tuotteiden listaaminen 
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
  
  // Tulostaa tuotteen hakutulokset (haettu tuote-ide:llä) tuotesivulle 
  $routes->post('/Tuote/Tuotteenhakeminen', function($tuote_id){
   //TuoteController::find_tuote_post($tuote_id);
   TuoteController::tuote_show($tuote_id);
  });
  
  // Näyttää tuotetietojen muutossivun
  $routes->get('/Tuote/Tuotetietojenmuutos/:tuote_id', function($tuote_id) {
    TuoteController::tuote_edit($tuote_id);
  });
  
  // Ottaa vastaan muutokset
  $routes->post('/Tuote/Tuotetietojenmuutos/:tuote_id', function($tuote_id) {
    TuoteController::tuote_edit_post($tuote_id);
  });
  
  // Näyttää tuotetiedot
  $routes->get('/Tuote/Tuotesivu/:tuote_id', function($tuote_id) {
    TuoteController::tuote_show($tuote_id);
  });
   
  // Varastoon liittyvät
  // Varaston listaamiseen liittyvä sivu
  $routes->get('/Varasto/Varastonlistaus', function() {
    VarastoController::varasto_list();
  });
  
  // Varaston muuttamiseen liittyvä sivu
  $routes->get('/Varasto/Varastotilanteenmuutos/:tuote_id', function($tuote_id) {
    VarastoController::varasto_edit($tuote_id);
  });
  
  // Ottaa vastaan muutokset
  $routes->post('/Varasto/Varastotilanteenmuutos/:tuote_id', function($tuote_id) {
    VarastoController::varasto_edit_post($tuote_id);
  });
  