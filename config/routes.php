<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  $routes->get('/frontpage', function() {
    HelloWorldController::front_page();
  });
   $routes->post('/products', function(){
      tuote_controller::store();
   });
   $routes->get('/products/new', function(){
      tuote_controller::create();
  });
  
  $routes->get('/products', function() {
      tuote_controller::index();
  });
  $routes->get('/products/:ttunnus', function($ttunnus){
      tuote_controller::show($ttunnus);
  });
  $routes->post('/products', function(){
      tuote_controller::store();
  });
  $routes->get('/products/:ttunnus/edit', function($ttunnus){
  // Tuotteen muokkauslomakkeen esittäminen
    tuote_controller::edit($ttunnus);
  });
  $routes->post('/products/:ttunnus/edit1', function($ttunnus){
  // Tuotteen muokkaaminen
    tuote_controller::update($ttunnus);
  });

  $routes->post('/products/:ttunnus/destroy', function($ttunnus){
  // Tuotteen poisto
    tuote_controller::destroy($ttunnus);
  });
  $routes->get('/login', function(){
    // Kirjautumislomakkeen esittäminen
    UserController::login();
  });
  $routes->post('/login', function(){
    // Kirjautumisen käsittely
    UserController::handle_login();
  });
 
  $routes->get('/products/1', function() {
    HelloWorldController::product_show();
  });
  $routes->get('/products/modify', function() {
    HelloWorldController::product_modify();
  });
  $routes->get('/login', function() {
        HelloWorldController::login();
  });
  
