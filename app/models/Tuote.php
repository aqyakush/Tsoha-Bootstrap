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
}
