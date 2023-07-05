<?php
class Destinacija{
  public $destinacijaId;
  public $nazivDestinacije;
  public $brojLjudi;
  public $cena;
  public $vrstaId;

  function __construct($destinacijaId=null,$nazivDestinacije=null,$brojLjudi=null,$cena=null,$vrstaId=null) {
        $this->destinacijaId = $destinacijaId;
        $this->nazivDestinacije = $nazivDestinacije;
        $this->brojLjudi = $brojLjudi;
        $this->cena = $cena;
        $this->vrstaId=$vrstaId;
    }

    public function insert($conn){
      return $conn->query("INSERT INTO destinacija(nazivDestinacije,brojLjudi,cena,vrstaId) VALUES ('$this->nazivDestinacije','$this->brojLjudi','$this->cena','$this->vrstaId')");
  }

  public function delete($conn,$id){
    return $conn->query("DELETE FROM destinacija where destinacijaId=$id");
  }

  public function update($conn){
    return $conn->query("UPDATE destinacija SET nazivDestinacije='$this->nazivDestinacije',brojLjudi='$this->brojLjudi' where destinacijaId=$this->destinacijaId");
}

public static function getById($id, $conn){
  return $conn->query("SELECT * FROM destinacija WHERE destinacijaId = $id");
}


}

?>