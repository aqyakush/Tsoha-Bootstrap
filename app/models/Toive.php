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
        $this->validators = array('validate_lento','validate_toive');
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Toiveet');
        $query->execute();
        $rows = $query->fetchAll();
        $toiveet = array();
        foreach($rows as $row){
            $toiveet[]=new Toive(array(
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
        $query = DB::connection()->prepare('INSERT INTO TOIVEET (atunnus, lento,toive) VALUES (:atunnus, :lento, :toive) ');
    // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento, 'toive' => $this->toive));
  }
  public function validate_lento(){
    $errors = array();
    if($this->lento == '' || $this->lento == null){
        $errors[] = 'Lento ei saa olla tyhjä!';
    }
    if(10<strlen($this->lento) || strlen($this->lento) < 3){
        $errors[] = 'Lennon pituuden tulee olla vähintään kolme merkkiä ja maksimmisään 10 merkkiä!';
    }

    return $errors;
 }
 public function validate_toive(){
      $errors=array();
      if($this->toive==''||$this->toive==null){
          $errors[]='Toive ei saa olla tyhjä';
      } if (strlen($this->toive)>300){
          $errors[]='Hinta ei saa olla pidempi kuin 300 merkkiä';
      } if (strlen($this->toive)<5){
          $errors[]='Kuvauksen pituuden tulee olla vähintään viisi merkkiä';
      }
      return $errors;
  }
  public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM TOIVEET WHERE  atunnus = :atunnus and lento = :lento');
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento));
        
   }
}
