<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
 
  $routes->get('/Kirjaudu', function() {
    HelloWorldController::kirjaudu();
  });
  
  $routes->post('/Kirjaudu', function(){
    // Kirjautumisen käsittely
    KayttajaController::handle_login();
  });
  
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
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
  /*
  $routes->get('/Tuote/Tuotesivu', function() {
    TuoteController::tuote_show();
  });
  */

  $routes->post('/Tuote', function() {
    TuoteController::tallenna();
  });
  
  // Pelin lisäyslomakkeen näyttäminen
  $routes->get('/Tuote/Lisaatuote', function(){
    TuoteController::tuote_lisaa_show();
  });
  
  $routes->post('/Tuote/Lisaatuote', function($tuote_id, $tuotteen_nimi, $valmistaja, $kuvaus, $lukumaara, $history_date){
    TuoteController::tuote_create($tuote_id, $tuotteen_nimi, $valmistaja, $kuvaus, $lukumaara, $history_date);
  });
  
  /*
  $routes->post('/Tuote/Tallenna/:tuote_id', function($tuote_id){
    TuoteController::tallenna($tuote_id);
  });
  */
  
  $routes->get('/Tuote/Tuotteidenlistaus', function() {
    TuoteController::tuote_list();
  });

  $routes->post('/find_tuote', function($tuote_id){
    TuoteController::find_tuote($tuote_id);
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
          
  $routes->get('/Tuotesivu/:tuote_id', function($tuote_id) {
    TuoteController::tuote_show($tuote_id);
  });
  
  // Varastoon liittyvät
  $routes->get('/Varasto/Varastotilanteenmuutos/:tuote_id', function($tuote_id) {
    VarastoController::varasto_edit($tuote_id);
  });
  
  $routes->get('/Varasto/Varastonlistaus', function() {
    VarastoController::varasto_list();
  });



