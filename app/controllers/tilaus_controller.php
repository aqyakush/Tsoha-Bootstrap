<?php

class tilaus_controller extends BaseController {
    public static function index(){
        //Haetaan kaikki tuotteet tietokannas
        $tilaukset = Tilaus::all();
        $liitostaulu = Liitostaulu::all();
        //put your code here
        View::make('ostoskassi/Tilaukset.html', array('tilaukset' => $tilaukset), array('liitostaulu' => $liitostaulu));
    }
    public static function store($atunnus,$ttunnus){
        self::check_logged_in();
        $asiakas = Asiakas::find($atunnus);
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $attributes = array(
          'atunnus' => $asiakas->atunnus,
          'lento' => $_POST['lento'],
        ); 
        $tilaus = new Tilaus($attributes);
        $errors = $tilaus->errors();
        if(count($errors) == 0){
            $tilaus->save($ttunnus);
           
        // Ohjataan käyttäjä lisäyksen jälkeen toiveiden esittelysivulle
            Redirect::to('/Orders', array('message' => 'Tilaus on lisätty!'));
        }else{
         // Toivessa oli jotain vikaa :(
            View::make('ostoskassi/Buy_product.html', array('errors' => $errors, 'attributes' => $attributes));
         }        
  }
   public static function create($ttunnus){
       self::check_logged_in();
       $tuote = Tuote::find($ttunnus);
       View::make('ostoskassi/Buy_product.html', array('tuote' => $tuote));
   }
   
   
  public static function destroy($otunnus){
    self::check_logged_in();
    // Alustetaan Game-olio annetulla id:llä
    $tilaus = new Tilaus(array('otunnus' => $otunnus));
    // Kutsutaan Game-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $tilaus->destroy();

    // Ohjataan käyttäjä tuotteen listaussivulle ilmoituksen kera
    Redirect::to('/products', array('message' => 'Tuote on poistettu onnistuneesti!'));
  }
    
}
