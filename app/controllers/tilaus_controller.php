<?php

class tilaus_controller extends BaseController {
    public static function index(){
        //Haetaan kaikki tilaukset tietokannas
        $tilaukset = Tilaus::all();
        View::make('ostoskassi/Tilaukset.html', array('tilaukset' => $tilaukset));
    }
    
    //Talenettaan tilaus uudeksi tilaukseksi jos tällä asikkaalla tietylle lennolle ei ole tilausta,
    //mikäli asiakkaalla on jos tilaus tälle lennolle, niin haetaan se tilaus ja laittettaan tuote sinne
    public static function store($atunnus,$ttunnus){
        self::check_logged_in();
        $asiakas = Asiakas::find($atunnus);
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
           
                // Ohjataan käyttäjä lisäyksen jälkeen tilaus sivulle
                Redirect::to('/Orders', array('message' => 'Tilaus on lisätty!'));
            }else{
                // Tilauksessa oli jotain vikaa :(
                $tuote= Tuote::find($ttunnus);
                View::make('ostoskassi/Buy_product.html', array('errors' => $errors, 'attributes' => $attributes, 'tuote'=>$tuote));
            } 
        } else {
            Liitostaulu::save($tilaus->otunnus ,$ttunnus);
            Redirect::to('/Orders', array('message' => 'Tuote on lisätty!'));
        }
               
  }
   //ostettaan tuote, kun asiakas painna ostaa, siirretään buy_product sivulle
  //sivussa lukee tuote ja hinta, tämän takia pitä hakea ttunnus.
   public static function create($ttunnus){
       self::check_logged_in();
       $tuote = Tuote::find($ttunnus);
       View::make('ostoskassi/Buy_product.html', array('tuote' => $tuote));
   }
   
  //poistaa tilaus 
  public static function destroy($otunnus){
    self::check_logged_in();
    $tilaus = new Tilaus(array('otunnus' => $otunnus));
    $tilaus->destroy();
    Redirect::to('/Orders', array('message' => 'Tuote on poistettu onnistuneesti!'));
  }
  
  //näyttää tilauksen tiedot
  public static function show($otunnus){
    self::check_logged_in();
    $tilaus = Tilaus::find($otunnus); 
    $products = Tilaus::tilaus($otunnus);
    View::make('ostoskassi/order_show.html', array('products' => $products, 'tilaus'=> $tilaus));
  }
   
    
}
