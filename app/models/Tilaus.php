<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tilaus
 *
 * @author jaa
 */
class Tilaus extends BaseModel{
    public $otunnus, $ttunnus, $atunnus, $lento;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_lento');
    }
    
    //etsii kaikki tilaukset
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus');
        $query->execute();
        $rows = $query->fetchAll();
        $tilaukset = array();
        foreach($rows as $row){
            $tilaukset[]=new Tilaus(array(
                'otunnus' => $row['otunnus'],
                'atunnus' => $row['atunnus'],
                'lento' => $row['lento']
            ));
       
        }
        
        return $tilaukset;
    }
    
    //etsii tilaus tilaus numerolla
    public static function find($otunnus){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE otunnus = :otunnus LIMIT 1');
        $query->execute(array('otunnus' => $otunnus));
        $row = $query->fetch();

        if($row){
            $tilaus = new Tilaus(array(
            'otunnus' => $row['otunnus'],
            'atunnus' => $row['atunnus'],
            'lento' => $row['lento']
      ));

      return $tilaus;
    }

    return null;
    }
    
    //etsi tilaus jolla on jo sama asiakas ja sama lento
    public static function findal($atunnus, $lento){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE atunnus = :atunnus and lento = :lento LIMIT 1');
        $query->execute(array('atunnus' => $atunnus, 'lento' => $lento));
        $row = $query->fetch();

        if($row){
            $tilaus = new Tilaus(array(
            'otunnus' => $row['otunnus'],
            'atunnus' => $row['atunnus'],
            'lento' => $row['lento']
      ));

      return $tilaus;
    }

    return null;
    }
    
    //tallenta tilaus
     public function save($ttunnus){
        $query = DB::connection()->prepare('INSERT INTO TILAUS (atunnus, lento) VALUES (:atunnus, :lento) RETURNING otunnus');
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento));
        $row = $query->fetch();
        $this->otunnus = $row['otunnus'];
        $query1 = DB::connection()->prepare('INSERT INTO LIITOSTAULU (otunnus, ttunnus) VALUES (:otunnus, :ttunnus)');
        $query1->execute(array('otunnus' => $this->otunnus, 'ttunnus' => $ttunnus));
        
  }
  //tarkistaa lennon tiedot oikeaksi
  public function validate_lento(){
    $errors = array();
    if($this->lento == '' || $this->lento == null){
        $errors[] = 'Lento ei saa olla tyhjä!';
    }
    if( strlen($this->lento) < 5){
        $errors[] = 'Lennon pituuden tulee olla vähintään viisi merkkiä ja';
    }
    if (strlen($this->lento) > 10){
        $errors[] = 'ei saa olla yli 10 merkkiä!';
    }

    return $errors;
 }
 //tuhoa tilaus ja kaikki liitostaulussa olevat tilaukset
  public function destroy(){
        $query1 = DB::connection()->prepare('DELETE FROM LIITOSTAULU WHERE  otunnus = :otunnus');
        $query1->execute(array('otunnus' => $this->otunnus));
        $query = DB::connection()->prepare('DELETE FROM TILAUS WHERE  otunnus = :otunnus');
        $query->execute(array('otunnus' => $this->otunnus));
                
  }
  
  //etsi kaikki tilaukset jolla on tietty tunnus ja palauttaa lista tavaroita mitkä ovat siinä tilauksessa
  public static function tilaus($otunnus){
        $query = DB::connection()->prepare('SELECT Tuote.nimi as nimi, Tuote.hinta as hinta FROM Tilaus, Tuote, Liitostaulu WHERE Tuote.ttunnus = Liitostaulu.ttunnus and Tilaus.otunnus = Liitostaulu.otunnus and Tilaus.otunnus = :otunnus');
        $query->execute(array('otunnus' => $otunnus));
        $rows = $query->fetchAll();
        $tilaukset = array();
        foreach($rows as $row){
            $tilaukset[]= (array(
                'nimi' => $row['nimi'],
                'hinta' => $row['hinta']
         ));
        }
        return $tilaukset;
    }
}