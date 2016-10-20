<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asiakas
 *
 * @author jaa
 */
class Asiakas extends BaseModel{
    public $atunnus, $nimi, $salasana, $oikeuksia;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        $query->execute();
        $rows = $query->fetchAll();
        $asiakkaat = array();
        foreach($rows as $row){
            $asiakkaat[]=new Asiakas(array(
                'atunnus' => $row['atunnus'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana'],
                'oikeuksia' => $row['oikeuksia']
            ));
       
        }
        
        return $asiakkaat;
    }
    public static function find($atunnus){
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE atunnus = :atunnus LIMIT 1');
        $query->execute(array('atunnus' => $atunnus));
        $row = $query->fetch();

        if($row){
            $asiakas = new Asiakas(array(
            'atunnus' => $row['atunnus'],
            'nimi' => $row['nimi'],
            'salasana' => $row['salasana'],
            'oikeuksia' => $row['oikeuksia']
      ));

      return $asiakas;
    }

    return null;
    }
    public static function authenticate($nimi, $salasana){
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if($row){
            $asiakas = new Asiakas(array(
            'atunnus' => $row['atunnus'],
            'nimi' => $row['nimi'],
            'salasana' => $row['salasana'],
            'oikeuksia' => $row['oikeuksia']
            ));

            return $asiakas;  
        }else{
            return null;
        }
    }
}
