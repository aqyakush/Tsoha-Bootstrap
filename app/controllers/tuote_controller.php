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
        // Alustetaan uusi Tuote-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = array(
          'kuva' => $params['kuva'],
          'nimi' => $params['nimi'],
          'hinta' => $params['hinta'],
          'kuvaus' => $params['kuvaus']
        ); 
        $tuote = new Tuote($attributes);
        $errors = $tuote->errors();

        if(count($errors) == 0){
        // Tuote on validi, hyvä homma!
            $tuote->save();

            Redirect::to('/products/' . $tuote->ttunnus, array('message' => 'Tuote on lisätty valikoimaan!'));
        }else{
            // Tuotessä oli jotain vikaa :(
            View::make('ostoskassi/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        
  }
   public static function create(){
        View::make('ostoskassi/new.html');
   }
   
   //tuotteen muokkaminen (lomakkeen esittäminen)
   public static function edit($ttunnus){
    $tuote = Tuote::find($ttunnus);
    View::make('ostoskassi/edit.html', array('attributes' => $tuote));
  }
  //tuotteen muokkaaminen(lomakkeen käsittely)
   public static function update($ttunnus){
    $params = $_POST;
        // Alustetaan uusi Tuote-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = array(
          'ttunnus' => $ttunnus,
          'kuva' => $params['kuva'],
          'nimi' => $params['nimi'],
          'hinta' => $params['hinta'],
          'kuvaus' => $params['kuvaus']
        ); 
        
    // Alustetaan Tuote-olio käyttäjän syöttämillä tiedoilla
    $tuote = new Tuote($attributes);
    $errors = $tuote->errors();

    if(count($errors) > 0){
      View::make('ostoskassi/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      // Kutsutaan alustetun olion update-metodia, joka päivittää tuotteen tiedot tietokannassa
      $tuote->update($ttunnus);

      Redirect::to('/lalalaal' , array('message' => 'Tuotetta on muokattu onnistuneesti!'));
    }
  }
  public static function destroy($ttunnus){
    // Alustetaan Game-olio annetulla id:llä
    $tuote = new Tuote(array('ttunnus' => $ttunnus));
    // Kutsutaan Game-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $tuote->destroy($ttunnus);

    // Ohjataan käyttäjä tuotteen listaussivulle ilmoituksen kera
    Redirect::to('/products', array('message' => 'Tuote on poistettu onnistuneesti!'));
  }
    
}
