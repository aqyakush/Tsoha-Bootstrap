<?php

  class BaseController{

    public static function get_user_logged_in(){
       if(isset($_SESSION['user'])){
            $atunnus = $_SESSION['user'];
            // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $user = Asiakas::find($atunnus);

            return $user;
    }

    // Käyttäjä ei ole kirjautunut sisään
    return null;
  }
    

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
