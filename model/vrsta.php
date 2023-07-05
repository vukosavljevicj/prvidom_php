<?php
class Vrsta{
  public $vrstaId;
  public $nazivVrste;
  function __construct($vrstaId=null,$nazivVrste=null) {
        $this->vrstaId = $vrstaId;
        $this->nazivVrste = $nazivVrste;
    }
   
}
?>