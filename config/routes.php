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
  
  // Uuden käyttäjän lisääminen
  $routes->post('/Kayttaja/LisaaKayttaja', function(){
    TuoteController::kayttaja_create();
  });
  
  // Käyttäjien listaussivun näyttäminen
  $routes->get('/Kayttaja/Kayttajienlistaus', function() {
    KayttajaController::kayttajalistaus();
  });
  
  // Näyttää käyttäjätietojen muutossivun
  $routes->get('/Kayttaja/Kayttajatietojenmuutos/:kayttajatunnus', function($kayttajatunnus) {
    KayttajaController::kayttaja_edit($kayttajatunnus);
  });
  
  // Ottaa vastaan kayttajatietojen muutokset
  $routes->post('/Kayttaja/Kayttajatietojenmuutos/:kayttajatunnus', function($kayttajatunnus) {
    KayttajaController::kayttaja_edit_post($kayttajatunnus);
  });

  // Näyttää käyttäjätiedot
  $routes->get('/Kayttaja/Kayttajasivu/:kayttajatunnus', function($kayttajatunnus) {
    KayttajaController::kayttaja_show($kayttajatunnus);
  });
  
  // Poistaa käyttäjätiedot
  $routes->post('/Kayttaja/Kayttajienlistaus/:kayttajatunnus', function($kayttajatunnus){
    KayttajaController::poista_kayttaja($kayttajatunnus);
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
  
  // Tulostaa tuotteen hakutulokset (haettu tuote-id:llä) tuotesivulle 
  $routes->get('/Tuote/Tuotteenhakeminen:tuote_id', function($tuote_id){
   //TuoteController::find_tuote_post($tuote_id);
   TuoteController::tuote_show($tuote_id);
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
  
  // Tuotteen poistaminen  
  $routes->get('/Tuote/Poistatuote/:tuote_id', function($tuote_id){
    TuoteController::poista_tuote($tuote_id);
  });
  
  /*
  // Tuotteiden poistaminen listasta 
  $routes->get('/Tuote/Tuotteidenlistaus/:tuote_id', function($tuote_id) {
    TuoteController::poista_tuote($tuote_id);
  });
  
  $routes->post('/Tuote/Poistatuote/:tuote_id', function($tuote_id){
    TuoteController::poista_tuote($tuote_id);
  });
  */

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
  