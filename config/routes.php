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
    HelloWorldController::kayttaja_list();
  });
  
  $routes->get('/Kayttaja/Kayttajatietojenmuutos', function() {
    HelloWorldController::kayttaja_edit();
  });
    
  $routes->get('/Tuote/Tuotesivu', function() {
    HelloWorldController::tuote_show();
  });
  
  $routes->get('/Tuote/Lisaatuote', function() {
    HelloWorldController::tuote_add();
  });
  
  $routes->get('/Tuote/Tuotteidenlistaus', function() {
    HelloWorldController::tuote_list();
  });
  
  $routes->get('/Tuote/Tuotteenhakeminen', function() {
    HelloWorldController::tuote_search();
  });
  
  $routes->get('/Tuote/Tuotetietojenmuutos', function() {
    HelloWorldController::tuote_edit();
  });
  
  $routes->get('/Varasto/Varastotilanteenmuutos', function() {
    HelloWorldController::varasto_edit();
  });
  
  $routes->get('/Varasto/Varastonlistaus', function() {
    HelloWorldController::varasto_list();
  });



