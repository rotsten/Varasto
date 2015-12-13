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
  
  function check_logged_in(){
    BaseController::check_logged_in();
  }

  // Kirjautumisen jälkeen pääsivun esittely
  $routes->get('/Paasivu', function() {
    KayttajaController::paasivu_show();
  });
  
  // Uloskirjautumisen käsittely          
   $routes->get('/Kayttaja/Logout', function() {
    BaseController::logout();
  });
  
  // Käyttäjän lisäyslomakkeen näyttäminen
  $routes->get('/Kayttaja/LisaaKayttaja', 'check_logged_in', function(){
    KayttajaController::kayttaja_lisaa_show();
  });
  
  // Uuden käyttäjän lisääminen
  $routes->post('/Kayttaja/LisaaKayttaja', 'check_logged_in', function(){
    KayttajaController::kayttaja_create();
  });
  
  // Käyttäjien listaussivun näyttäminen
  $routes->get('/Kayttaja/Kayttajienlistaus', 'check_logged_in', function(){
    KayttajaController::kayttajalistaus(1);
  });
  
  // Näyttää käyttäjätietojen muutossivun
  $routes->get('/Kayttaja/Kayttajatietojenmuutos/:kayttajatunnus', 'check_logged_in', function($kayttajatunnus) {
    KayttajaController::kayttaja_edit($kayttajatunnus);
  });
  
  // Ottaa vastaan kayttajatietojen muutokset
  $routes->post('/Kayttaja/Kayttajatietojenmuutos/:kayttajatunnus', 'check_logged_in', function($kayttajatunnus) {
    KayttajaController::kayttaja_edit_post($kayttajatunnus);
  });

  // Näyttää käyttäjätiedot
  $routes->get('/Kayttaja/Kayttajasivu/:kayttajatunnus', 'check_logged_in', function($kayttajatunnus) {
    KayttajaController::kayttaja_show($kayttajatunnus);
  });
  
  // Poistaa käyttäjätiedot
  // Kayttajan poistaminen  
  $routes->get('/Kayttaja/Poistakayttaja/:kayttajatunnus', 'check_logged_in', function($kayttajatunnus){
    KayttajaController::poista_kayttaja($kayttajatunnus);
  });
  
  // Yksi poista-toiminto riittää...
  $routes->post('/Kayttaja/Kayttajienlistaus/:kayttajatunnus', 'check_logged_in', function($kayttajatunnus){
    KayttajaController::poista_kayttaja($kayttajatunnus);
  });
  
  // Tuotteisiin liittyvät 
  // Tuotteen lisäyslomakkeen näyttäminen
  $routes->get('/Tuote/Lisaatuote', 'check_logged_in', function(){
    TuoteController::tuote_lisaa_show();
  });
  
  // uuden tuotteen lisääminen
  $routes->post('/Tuote/Lisaatuote', 'check_logged_in', function(){
    TuoteController::tuote_create();
  });
   
  // tuotteiden listaaminen 
  $routes->get('/Tuote/Tuotteidenlistaus', 'check_logged_in', function() {
    TuoteController::tuote_list(1);
  });
  
  // tuotteiden listaaminen 
  $routes->get('/Tuote/Tuotteidenlistaus/:page', 'check_logged_in', function($page) {
    TuoteController::tuote_list($page);
  });
  
  // Tulostaa tuotteen hakusivun
  $routes->get('/Tuote/Tuotteenhakeminen', 'check_logged_in', function() {
    TuoteController::tuote_hae_show();
  });
  
  // Tulostaa tuotteen hakutulokset (haettu tuote-id:llä) tuotesivulle 
  $routes->post('/Tuote/Tuotteenhakeminen', 'check_logged_in', function(){
   TuoteController::tuote_search();
  });
   
  $routes->get('/Tuote', 'check_logged_in', function(){
    TuoteController::index();
  });

  $routes->get('/Tuote/Lisaatuote', 'check_logged_in', function(){
    TuoteController::tuote_create();
  });

  $routes->get('/Tuote/:tuote_id', 'check_logged_in', function($tuote_id){
    TuoteController::tuote_show($tuote_id);
  });
  
  // Näyttää tuotetietojen muutossivun
  $routes->get('/Tuote/Tuotetietojenmuutos/:tuote_id', 'check_logged_in', function($tuote_id) {
    TuoteController::tuote_edit($tuote_id);
  });
  
  // Ottaa vastaan muutokset
  $routes->post('/Tuote/Tuotetietojenmuutos/:tuote_id', 'check_logged_in', function($tuote_id) {
    TuoteController::tuote_edit_post($tuote_id);
  });
  
  // Näyttää tuotetiedot
  $routes->get('/Tuote/Tuotesivu/:tuote_id', 'check_logged_in', function($tuote_id) {
    TuoteController::tuote_show($tuote_id);
  });
  
  // Tuotteen poistaminen  
  $routes->get('/Tuote/Poistatuote/:tuote_id', 'check_logged_in', function($tuote_id){
    TuoteController::poista_tuote($tuote_id);
  });
  
  /*
  $routes->get('/Tuote/Tuotteidenlistaus:tuote_id', 'check_logged_in', function($tuote_id){
    TuoteController::poista_tuote($tuote_id);
  });
  */
    
  // Varastoon liittyvät
  // varaston lisäyslomakkeen näyttäminen
  $routes->get('/Varasto/Lisaavarasto', 'check_logged_in', function(){
    VarastoController::varasto_lisaa_show();
  });
  
  // uuden varaston lisääminen
  $routes->post('/Varasto/Lisaavarasto', 'check_logged_in', function(){
    VarastoController::varasto_create();
  }); 
  
  // Varaston listaamiseen liittyvä sivu
  $routes->get('/Varasto/Varastonlistaus', 'check_logged_in', function() {
    VarastoController::varasto_list(1);
  });

  // Varaston muuttamiseen liittyvä sivu 
  $routes->get('/Varasto/Varastonmuutos/:varasto_id', 'check_logged_in', function($varasto_id) {
    VarastoController::varasto_edit($varasto_id);
  });
  
  $routes->post('/Varasto/Varastonmuutos/:varasto_id', 'check_logged_in', function($varasto_id) {
    VarastoController::varasto_edit_post($varasto_id);
  });
   
  // Näyttää yksittäisen varaston tiedot
  $routes->get('/Varasto/Varastosivu/:varasto_id', 'check_logged_in', function($varasto_id){
    VarastoController::varasto_show($varasto_id);
  });
  
  // Uuden varaston lisääminen 
  // Varaston poistaminen  
  $routes->get('/Varasto/Poistavarasto/:varasto_id', 'check_logged_in', function($varasto_id){
    VarastoController::poista_varasto($varasto_id);
  });
  
  // Koontitauluun Varasto-Tuote liittyvät
  // Tänne tulee yhdistettyjen taulujen listaus
  $routes->get('/VarastoTuote/Varastotilannelistaus/:varasto_id', 'check_logged_in', function($varasto_id){
    VarastoTuoteController::varastotilanne_show($varasto_id);
  });
  
  $routes->get('/VarastoTuote/Varastotilannelistaus', 'check_logged_in', function($varasto_id) {
    VarastoTuoteController::varasto_tuotetiedot_list($varasto_id);
  });
  
  // Lisätään uusi tuote-lukumäärä -tietopari varasto-tuote -tauluun
  $routes->get('/VarastoTuote/Lisaauusivarastotuote/:varasto_id', 'check_logged_in', function($varasto_id) {
    VarastoTuoteController::varastotuote_lisaa_show($varasto_id);
  });

  $routes->post('/VarastoTuote/Lisaauusivarastotuote', 'check_logged_in', function(){
    VarastoTuoteController::varastotuote_lisaa_post();
  });
  
  // Varaston muuttamiseen (varaston inventointiin) liittyvä sivu
  // Tämä kohdistuisi jatkossa VARASTO_TUOTE-tauluun, joka tarvitsee hakuavaimeiksi varasto_id:n + tuote_id:n.
  // Tiedot haetaan tuote_id:tä käyttäen.
 
  $routes->get('/VarastoTuote/Lukumaaratiedonmuuttaminen/:varasto_id/:tuote_id', 'check_logged_in', function($varasto_id, $tuote_id) { 
    VarastoTuoteController::varastotuote_edit($varasto_id, $tuote_id);
  });
  
  // Ottaa vastaan muutokset (lukumäärän muutokset)
  // Tämä kohdistuisi jatkossa VARASTO_TUOTE-tauluun...
  $routes->post('/VarastoTuote/Lukumaaratiedonmuuttaminen/:varasto_id/:tuote_id', 'check_logged_in', function($varasto_id, $tuote_id, $lukumaara) {
    VarastoTuoteController::varastotuote_edit_post($varasto_id, $tuote_id, $lukumaara);
  });
 