<?php

class asiakas_controller extends BaseController{
    public static function login(){
      View::make('ostoskassi/login.html');
    }
    public static function handle_login(){
        $params = $_POST;

        $user = Asiakas::authenticate($params['nimi'], $params['salasana']);

        if(!$user){
          View::make('ostoskassi/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
        }else{
          $_SESSION['user'] = $user->atunnus;
          Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
        }
  }

    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }  
}

