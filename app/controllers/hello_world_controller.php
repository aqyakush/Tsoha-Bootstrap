<?php
  //require 'app/models/Tuote.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/front_page.html');
    }

    public static function sandbox(){
        //$iphone1 = new Tuote(array('ttunnus' => 1, 'nimi' => 'Iphone 7','hinta'=>'999.99', 'kuvaus' => 'it is okay'));
        $iphone = Tuote::find(1);
        $tuotteet = Tuote::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($tuotteet);
        Kint::dump($iphone);
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
