<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tuote
 *
 * @author jaa
 */
class Tuote extends BaseModel{
    
    public $ttunnus, $kuva, $nimi, $hinta, $kuvaus;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        $query->execute();
        $rows = $query->fetchAll();
        $tuotteet = array();
        foreach($rows as $row){
            $tuotteet[]=new Tuote(array(
                'ttunnus' => $row['ttunnus'],
                'kuva' => $row['kuva'],
                'nimi' => $row['nimi'],
                'hinta' => $row['hinta'],
                'kuvaus' => $row['kuvaus']
            ));
       
        }
        
        return $tuotteet;
    }
    public static function find($ttunnus){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE ttunnus = :ttunnus LIMIT 1');
        $query->execute(array('ttunnus' => $ttunnus));
        $row = $query->fetch();

        if($row){
            $tuote = new Tuote(array(
            'ttunnus' => $row['ttunnus'],
            'kuva' => $row['kuva'],
            'nimi' => $row['nimi'],
            'hinta' => $row['hinta'],
            'kuvaus' => $row['kuvaus']
      ));

      return $tuote;
    }

    return null;
    }
    public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO TUOTE (kuva, nimi,hinta,kuvaus) VALUES (:kuva, :nimi, :hinta, :kuvaus) RETURNING ttunnus');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('kuva' => $this->kuva, 'nimi' => $this->nimi, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus));
    // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
    // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->ttunnus = $row['ttunnus'];
  }
}
