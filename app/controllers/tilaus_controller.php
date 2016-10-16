<?php

class tilaus_controller extends BaseController {
    public static function index(){
        //Haetaan kaikki tuotteet tietokannas
        $tilaukset = Tilaus::all();
        //put your code here
        View::make('ostoskassi/Tilaukset.html', array('tilaukset' => $tilaukset));
    }
    public static function store($atunnus,$ttunnus){
        self::check_logged_in();
        $asiakas = Asiakas::find($atunnus);
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $tilaus = Tilaus::findal($atunnus,$_POST['lento']);
        if( $tilaus == null){
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
        } else {
            Tilaus::savetuote($tilaus->otunnus ,$ttunnus);
            Redirect::to('/Orders', array('message' => 'Tilaus on lisätty!'));
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
    Redirect::to('/Orders', array('message' => 'Tuote on poistettu onnistuneesti!'));
  }
  public static function show($otunnus){
    self::check_logged_in();
    $tilaus = Tilaus::find($otunnus); 
    $products = Tilaus::tilaus($otunnus);
    echo print_r($products);
        //put your code here
    View::make('ostoskassi/order_show.html', array('products' => $products, 'tilaus'=> $tilaus));
  }
   
    
}
