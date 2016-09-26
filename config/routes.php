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
  // Pelin lisääminen tietokantaan
  $routes->post('/products', function(){
      tuote_controller::store();
  });
    // Pelin lisäyslomakkeen näyttäminen
 
  $routes->get('/products/1', function() {
    HelloWorldController::product_show();
  });
  $routes->get('/products/modify', function() {
    HelloWorldController::product_modify();
  });
  $routes->get('/login', function() {
        HelloWorldController::login();
  });
