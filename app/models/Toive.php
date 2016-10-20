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
    public $atunnus, $toive, $lento, $tila;
    
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
                'lento' => $row['lento'],
                'tila' => $row['tila']
            ));
       
        }
        
        return $toiveet;
    }
    public static function find($atunnus, $lento){
        $query = DB::connection()->prepare('SELECT * FROM Toiveet WHERE atunnus = :atunnus and lento = :lento LIMIT 1');
        $query->execute(array('atunnus' => $atunnus, 'lento' => $lento,));
        $row = $query->fetch();

        if($row){
            $toive = new Toive(array(
            'atunnus' => $row['atunnus'],
            'toive' => $row['toive'],
            'lento' => $row['lento'],
            'tila' => $row['tila']
      ));

      return $toive;
    }

    return null;
    }
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO TOIVEET (atunnus, lento,toive, tila) VALUES (:atunnus, :lento, :toive, :tila) ');
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento, 'toive' => $this->toive, 'tila'=> $this->tila));
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
          $errors[]='Toive ei saa olla pidempi kuin 300 merkkiä';
      } if (strlen($this->toive)<5){
          $errors[]='Toiveen pituuden tulee olla vähintään viisi merkkiä';
      }
      return $errors;
  }
  public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM TOIVEET WHERE  atunnus = :atunnus and lento = :lento');
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento));
        
   }
    public function update(){
        $query = DB::connection()->prepare('UPDATE TOIVEET SET toive=:toive where lento = :lento and atunnus= :atunnus');
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento, 'toive' => $this->toive));
     
  }
   public function updatetila(){
        $query = DB::connection()->prepare('UPDATE TOIVEET SET tila=1 where lento = :lento and atunnus= :atunnus');
        $query->execute(array('atunnus' => $this->atunnus, 'lento' => $this->lento));
     
  }
}
