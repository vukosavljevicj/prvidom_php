<?php
 require '../konekcija.php';
 require '../model/destinacija.php';


 if(isset($_POST['nazivDestinacije']) && isset($_POST['brojLjudi']) && isset($_POST['cena']) && isset($_POST['vrstaId'])){
  $destinacija = new Destinacija(null,$_POST['nazivDestinacije'],$_POST['brojLjudi'],($_POST['cena']),($_POST['vrstaId']));
  $rez=$destinacija->insert($conn);
  
  if($rez){ //ako vrati destinaciju
    echo 'Ok';
 }else{ 
   echo 'No';
 }
 } 
  ?>