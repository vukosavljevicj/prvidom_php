$('#dodajForm').submit(function () {
  event.preventDefault();
  console.log("Dodavanje");
  const $form = $(this);
  const $input = $form.find('input, select, button, textarea');

  const serijalizacija = $form.serialize();
  console.log(serijalizacija);

  $input.prop('disabled', true);

  req = $.ajax({
    url: 'handler/dodajDestinaciju.php',
    type: 'post',
    data: serijalizacija
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res.indexOf("Ok") != -1) {
      alert("Destinacija je dodata");
      location.reload(true);
    } else console.log("Destinacija nije dodata" + res);
});

  req.fail(function (jqXHR, textStatus, errorThrown) {
    console.error('Desila se greska: ' + textStatus, errorThrown)
  });
});



$('#btn').click(function () {
  $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
  $('#myModal').modal('toggle');
  return false;
});

$('#btnIzmeni').submit(function () {
  $('#myModal').modal('toggle');
  return false;
});

$("#vrsta").change(function(){
  var vrstaId =  $('#vrsta').val();
  $('#vrstaId').val(vrstaId);
  
});

//Edit
$('.btn-info').click(function () {

  const trenutni = $(this).attr('data-id2');
  console.log(trenutni);
  var nazivDestinacije = $(this).closest('tr').children('td[data-target=nazivDestinacije]').text();
  console.log(nazivDestinacije);
  var brojLjudi = $(this).closest('tr').children('td[data-target=brojLjudi]').text();
  var cena = $(this).closest('tr').children('td[data-target=cena]').text();
  console.log(cena);
  var vrstaId = $(this).closest('tr').children('td[data-target=vrstaId]').text();
  console.log(vrstaId);
  

  $('#destinacijaId').val(trenutni);
  $('#nazivDestinacije').val(nazivDestinacije);
  $('#brojLjudi').val(brojLjudi);
  document.getElementById('vrstaOznaceni').value = vrstaId;
});

$('.btn-danger').click(function () {
  console.log("Brisanje");
  const trenutni = $(this).attr('data-id1');  
  console.log('ID selektovane destinacije za brisanje je: ' + trenutni);
  req = $.ajax({
    url: 'handler/obrisiDestinaciju.php',
    type: 'post',
    data: { 'id': trenutni }
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res.indexOf("Ok") != -1) {
      $(this).closest('tr').remove();
      alert('Uspesno ste obrisali destinaciju');
      location.reload(true);
      console.log('Obrisana');
    } else {
      console.log("Destinacija nije obrisana " + res);
      alert("Destinacija nije obrisana ");

    }
  });

});

//Updates
$('#izmeniForma').submit(function(){

  event.preventDefault();
  console.log("Izmena");
  const $form = $(this);
  const $input = $form.find('input, select, button, textarea');

  const serijalizacija = $form.serialize();
  console.log(serijalizacija);

  $input.prop('disabled', true);

  req = $.ajax({
    url: 'handler/azurirajDestinaciju.php',
    type: 'post',
    data: serijalizacija
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res.indexOf("Ok") != -1) {
      alert("Destinacija je uspesno azurirana");
      location.reload(true);
    } else console.log("Destinacija nije azurirana " + res);
  });

  req.fail(function (jqXHR, textStatus, errorThrown) {
    console.error('Sledeca greska se desila: ' + textStatus, errorThrown)
  });


});




