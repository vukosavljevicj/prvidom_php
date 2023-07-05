<?php
    require '../konekcija.php';
    require '../model/vrsta.php';
    require '../model/destinacija.php';

    if(isset($_GET['vrstaId']))
    {
        $id = mysqli_real_escape_string($conn,$_GET['vrstaId']);
        $niz = [];
        $rez = $conn->query("select * from destinacija where vrstaId=$id");
        while($red=$rez->fetch_assoc()):
        $destinacije = new Destinacija($red['destinacijaId'],$red['nazivDestinacije'],$red['brojLjudi'],$red['cena'],$red['vrstaId']);
        array_push($niz,$destinacije);
        endwhile;
    ?>
    <table class="table table-hover"  >
    <thead style="font-weight:500px ;background-color:#e37929; color:white">
        <tr >
            <th scope="col">Naziv destinacije</th>
            <th scope="col">Cena</th>
            <th scope="col">Broj ljudi</th>
            <th scope="col">Vrsta destinacije</th>
        </tr>
    </thead>
    <tbody style=" color:yellow" >
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php
        foreach($niz as $vrednost):
            ?>
                <tr>
                <td> <?php echo $vrednost->nazivDestinacije  ?></td>
              <td><?php echo $vrednost->cena ?>  </td>
              <td><?php echo $vrednost->brojLjudi ?>  </td>
              <td><?php echo $vrednost->vrstaId ?>  </td>
                </tr>
            <?php
        endforeach;
        ?>
    </tbody>
    </table>
    <?php
    }else{
    echo("Molimo vas da prosledite vrstu za koji želite prikaz destinacija.");
    }
 ?>