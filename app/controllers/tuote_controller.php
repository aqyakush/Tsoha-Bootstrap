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
        View::make('ostoskassi/product_list.html', array('tuotteet' => $tuotteet));
    }
    public static function show($ttunnus){
        // Haetaan pelit tietokannasta
        $tuote = Tuote::find($ttunnus);
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('ostoskassi/product_show.html', array('tuote' => $tuote));
    }
    public static function store(){
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
        $tuote = new Tuote(array(
          'kuva' => $params['kuva'],
          'nimi' => $params['nimi'],
          'hinta' => $params['hinta'],
          'kuvaus' => $params['kuvaus']
        ));
        
        //Kint::dump($params);

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $tuote->save();
        

        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/products/' . $tuote->ttunnus, array('message' => 'Tuote on lisätty valikoimaan!'));
  }
   public static function create(){
        View::make('ostoskassi/new.html');
   }
    
}
