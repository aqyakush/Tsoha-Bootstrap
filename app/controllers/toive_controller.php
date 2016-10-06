<?php
class toive_controller extends BaseController {
    public static function index(){
        //Haetaan kaikki tuotteet tietokannas
        $toiveet = Toive::all();
        //put your code here
        View::make('ostoskassi/Wishes1.html', array('toiveet' => $toiveet));
    }
    public static function create(){
       self::check_logged_in();
        View::make('ostoskassi/add_wish.html');
   }
   
    public static function store($atunnus){
        self::check_logged_in();
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Tuote-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = array(
          'atunnus' => $atunnus,
          'lento' => $params['lento'],
          'toive' => $params['toive'],
        ); 
        $toive = new Toive($attributes);
        $toive->save();

        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/wishes/' . $toive->atunnus, array('message' => 'Peli on lisätty kirjastoosi!'));
        
  }
}
