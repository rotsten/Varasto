<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('Suunnitelmat/Tuotesivu', function() {
    HelloWorldController::tuote_list();
  });
  
  $routes->get('Suunnitelmat/Tuotelistaus', function() {
    HelloWorldController::tuote_show();
  });

  $routes->get('Suunnitelmat/Aloitussivu', function() {
    HelloWorldController::login();
  });
