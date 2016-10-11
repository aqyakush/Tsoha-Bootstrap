<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  $routes->get('/frontpage', function() {
    HelloWorldController::front_page();
  });
   
   $routes->get('/products/new', function(){
      tuote_controller::create();
  });
  
  
  $routes->get('/products/:ttunnus/edit', function($ttunnus){
  // Tuotteen muokkauslomakkeen esittäminen
    tuote_controller::edit($ttunnus);
  });
  $routes->post('/products/:ttunnus/edit', function($ttunnus){
  // Tuotteen muokkaaminen
    tuote_controller::update($ttunnus);
  });
  
  $routes->get('/products/:ttunnus', function($ttunnus){
      tuote_controller::show($ttunnus);
  });
  $routes->post('/products', function(){
      tuote_controller::store();
   });
   $routes->get('/products', function() {
      tuote_controller::index();
  });
  

  $routes->post('/products/:ttunnus/destroy', function($ttunnus){
  // Tuotteen poisto
    tuote_controller::destroy($ttunnus);
  });
  $routes->get('/login', function(){
    // Kirjautumislomakkeen esittäminen
    asiakas_controller::login();
  });
  $routes->post('/login', function(){
    // Kirjautumisen käsittely
    asiakas_controller::handle_login();
  });
  $routes->post('/logout', function(){
    asiakas_controller::logout();
  });
  $routes->get('/Wishes', function(){
    toive_controller::index();
  });
  $routes->post('/Wishes/:atunnus', function($atunnus){
      toive_controller::store($atunnus);
   });
   // Toiven lisäyslomakkeen näyttäminen
   $routes->get('/Wishes/new', function(){
      toive_controller::create();
    });
    $routes->post('/Wishes/:atunnus/:lento/destroy', function($atunnus, $lento){
  // Tuotteen poisto
      toive_controller::destroy($atunnus,$lento);
    });
    //tilauksijen esitely sivu
   $routes->get('/Orders', function(){
       tilaus_controller::index();
   });
   $routes->post('/Order/:otunnus/destroy', function($otunnus){
       tilaus_controller::destroy($otunnus);
   });
    //tilauksijen esitely sivu
   $routes->post('/Order/:atunnus/:ttunnus', function($atunnus, $ttunnus){
       tilaus_controller::store($atunnus, $ttunnus);
   });
   $routes->get('/Order/:atunnus/:ttunnus', function($atunnus, $ttunnus){
       tilaus_controller::create($ttunnus);
   });
  
 
  
  
  
