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
     public function save($ttunnus){
    // Lisätään RETURNING ttunnus tietokantakyselymme loppuun, niin saamme lisätyn rivin ttunnus-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO TILAUS (atunnus, lento) VALUES (:atunnus, :lento) RETURNING otunnus');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->otunnus = $row['otunnus'];
        $query1 = DB::connection()->prepare('INSERT INTO LIITOSTAULU (otunnus, ttunnus) VALUES (:otunnus, :ttunnus)');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query1->execute(array('otunnus' => $this->otunnus, 'ttunnus' => $ttunnus));
        
  }
  public function savetuote($otunnus, $ttunnus){
        $query1 = DB::connection()->prepare('INSERT INTO LIITOSTAULU (otunnus, ttunnus) VALUES (:otunnus, :ttunnus)');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query1->execute(array('otunnus' => $otunnus, 'ttunnus' => $ttunnus));
        
  }
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
  public function destroy(){
        $query1 = DB::connection()->prepare('DELETE FROM LIITOSTAULU WHERE  otunnus = :otunnus');
        $query1->execute(array('otunnus' => $this->otunnus));
        $query = DB::connection()->prepare('DELETE FROM TILAUS WHERE  otunnus = :otunnus');
        $query->execute(array('otunnus' => $this->otunnus));
                
  }
  public static function tilaus($otunnus){
        $query = DB::connection()->prepare('SELECT Tilaus.otunnus as otunnus, Tuote.nimi as nimi, Tilaus.atunnus as atunnus, Tilaus.lento as lento, Tuote.hinta as hinta FROM Tilaus, Tuote, Liitostaulu WHERE Tuote.ttunnus = Liitostaulu.ttunnus and Tilaus.otunnus = Liitostaulu.otunnus and Tilaus.otunnus = :otunnus');
        $query->execute(array('otunnus' => $otunnus));
        $rows = $query->fetchAll();
        $tilaukset = array();
        foreach($rows as $row){
            $tilaukset[]= (array(
                'otunnus' => $row['otunnus'],
                'nimi' => $row['nimi'],
                'atunnus' => $row['atunnus'],
                'lento' => $row['lento'],
                'hinta' => $row['hinta']
         ));
        }
        return $tilaukset;
    }
}