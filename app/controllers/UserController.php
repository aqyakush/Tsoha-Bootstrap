<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author jaa
 */
class UserController extends BaseController{
    public static function login(){
      View::make('ostoskassi/login.html');
    }
    public static function handle_login(){
        $params = $_POST;

        $user = Asiakas::authenticate($params['atunnus'], $params['salasana']);

        if(!$user){
          View::make('ostoskassi/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'atunnus' => $params['atunnus']));
        }else{
          $_SESSION['user'] = $user->atunnus;
          Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->atunnus . '!'));
        }
  }
}
