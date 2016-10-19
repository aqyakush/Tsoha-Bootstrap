<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Liitostaulu
 *
 * @author jaa
 */
class Liitostaulu extends BaseModel{
    public $otunnus, $ttunnus;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_lento');
    }
    
    public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Liitostaulu');
        $query->execute();
        $rows = $query->fetchAll();
        $taulut = array();
        foreach($rows as $row){
            $taulut[]=new Liitostaulu(array(
                'otunnus' => $row['otunnus'],
                'ttunnus' => $row['ttunnus']
                
            ));
       
        }
        
        return $taulut;
    }
    public static function find($otunnus){
        $query = DB::connection()->prepare('SELECT * FROM Liitostaulu WHERE otunnus = :otunnus');
        $query->execute(array('otunnus' => $otunnus));
        $rows = $query->fetch();
        $taulut = array();
        foreach($rows as $row){
            $taulut[] = new Liitostaulu(array(
            'otunnus' => $row['otunnus'],
            'ttunnus' => $row['ttunnus']
        )); 
    }

    return $taulut;
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
    
    
    public function save($otunnus, $ttunnus){
        $query1 = DB::connection()->prepare('INSERT INTO LIITOSTAULU (otunnus, ttunnus) VALUES (:otunnus, :ttunnus)');
        $query1->execute(array('otunnus' => $otunnus, 'ttunnus' => $ttunnus));
        
    }
}
