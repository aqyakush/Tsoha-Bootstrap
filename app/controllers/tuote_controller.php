<?php

class tuote_controller extends BaseController {
    public static function index(){
        $tuotteet = Tuote::all();
        View::make('ostoskassi/product_list.html', array('tuotteet' => $tuotteet));
    }
    public static function show($ttunnus){
        $tuote = Tuote::find($ttunnus);
        View::make('ostoskassi/product_show.html', array('tuote' => $tuote));
    }
    public static function store(){
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
          'kuva' => $params['kuva'],
          'nimi' => $params['nimi'],
          'hinta' => $params['hinta'],
          'kuvaus' => $params['kuvaus']
        ); 
        $tuote = new Tuote($attributes);
        $errors = $tuote->errors();

        if(count($errors) == 0){
            $tuote->save();

            Redirect::to('/products/' . $tuote->ttunnus, array('message' => 'Tuote on lisätty valikoimaan!'));
        }else{
            View::make('ostoskassi/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        
  }
   public static function create(){
       self::check_logged_in();
        View::make('ostoskassi/new.html');
   }
   
   //tuotteen muokkaminen (lomakkeen esittäminen)
   public static function edit($ttunnus){
       self::check_logged_in();
       $tuote = Tuote::find($ttunnus);
       View::make('ostoskassi/edit.html', array('attributes' => $tuote));
  }
  //tuotteen muokkaaminen(lomakkeen käsittely)
   public static function update($ttunnus){
       self::check_logged_in();
       $params = $_POST;

        $tuote = new Tuote(array(
                'ttunnus' => $ttunnus,
                'kuva' => $params['kuva'],
                'nimi' => $params['nimi'],
                'hinta' => $params['hinta'],
                'kuvaus' => $params['kuvaus']
                ));
        $errors = $tuote->errors();
        if(count($errors) > 0){
          View::make('ostoskassi/edit.html', array('errors' => $errors)); 
        }else{
          $tuote->update($ttunnus);

          Redirect::to('/products/'.$tuote->ttunnus, array('message' => 'Tuotetta on muokattu onnistuneesti!'));
        }
      }
  public static function destroy($ttunnus){
    self::check_logged_in();
    $tuote = new Tuote(array('ttunnus' => $ttunnus));
    $tuote->destroy();
    Redirect::to('/products', array('message' => 'Tuote on poistettu onnistuneesti!'));
  }
    
}
