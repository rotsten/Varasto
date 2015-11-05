<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('handle_reg()', function() {
    HelloWorldController::handle_reg();
  });

  $routes->get('Suunnitelmat/Login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/Suunnitelmat/Paasivu', function() {
    HelloWorldController::paasivu_show();
  });
  
  $routes->get('/Suunnitelmat/Tuotesivu', function() {
    HelloWorldController::tuote_show();
  });
  
  $routes->get('/Suunnitelmat/Tuotelistaus', function() {
    HelloWorldController::tuote_list();
  });
  
  $routes->get('/Suunnitelmat/Kayttajienlistaus', function() {
    HelloWorldController::kayttaja_list();
  });

  $routes->get('/Suunnitelmat/Varastotilanteenmuutos', function() {
    HelloWorldController::varasto_show();
  });
  
  $routes->get('/Suunnitelmat/Varastolistaus', function() {
    HelloWorldController::varasto_list();
  });

  $routes->get('/Suunnitelmat/Aloitussivu', function() {
    HelloWorldController::handle_reg();
  });
