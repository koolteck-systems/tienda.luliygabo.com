<!DOCTYPE html>
<html>
<head>
	<title>Conekta</title>
	<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<body>
<div class="container">
	<form action="cobro.php" method="POST" id="card-form">
	<br>
	API CONEKTA
	<br>
  <span class="card-errors"></span>
  <div><br>
    <label>
      <span>Nombre del tarjetahabiente</span>
      <input class="form-control" size="20" data-conekta="card[name]" type="text">
    </label>
  </div>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<div>
    <label>
      <span>Número de tarjeta de crédito</span>
      <input class="form-control" size="20" data-conekta="card[number]" type="text">
    </label>
  </div>
  <div>
    <label>
      <span>CVC</span>
      <input class="form-control" size="4" data-conekta="card[cvc]" type="text">
    </label>
  </div>
  <div>
    <label>
      <span>Fecha de expiración (MM/AAAA)</span>
      <input size="2" data-conekta="card[exp_month]" type="text">
    </label>
    <span>/</span>
    <input  size="4" data-conekta="card[exp_year]" type="text">
  </div>
  <button class="btn btn-primary" type="submit">Crear token</button>
</form>
</div>
<script type="text/javascript" >
  Conekta.setPublicKey('key_DX5kTzyuayc1xxpYqqmMNrQ');

  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");
    //Inserta el token_id en la forma para que se envíe al servidor
     $form.append($('<input name="conektaTokenId" id="conektaTokenId" type="hidden">').val(token.id));
    $form.get(0).submit(); //Hace submit
  };
  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $form.find(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false);
  };

  //jQuery para que genere el token después de dar click en submit
  $(function () {
    $("#card-form").submit(function(event) {
      var $form = $(this);
      // Previene hacer submit más de una vez
      $form.find("button").prop("disabled", true);
      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
      return false;
    });
  });
</script>

</body>
</html>