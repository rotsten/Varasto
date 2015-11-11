<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
 
  $routes->get('/Kirjaudu', function() {
    HelloWorldController::kirjaudu();
  });
  
  $routes->post('/kirjaudu', function(){
    // Kirjautumisen käsittely
    UserController::handle_login();
  });
  
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
    
  $routes->get('/Paasivu', function() {
    HelloWorldController::paasivu_show();
  });
  
  $routes->get('/Kayttaja/Kayttajienlistaus', function() {
    KayttajaController::kayttaja_list();
  });
  
  $routes->get('/Kayttaja/Kayttajatietojenmuutos', function() {
    KayttajaController::kayttaja_edit();
  });
    
  $routes->get('/Tuote/Tuotesivu', function() {
    TuoteController::tuote_show();
  });
  
  $routes->get('/Tuote/Lisaatuote', function() {
    TuoteController::tuote_add();
  });
  
  $routes->get('/Tuote/Tuotteidenlistaus', function() {
    TuoteController::tuote_list();
  });
  
  $routes->get('/Tuote/Tuotteenhakeminen', function() {
    TuoteController::tuote_search();
  });
  
  $routes->post('/find_tuote', function(){
    TuoteController::find_tuote();
  });
  
  $routes->post('/find_tuotteennimi', function(){
    TuoteController::find_tuotteennimi();
  });
  
    $routes->post('/Tuote/Tallenna', function(){
    TuoteController::tallenna();
  });
  
  $routes->get('/Tuote/Tuotetietojenmuutos', function() {
    TuoteController::tuote_edit();
  });
  
  $routes->get('/Varasto/Varastotilanteenmuutos', function() {
    VarastoController::varasto_edit();
  });
  
  $routes->get('/Varasto/Varastonlistaus', function() {
      VarastoController::varasto_list();
  });



