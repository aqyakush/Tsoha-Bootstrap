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
        $this->validators = array('validate_nimi','validate_hinta','validate_kuvaus');
    }
    
    //esitää kaikki tuotteet
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
    
    //etsi tuotte tuotenumerolla
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
    
    //talenna tuote
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO TUOTE (kuva, nimi,hinta,kuvaus) VALUES (:kuva, :nimi, :hinta, :kuvaus) RETURNING ttunnus');
        $query->execute(array('kuva' => $this->kuva, 'nimi' => $this->nimi, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
        $this->ttunnus = $row['ttunnus'];
  }
  public function validate_nimi(){
      $errors = array();
      if($this->nimi==''||$this->nimi==null){
          $errors[]='Nimi ei saa olla tyhjä';
      } if(strlen($this->nimi)<3){
          $errors[]='Nimen pituuden tulee ovlla vähintään kolme merkkiä!';
      }
      return $errors;
  }
  public function validate_hinta(){
      $errors= array();
      if($this->hinta==''||$this->hinta==null){
          $errors[]='Hinta ei saa olla tyhjä';
      } if(!(is_numeric($this->hinta))){
          $errors[]='Hinta ei saa olla muu kuin numero';
      } if($this->hinta<=0){
          $errors[]='Hinta ei saa olla nolla tai pienempi';
      }
      return $errors;
  }
  public function validate_kuvaus(){
      $errors=array();
      if($this->kuvaus==''||$this->kuvaus==null){
          $errors[]='Kuvaus ei saa olla tyhjä';
      } if (strlen($this->kuvaus)>300){
          $errors[]='Hinta ei saa olla pidempi kuin 300 merkkiä';
      } if (strlen($this->kuvaus)<5){
          $errors[]='Kuvauksen pituuden tulee olla vähintään viisi merkkiä';
      }
      return $errors;
  }
  
  //päivittää tuotteen tiedot
  public function update($ttunnus){
        $query = DB::connection()->prepare('UPDATE TUOTE SET kuva=:kuva, nimi=:nimi,hinta=:hinta,kuvaus=:kuvaus where ttunnus = :ttunnus');
        $query->execute(array('ttunnus' => $this->ttunnus, 'kuva' => $this->kuva, 'nimi' => $this->nimi, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus));
     
  }
  
  //poistaa tuote liitostaulusta, tilauksista. Jos tilauksessa on muita tuoteita nii se poistaa vaa
  //poistettu tuote, jos tilauksessa ei ole muita tuoteita se poistaa koko tilaus
   public function destroy(){
       $query1 = DB::connection()->prepare('DELETE FROM LIITOSTAULU WHERE  ttunnus = :ttunnus');
       $query1->execute(array('ttunnus' => $this->ttunnus));
       $tilaukset = Tilaus::all();
       foreach ($tilaukset as $tilaus){
            $queryh = DB::connection()->prepare('SELECT otunnus FROM Liitostaulu WHERE  otunnus = :otunnus');
            $queryh->execute(array('otunnus' => $tilaus->otunnus));
            $row = $queryh->fetch();
            if ($row == null){
                $query = DB::connection()->prepare('DELETE FROM TILAUS WHERE  otunnus = :otunnus');
                $query->execute(array('otunnus' => $tilaus->otunnus));
            }
       }
        $query2 = DB::connection()->prepare('DELETE FROM TUOTE WHERE  ttunnus = :ttunnus');
        $query2->execute(array('ttunnus' => $this->ttunnus));
        
     }
  
   
}