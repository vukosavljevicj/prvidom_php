<?php
 require '../konekcija.php';
 require '../model/destinacija.php';
 require '../model/vrsta.php';


 if(isset($_POST['destinacijaId']) && isset($_POST['vrsta'])&& isset($_POST['nazivDestinacije']) && isset($_POST['brojLjudi']) ){
  $destinacijaId=$_POST['destinacijaId'];
  $nazivDestinacije=$_POST['nazivDestinacije'];
  $brojLjudi=$_POST['brojLjudi'];


  $destinacija=new Destinacija($destinacijaId,$nazivDestinacije,$brojLjudi);
  $rezultat=$destinacija->update($conn);
  
  if($rezultat){
    echo 'Ok';
 }else{ 
   echo 'No';
   echo $status;
 }
 } 
  ?>