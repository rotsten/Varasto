<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/game', function() {
    HelloWorldController::tuote_list();
  });
  
  $routes->get('/game/1', function() {
    HelloWorldController::tuote_show();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });
