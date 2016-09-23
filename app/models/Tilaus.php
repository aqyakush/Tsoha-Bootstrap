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
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus');
        $query->execute();
        $rows = $query->fetchAll();
        $tilaukset = array();
        foreach($rows as $row){
            $tilaukset[]=new Tilaus(array(
                'otunnus' => $row['otunnus'],
                'ttunnus' => $row['ttunnus'],
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
            'ttunnus' => $row['ttunnus'],
            'atunnus' => $row['atunnus'],
            'lento' => $row['lento']
      ));

      return $tilaus;
    }

    return null;
    }
}
