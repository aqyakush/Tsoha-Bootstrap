<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toive
 *
 * @author jaa
 */
class Toive extends BaseModel{
    public $atunnus, $toive, $lento;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Toiveet');
        $query->execute();
        $rows = $query->fetchAll();
        $toiveet = array();
        foreach($rows as $row){
            $toiveet[]=new Toiveet(array(
                'atunnus' => $row['atunnus'],
                'toive' => $row['toive'],
                'lento' => $row['lento']
            ));
       
        }
        
        return $toiveet;
    }
    public static function find($atunnus){
        $query = DB::connection()->prepare('SELECT * FROM Toiveet WHERE atunnus = :atunnus LIMIT 1');
        $query->execute(array('atunnus' => $atunnus));
        $row = $query->fetch();

        if($row){
            $toive = new Toive(array(
            'atunnus' => $row['atunnus'],
            'toive' => $row['toive'],
            'lento' => $row['lento']
      ));

      return $toive;
    }

    return null;
    }
    public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO TOIVE (atunnus, lento,toive) VALUES (:atunnus, :lento, :toive) ');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento, 'toive' => $this->toive));
  }
}
