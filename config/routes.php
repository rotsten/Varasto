<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/Suunnitelmat/Login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/Suunnitelmat/Paasivu', function() {
    HelloWorldController::paasivu_show();
  });
  
  $routes->get('/Suunnitelmat/Varasto-kansi', function() {
    HelloWorldController::show_kuva();
  });
  
  $routes->get('/Suunnitelmat/Tuotesivu', function() {
    HelloWorldController::tuote_show();
  });
  
  $routes->get('/Suunnitelmat/Tuotteidenlistaus', function() {
    HelloWorldController::tuote_list();
  });
  
  $routes->get('/Suunnitelmat/Tuotteenhakeminen', function() {
    HelloWorldController::tuote_search();
  });
  
  $routes->get('/Suunnitelmat/Tuotetietojenmuutos', function() {
    HelloWorldController::tuote_edit();
  });
  
  $routes->get('/Suunnitelmat/Varastotilanteenmuutos', function() {
    HelloWorldController::varasto_show();
  });
  
  $routes->get('/Suunnitelmat/Varastolistaus', function() {
    HelloWorldController::varasto_list();
  });

  $routes->get('/Suunnitelmat/Kayttajienlistaus', function() {
    HelloWorldController::kayttaja_list();
  });

