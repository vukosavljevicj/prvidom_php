<?php
include 'konekcija.php';
include 'model/destinacija.php';
include 'model/vrsta.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php          
if (isset($_POST['vrsta'])) {
  $icko = $_POST['vrsta'];
}
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>

<body class="stranica" style="margin-bottom:100px ;background-image: url(https://images.unsplash.com/photo-1586191582151-f73872dfd183?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=869&q=80); 
    background-repeat: no-repeat;
    background-size: 2000px 1300px;" >

<nav class="navbar navbar-expand-lg navbar-light" id="navCont" style="height:90px; background-color: #F4F4E9; ">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <a class="navbar-brand " href="index.php"style="color:#4E7779 ; margin-top:20px ;font-size:29px">Un turista</a>
                <div class="navbar-nav p-lg-0 " style="margin-left: 28%; color:white ; ">
                    <li><a id="btn-Pocetna" href="index.php" type="button" class="btn btn-success btn-block" style=" margin-left:25px ; margin-right:50px; background-color: #90C7CA;color:white; font-size:17px; font-weight:bold " ">
                        Home</a></li>
                    <li><a id="btn-Dodaj" type="button" class="btn btn-success btn-block"  data-toggle="modal" data-target="#my" style=" margin-left:50px ; margin-right:80px; background-color:#90C7CA ;color:white; font-size:17px; font-weight:bold">
                        Dodaj </a></li>
                    <li><a id="btn-Prikazi" href="pogledajDestinacije.php" type="button" class="btn btn-success btn-block"style=" margin-left:80px; margin-right:100px; background-color:#90C7CA ;color:white; font-size:17px; font-weight:bold">
                        Destinacije</a></li>
                    <li><a id="btn-Pocetna" href="odjava.php" type="button" class="btn btn-success btn-block" style=" color:white; margin-left:100px; background-color:#b7c098 ;color:white; font-size:17px; font-weight:bold ">
                    Odjava</a> </li>
                </div>
                
            </div>
    </nav>

    <div class="modal fade" id="my" role="dialog" style="margin-top:10px ;">
        <div class="modal-dialog" >

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" >
                    <div class="container prijava-form">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color:#e37929; text-align: left ">Dodaj novu destinaciju</h3>
                            <div class="row" style="margin-right:650px">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label style="color:#e37929" for="">Naziv destinacije</label>
                                        <input type="text" style="border: 1px solid black" name="nazivDestinacije" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label style="color:#e37929"for="">Broj Ljudi</label>
                                        <input type="text" style="border: 1px solid black" name="brojLjudi" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label style="color:#e37929" for="">Cena aranzmana</label>
                                        <input type="text" style="border: 1px solid black" name="cena" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <select id="vrstaId" name="vrstaId" class="form-control">
                                            <?php
                                            $rez = $conn->query("SELECT * from vrsta");
                                            while ($red = $rez->fetch_array()) {
                                            ?>
                                                <option name="value" value="<?php echo $red['vrstaId'] ?>"> <?php echo $red['nazivVrste'] ?></option>
                                            <?php  }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color: #90C7CA">
                                            Dodaj destinaciju</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--lista svih destinacija -->
 
  <div class="container pt">
    <?php
    $niz = [];
    $rez = $conn->query("select * from destinacija d join vrsta v on d.vrstaId=v.vrstaId");
    while ($red = $rez->fetch_array()) {
      $Vrsta = new Vrsta($red['vrstaId'], $red['nazivVrste']);
      $destinacija = new Destinacija($red['destinacijaId'], $red['nazivDestinacije'], $red['brojLjudi'],$red['cena'], $Vrsta);
      array_push($niz, $destinacija);
    }
    ?>
    <p id="p" style="color:white; font-size:35px ;padding-top:30px; padding-bottom:10px">Prikaz:</p>
    <table class="table table-hover">
      <thead style="font-weight:500px ;background-color:#e37929; color:white">
        <tr>
          <th>Naziv destinacije</th>
          <th>Broj ljudi</th>
          <th>Cena</th>
          <th>Vrsta putovanja</th>
          <th>Obrisi</th>
          <th>Izmeni</th>
        </tr>
      </thead>
      <tbody style="color:#e37929; font-size:20px ; font-weight: bold; ">
        <?php
        foreach ($niz as $vrednost) {
        ?>
          <tr>
            <td style="display:none" data-target="vrstaId"><?php echo $vrednost->vrstaId->vrstaId?></td>
            <td data-target="nazivDestinacije"><?php echo $vrednost->nazivDestinacije ?> </td>
            <td data-target="brojLjudi"><?php echo $vrednost->brojLjudi ?> </td>
            <td data-target="cena"><?php echo $vrednost->cena ?> </td>
            <td data-target="vrstaId"><?php echo $vrednost->vrstaId->nazivVrste ?></td>
            <td><button id="btnObrisi" name="btnObrisi" class="btn btn-danger" style="background-color:#C3BA9B ; color:white ; font-weight:bold; padding-top:10px; font-size:17px"
            data-id1="<?php echo $vrednost->destinacijaId ?>">Obrisi</a></td>
            <td><button class="btn btn-info" data-toggle="modal" style="background-color:#90C7CA ; color:white ; font-weight:bold; padding-top:10px; font-size:17px"
            data-target="#my1" data-id2="<?php echo $vrednost->destinacijaId ?>">Izmeni</a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

  </div>

<!--kartica azuriraj -->
<div class="modal fade" id="my1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="container prijava-form">
            <form action="#" method="post" id="izmeniForma">


              <h3 style="color: #90C7CA; text-align:left ;font-size:25px">Azuriraj podatke o destinaciji</h3>
              <div class="row" style="margin-right:650px">
                <div class="col-md-11 ">

                  <div style="display: none;" class="form-group">
                    <label for="">destinacijaId</label>
                    <input  id="destinacijaId" type="text" style="border: 1px solid #90C7CA" name="destinacijaId" class="form-control" />
                  </div>

                  <div class="form-group" style="display: none;">
                    <label style="color:#e37929;font-size:18px" for="">vrstaId</label>
                    <input id="vrstaId"  type="text" style="border: 1px solid #90C7CA" name="vrsta" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label style="color:#e37929;font-size:18px" for="">Naziv destinacije</label>
                    <input id="nazivDestinacije" type="text" style="border: 1px solid #90C7CA" name="nazivDestinacije" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label style="color:#e37929;font-size:18px" for="">Broj ljudi</label>
                    <input id="brojLjudi" type="text" style="border: 1px solid #90C7CA" name="brojLjudi" class="form-control" />
                  </div>
                 
                  <div class="form-group">
                    <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="background-color:#4E7779 ; color:white ; font-weight:bold; padding-top:10px; font-size:17px">
                    Izmeni destinaciju</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

  </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    
    
</body>

</html>