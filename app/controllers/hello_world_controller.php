<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    public static function front_page(){
        View::make('suunnitelmat/front_page.html');
    }
    public static function product_list(){
        View::make('suunnitelmat/product_list.html');
    }
    public static function product_show(){
        View::make('suunnitelmat/product_show.html');
    }
    public static function product_modify(){
        View::make('suunnitelmat/product_modify.html');
    }
    
  }
