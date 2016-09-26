<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tuote_controller
 *
 * @author jaa
 */
class tuote_controller extends BaseController {
    public static function index(){
        //Haetaan kaikki tuotteet tietokannas
        $tuotteet = Tuote::all();
        //put your code here
        View::make('suunnitelmat/product_list.html', array('tuotteet' => $tuotteet));
    }
    public static function show($ttunnus){
        // Haetaan pelit tietokannasta
        $tuote = Tuote::find($ttunnus);
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('suunnitelmat/product_show.html', array('tuote' => $tuote));
    }
    
}
