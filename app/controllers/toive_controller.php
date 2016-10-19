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
        $errors = $toive->errors();
        if(count($errors) == 0){
        // TOive on validi, hyvä homma!
            $toive->save();
           
        // Ohjataan käyttäjä lisäyksen jälkeen toiveiden esittelysivulle
            Redirect::to('/Wishes', array('message' => 'Toive on lisätty kirjastoosi!'));
        }else{
         // Toivessa oli jotain vikaa :(
            View::make('ostoskassi/add_wish.html', array('errors' => $errors, 'attributes' => $attributes));
         }
    }
    public static function destroy($atunnus, $lento){
        self::check_logged_in();
        // Alustetaan Game-olio annetulla id:llä
        $toive = new Toive(array('atunnus' => $atunnus, 'lento' => $lento));
        // Kutsutaan Game-malliluokan metodia destroy, joka poistaa pelin sen id:llä
        $toive->destroy();

        // Ohjataan käyttäjä tuotteen listaussivulle ilmoituksen kera
        Redirect::to('/Wishes', array('message' => 'Toive on poistettu onnistuneesti!'));
    }
    public static function edit($lento){
       self::check_logged_in();
       $toive = Toive::find($lento);
       View::make('ostoskassi/edit_wish.html', array('attributes' => $toive));
    }
     public static function update($atunnus, $lento){
       self::check_logged_in();
       $params = $_POST;
       $toive = new Toive(array(
            'atunnus' => $atunnus,
            'lento' => $lento,
            'toive' => $params['toive'],
            ));
        $errors = $toive->errors();
        if(count($errors) > 0){
          View::make('ostoskassi/edit_wish.html', array('errors' => $errors, 'attributes' =>$toive)); 
        }else{
          $toive->update();

          Redirect::to('/Wishes', array('message' => 'Tuotetta on muokattu onnistuneesti!'));
        }
      }
}

