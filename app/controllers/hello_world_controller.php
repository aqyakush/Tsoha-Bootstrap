<?php
  //require 'app/models/Tuote.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/front_page.html');
    }

    public static function sandbox(){
        $iphone1 = new Tuote(array('nimi' => 'Ip','hinta'=>'0.00', 'kuvaus' => 'it is okay,fsdpfkspfkspokfposkodpdfsdjfdsjofpofkopekpokewopwepofpoekfpowekfpowekfpowepj              poekropkweoprkowepkrpowekropewporweporpeowropweropweiporweopriowepiropewiropweiropiweporieopirpoweirpoweirpoweirpoweirpoweipofjksnflkdsnlkneoneonoisfoijrpiofajepifoisgnoeingoeinfegjoiehgirejtopgjognoaingoiegoiefgorogweignonienfoisnoiengoisnoinsegoinoeitniengsongoiengosbngoiengosinie'));
        //$iphone = Tuote::find(1);
        $errors=$iphone1->errors();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($errors);
        //Kint::dump($iphone);
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
    public static function login(){
        View::make('suunnitelmat/Login.html');
    }

    
  }
