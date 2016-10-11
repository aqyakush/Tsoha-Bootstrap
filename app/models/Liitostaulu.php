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
    }
    
    public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Liitostaulu');
        $query->execute();
        $rows = $query->fetchAll();
        $taulut = array();
        foreach($rows as $row){
            $taulut[]=new Liitostaulu(array(
                'otunnus' => $row['otunnus'],
                'ttunnus' => $row['ttunus']
                
            ));
       
        }
        
        return $taulut;
    }
    public static function find($otunnus){
        $query = DB::connection()->prepare('SELECT * FROM Liitostaulu WHERE otunnus = :otunnus');
        $query->execute(array('otunnus' => $otunnus));
        $row = $query->fetch();

        if($row){
            $taulu = new Liitotaulu(array(
            'otunnus' => $row['otunnus'],
            'ttunnus' => $row['ttunus']
      ));

      return $taulu;
    }

    return null;
    }
    public static function findt($ttunnus){
        $query = DB::connection()->prepare('SELECT * FROM Liitostaulu WHERE ttunnus = :ttunnus');
        $query->execute(array('ttunnus' => $ttunnus));
        $row = $query->fetch();
        $taulut = array();
        if($row){
            $taulut[] = new Liitostaulu(array(
            'otunnus' => $row['otunnus'],
            'ttunnus' => $row['ttunnus']
      ));

      return $taulut;
    }

    return null;
    }
}
