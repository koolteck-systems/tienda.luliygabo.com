<?php
session_start();
//echo "<br>SESIÓN <pre>"; var_dump($_SESSION); echo "</pre>";

extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
//echo "<br>REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";

if ($cerrar_session=='si') {
	session_unset();
	session_destroy();
}

include 'config/db.php';

function mes_letra($mes) {
	switch ($mes) {
		case 1:
			$mes_letra="Enero";
		break;
		case 2:
			$mes_letra="Febrero";
		break;
		case 3:
			$mes_letra="Marzo";
		break;
		case 4:
			$mes_letra="Abril";
		break;
		case 5:
			$mes_letra="Mayo";
		break;
		case 6:
			$mes_letra="Junio";
		break;
		case 7:
			$mes_letra="Julio";
		break;
		case 8:
			$mes_letra="Agosto";
		break;
		case 9:
			$mes_letra="Septiembre";
		break;
		case 10:
			$mes_letra="Octubre";
		break;
		case 11:
			$mes_letra="Noviembre";
		break;
		case 12:
			$mes_letra="Diciembre";
		break;
	}
	return $mes_letra;
}

?>
<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Luli y Gabo - Tienda en Línea</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    
      <!--limpiar chace -->
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet">

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<?php

if ($guardarCheck==true) {
	if ($_SESSION["id"]==NULL || $_SESSION["id"]=="") {
		?>
		<script>
			alert("Necesita haber iniciado sesión para poder GUARDAR los datos.");
		</script>
		<?php		
	} else {
		if (  $nombre==NULL || $apellidos==NULL || $telefono==NULL || $celular==NULL || $ciudad==NULL || $cp==NULL || $colonia==NULL || $estado==NULL || $calle==NULL || $referencias==NULL ) {
			$msg="Todos los campos son Obligatorios.";
			$class="alert alert-info";
		} else {
			if ($id_du!=NULL || $id_du!=0) {
				$sql = "UPDATE datos_usuario SET telefono = '".$telefono."', celular = '".$celular."', ciudad = '".$ciudad."', cp = '".$cp."', colonia = '".$colonia."', estado = '".$estado."', calle = '".$calle."', referencias = '".$referencias."' WHERE id = '".$id_du."' ";
				if ($conn->query($sql) === TRUE) {
					$sql2 = "UPDATE usuarios SET nombre = '".$nombre."', apellidos = '".$apellidos."' WHERE id = '".$_SESSION["id"]."' ";
					if ($conn->query($sql2) === TRUE) {
						$class = "alert alert-info";
						$msg=" Los datos se guardaron correctamente.";
					} else {
						$class = "alert alert-info";
						$msg=" Los datos no se guardaron. Inténtelo de nuevo.";
					}
				} else {
					$class = "alert alert-info";
					$msg=" Los datos no se guardaron. Inténtelo de nuevo.";
				}
			} else {
				$sql = "INSERT INTO datos_usuario (id, id_usuario, telefono, celular, ciudad, cp, colonia, estado, calle, referencias) VALUES 
						('', '".$_SESSION["id"]."', '".$telefono."', '".$celular."', '".$ciudad."', '".$cp."', '".$colonia."', '".$estado."', '".$calle."', '".$referencias."');";
				if ($conn->query($sql) === TRUE) {
					$sql2 = "UPDATE usuarios SET nombre = '".$nombre."', apellidos = '".$apellidos."' WHERE id = '".$_SESSION["id"]."' ";
					if ($conn->query($sql2) === TRUE) {
						$class = "alert alert-info";
						$msg=" Los datos se guardaron correctamente.";
					} else {
						$class = "alert alert-info";
						$msg=" Los datos no se guardaron. Inténtelo de nuevo.";
					}
				} else {
					$class = "alert alert-info";
					$msg=" Los datos no se guardaron. Inténtelo de nuevo.";
				}
			}			
		}				
	}	
}

### CONEKTA ###
require_once("lib/Conekta.php");
/////// Key de Pruebas //////
//\Conekta\Conekta::setApiKey("key_LdPoSZXiJcPtxJHsFimsJg");
/////// Key de Producción //////
\Conekta\Conekta::setApiKey("key_dfA24ZQA9gU11AWKTKB4Uw");
\Conekta\Conekta::setApiVersion("2.0.0");

$token_id = $conektaTokenId;
$total_producto = ($total_p)-($envio);
$envio = $envio;
$lugar_envio = $estado;

if ($_SESSION["id"]==NULL || $_SESSION["id"]=="") {
	$nombre_e = $nombre;
	$apellidos_e = $apellidos;
	$correo = $correo;
} else {	
	$nombre_e = $_SESSION['nombre'];
	$apellidos_e = $_SESSION['apellidos'];
	$correo = $_SESSION['correo'];
}

$nombre_completo_e = $nombre_e." ".$apellidos_e;

$nombre_completo = $nombre." ".$apellidos;

//echo "<br>Costo: "; var_dump($total_producto);
//echo "<br>envio: "; var_dump($envio);

try{
  $order = \Conekta\Order::create(
    array(
      "line_items" => array(
        array(
          "name" => $orden,
          "unit_price" => $total_producto*100,
          "quantity" => 1
        )//first line_item
      ), //line_items
      "shipping_lines" => array(
        array(
          "amount" => $envio*100,
           "carrier" => "99 Minutos"
        )
      ), //shipping_lines - physical goods only
      "currency" => "MXN",
      "customer_info" => array(
        "name" => $nombre_completo_e,
        "email" => $correo,
        "phone" => $telefono
      ), //customer_info
      "shipping_contact" => array(
        "address" => array(
          "street1" => $calle,
          "postal_code" => $cp,
          "country" => "MX"
        )//address
      ), //shipping_contact - required only for physical goods
      "metadata" => array("reference" => $referencias, "more_info" => "mas_info"),
      "charges" => array(
          array(
              "payment_method" => array(
                  //"monthly_installments" => 3,
                  "type" => "card",
                  "token_id" => $token_id) //payment_method - use customer's default - a card to charge a card, different from the default, you can indicate the card's source_id as shown in the Retry Card Section
          ) //first charge
      ) //charges
    )//order
  );
} catch (\Conekta\ProcessingError $error){
  //echo $error->getMessage();
  $error_msg1 = $error->getMessage();
  $color = "red";
} catch (\Conekta\ParameterValidationError $error){
  //echo $error->getMessage();
  $error_msg2 = $error->getMessage();
  $color = "red";
} catch (\Conekta\Handler $error){
  //echo $error->getMessage();
  $error_msg3 = $error->getMessage();
  $color = "red";
}
/*echo "<br>ERROR: <pre>"; var_dump($error_msg1); echo "</pre>";
echo "<br>ERROR: <pre>"; var_dump($error_msg2); echo "</pre>";
echo "<br>ERROR: <pre>"; var_dump($error_msg3); echo "</pre>";*/

/*echo "<br>ID: ". $order->id;
echo "<br>Status: ". $order->payment_status;
echo "<br>$". $order->amount/100 . $order->currency;
echo "<br>Order";
echo $order->line_items[0]->quantity .
      "-". $order->line_items[0]->name .
      "- $". $order->line_items[0]->unit_price/100;
echo "<br>Payment info";
echo "<br>CODE:". $order->charges[0]->payment_method->auth_code;
echo "<br>Card info:".
      "- ". $order->charges[0]->payment_method->name .
      "- ". $order->charges[0]->payment_method->last4 .
      "- ". $order->charges[0]->payment_method->brand .
      "- ". $order->charges[0]->payment_method->type;*/
	  
$codigo_autorizacion  = $order->charges[0]->payment_method->auth_code;	  
$card_info = $order->charges[0]->payment_method->name."-".$order->charges[0]->payment_method->last4."-".$order->charges[0]->payment_method->brand."-".$order->charges[0]->payment_method->type;
	  
//echo "<br>ERROR MSG: "; var_dump($error_msg);
	  
if ($error_msg1!=NULL || $error_msg1!="" || $error_msg2!=NULL || $error_msg2!="" || $error_msg3!=NULL || $error_msg3!="") {
	$comprar = NULL;
	$msg_conekta = $error_msg1." ".$error_msg2." ".$error_msg3;
	$liga = "<br><br><a href=\"cart.php\">Regresar</a>";
} else {
	$comprar = "si";
	$msg_conekta = NULL;
	$liga = NULL;
}
//echo "<br>LIGA:"; var_dump($liga);
//echo "<br>COMPRAR:"; var_dump($comprar);

###### 99 Minutos ######
////////////////////////////////////////////////////
//echo "<br>ENVIO: "; var_dump($envio99minutos);
if($comprar=='si'){
	if ($estado=="CDMX") {
		//Notificacion envio depar
		$domain_header = "https://tienda.luliygabo.com";
		$to = "alejandro@klteck.com";
		$bcc = "jesus@klteck.com";
		$subject = "Envio Tienda LULI Y GABO";
		$mail_body = '<html>';
		$mail_body .='<body topmargin="25">';
		$mail_body .='<h2> Dirección de Envio</h2>';
		$mail_body .='<table width="500" border="1" cellspacing="10" cellpadding="10">';
		$mail_body .='<tr> <td width="100" align="center"> Tienda: </td> <td align="left"> '. $domain_header .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Orden: </td> <td align="left"> '. $orden .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Pedido: </td> <td align="left"> '. $id_pedido .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Nombre: </td> <td align="left"> '. $nombre .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Apellidos: </td> <td align="left"> '. $apellidos .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Correo: </td> <td align="left"> '. $correo .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Teléfono: </td> <td align="left"> '. $telefono .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Dirección: </td> <td align="left"> '. $calle .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Dirección: </td> <td align="left"> '. $referencias .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Estado: </td> <td align="left"> '. $estado .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Codigo Postal: </td> <td align="left"> '. $cp .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Metodo de pago: </td> <td align="left"> Vía WEB </td> </tr>';
		$mail_body .='</table>';
		$mail_body .='</body>';
		$mail_body .='</html>';
		$headers = "From:info@tiendaluliygabo.com.mx\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "BCC: <$bcc>\r\n";
		mail($to, $subject, $mail_body, $headers);
		
		$liga_rastreo = "Tu pedido llegará de 2 a 3 días hábiles después de tu compra, en horario de oficina (9:00 am - 6:00 pm) ";
		
	} else {
		//Notificacion envio depar
		$domain_header = "https://tienda.luliygabo.com";
		$to = "envios@99minutos.com";
		$bcc = "jesus@klteck.com";
		$subject = "Envio Tienda LULI Y GABO";
		$mail_body = '<html>';
		$mail_body .='<body topmargin="25">';
		$mail_body .='<h2> Dirección de Envio</h2>';
		$mail_body .='<table width="500" border="1" cellspacing="10" cellpadding="10">';
		$mail_body .='<tr> <td width="100" align="center"> Tienda: </td> <td align="left"> '. $domain_header .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Orden: </td> <td align="left"> '. $orden .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Pedido: </td> <td align="left"> '. $id_pedido .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Nombre: </td> <td align="left"> '. $nombre .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Apellidos: </td> <td align="left"> '. $apellidos .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Correo: </td> <td align="left"> '. $correo .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Teléfono: </td> <td align="left"> '. $telefono .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Dirección: </td> <td align="left"> '. $calle .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Dirección: </td> <td align="left"> '. $referencias .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Estado: </td> <td align="left"> '. $estado .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Codigo Postal: </td> <td align="left"> '. $cp .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Metodo de pago: </td> <td align="left"> Vía WEB </td> </tr>';
		$mail_body .='</table>';
		$mail_body .='</body>';
		$mail_body .='</html>';
		$headers = "From:envios@99minutos.com\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "BCC: <$bcc>\r\n";
		mail($to, $subject, $mail_body, $headers);
		
		//realizar pedido de envio
		//request();
		// variables
		$api_key=									'23894thfpoiq10fapo93fmapo';
		$user_id=									'5942834432049152';

		$delivery_type = 'Programado';
		//echo "<br>Nombre Completo: "; var_dump($nombre_completo);
		//echo "<br>PHONE: "; var_dump($telefono);
		//echo "<br>DESC: "; var_dump($descripcion);

		$latlng=									'19.346857%2C-99.2985648';
		$destination_route=							urlencode(implode(' ', array($calle,$referencias)));
		$destination_locality=						urlencode($ciudad);
		$destination_administrative_area_level=		urlencode($estado);
		$destination_postal_code=					urlencode($cp);
		$d_latlng=									urlencode(implode(',', array($latitude,$longitude)));
		$customer_phone=							urlencode($telefono);
		$nombre_e =									'Entregar a: '.$nombre_completo;
		$orden =									$orden;

		$recolecta= 'Se recolecta con: Ale';

		//url que sirve para hacer la peticion de envion al sistema de 99minutos
		//$request =	"https://deploy-dot-precise-line-76299minutos.appspot.com/2/delivery/request?";
		$request =	"https://precise-line-76299minutos.appspot.com/2/delivery/request?";
		$request.=	"api_key=".$api_key."&";
		$request.=	"user_id=".$user_id."&";
		$request.=	"delivery_type=".$delivery_type."&";
		$request.=	"route=ARTEAGA+Y+SALAZAR&";
		$request.=	"street_number=108&";
		$request.=	"neighborhood=Contadero&";
		$request.=	"locality=Mexico&";
		$request.=	"administrative_area_level_1=Distrito+Federal&";
		$request.=	"postal_code=05500&";
		$request.=	"country=Mexico&latlng=".$latlng."&";
		$request.=	"vehicle_type=mini&";
		$request.=	"destination-route=".$destination_route."&";
		$request.=	"destination-street_number=&";
		$request.=	"destination-neighborhood=&";
		$request.=	"destination-locality=".$destination_locality."&";
		$request.=	"destination-administrative_area_level=".$destination_administrative_area_level."&";
		$request.=	"destination-postal_code=".$destination_postal_code."&";
		$request.=	"destination-country=Mexico&";
		$request.=	"destination-latlng=".$d_latlng."&";
		$request.=	"customer_email=".$correo."&";
		$request.=	"customer_phone=".$customer_phone."&";
		$request.=	"_notification_email=&";
		
		//echo "<br>PHONE: "; var_dump($customer_phone);
		//echo "<br>REQUEST: "; var_dump($request);
		
		$notes = urlencode((implode('|', array($orden,$recolecta,$nombre_e))));
		$request.= "notes=".$notes."&";

		$request.=	"dispatch=true";

		error_log("Request");
		error_log(print_r($request, true));
		

		$ch_request=curl_init();
		$curl =  curl_init();
		curl_setopt($curl, CURLOPT_URL, $request);
		curl_setopt($curl, CURLOPT_SSLVERSION, 1);
		//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$response = curl_exec($curl);
		curl_close ($curl);

		error_log("Response");
		error_log(print_r($response, TRUE));
		
		//echo "<br>RESPONSE1: "; var_dump($response);
		
		$response =  json_decode($response,true);
			
		$id_order = $response['order_id'];
		
		//echo "<br>order_id: "; var_dump($id_order);
		
		/*$sql = "UPDATE pedidos SET id_order = '".$id_order."', card_info = '".$card_info."', codigo_autorizacion = '".$codigo_autorizacion."' WHERE id_pedido = '".$id_pedido."' ";
		if ($conn->query($sql) === TRUE) {
			$class = "alert alert-info";
			$msg_update=" Los datos se guardaron correctamente.";
		}*/
		$liga_rastreo = " ID ORDER: <a href=\"http://www.99minutos.com/rastreo_shopify.php?counter=".$id_order."\" target=\"_blank\">".$id_order;
	}
}

##### GUARDAMOS LA COMPRA #####	 
//if ($comprar=='si') {
if ( ($_SESSION["productos"]!= NULL) ) {
	foreach($_SESSION["productos"] as $producto){ //loop though items and prepare html content
		
		//set variables to use them in HTML content below
		$id = $producto["id_producto"];
		$cantidad = $producto["cantidad"];	
		$precio = $producto["precio"];		
		$comprado = 1;
		$fecha = date ('Y-m-d');
		$precio_total = $precio * $cantidad;
		if ($comprar=='si') $status = "aprobado";
		else $status = "rechazado";

		$sql = "INSERT INTO pedidos (id, correo, id_usuario, id_producto, cantidad, comprado, id_pedido, precio_total, costo_envio, lugar_envio, id_order, card_info, codigo_autorizacion, status, fecha) VALUES 
			('', '".$correo."', '".$_SESSION["id"]."', '".$id."', '".$cantidad."', '".$comprado."', '".$id_pedido."', '".$precio_total."', '".$envio."', '".$lugar_envio."', '".$id_order."', '".$card_info."', '".$codigo_autorizacion."', '".$status."', '".$fecha."');";
		
		if ($conn->query($sql) === TRUE) $ok = true;
		else $ok = false;
	}

	//echo "<br>############################ok: "; var_dump($ok); echo "<br>";
	//$ok = true;

	if ($ok) {

		### ENVIAR CORREO ###
		
		## OBTENEMOS EL CORREO Y NOMBRE DEL USUARIO ##
		$sql = "SELECT correo, nombre, apellidos FROM usuarios WHERE id = '".$_SESSION["id"]."' ";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$mail = $row['correo'];
				$nombre_completo = $row['nombre']." ".$row['apellidos'];
			}
		} else {
				$mail = $correo;
				$nombre_completo = $nombre." ".$apellidos;
		}
		
		$email = "info@tiendaluliygabo.com.mx";
		//$cc = "beatriz@klteck.com";
		$bcc = "jesus@klteck.com";
		if ($comprar=='si') $asunto = "Datos de tu pedido en www.tienda.luliygabo.com";
		else $asunto = "Pedido NO exitoso en www.tienda.luliygabo.com";
		$arrDate = explode("-", $fecha);
		$dia = $arrDate[2];
		$mes = $arrDate[1];
		$anio = $arrDate[0];
		$mes_letra=mes_letra($mes);
		#$dia_letra=dia_letra($dia_nombre);
		$fecha_nueva=$dia." de ".$mes_letra." del ".$anio;
		
		$sql = "SELECT id_producto, cantidad FROM pedidos WHERE correo = '".$correo."' AND comprado = 1 AND id_pedido = '".$id_pedido."' GROUP BY id_producto ";
		//echo "<br>SQL: "; var_dump($sql); echo "<br>";			
		$result = $conn->query($sql);

		$productos = array();
		if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
			$productos[] = $row;
		  }
		}			
		
		$subtotal = 0;
		$total = 0;
		$i=0;
		//echo "<br>productos: <pre>"; var_dump($productos); echo "</pre>";			
		foreach($productos as $producto){ //loop though items and prepare html content
			$i++;
			$carrito .= "<!-- Item #".$i." -->
						<tr>";
			
			//set variables to use them in HTML content below
			$id = $producto["id_producto"];
			$cantidad = $producto["cantidad"];					
			
			### Obtener imagen, precio y nombre del producto ###
			$sql = "SELECT nombre, precio, imagen FROM productos WHERE id = '$id' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					//echo "row: <pre>"; var_dump($row); echo "</pre>";
					$nombre = $row["nombre"];
					$precio = $row["precio"];
					$imagen = $row["imagen"];
				}
			}
			/*if (trim($informacion!=NULL && $informacion!="")) $info = "<br>(".$información.")";
			else $info = "";*/
			
			
			$total_producto = $precio * $cantidad;
			$carrito .=  "<tr>";
			$carrito .=  "	<td width=\"14\" align=\"center\"></td>";
			$carrito .=  "	<td width=\"110\" align=\"center\"><img src=\"".$imagen."\" alt=\"IMG\" width=\"100\"/></td>";									
			$carrito .=  "	<td width=\"295\" align=\"center\">".$nombre."</td>";
			$carrito .=  "	<td width=\"84\" align=\"center\" style=\"color:#f38a24\">".number_format($precio,0,'.',',')." Pesos</td>";
			$carrito .=  "	<td width=\"73\" align=\"center\">".$cantidad."</td>";
			$carrito .=  "	<td width=\"74\" align=\"center\" style=\"color:#f38a24\">".number_format($total_producto,0,'.',',')." Pesos</td>";
			$carrito .=  "	<td width=\"10\"></td>";								
			$carrito .=  "  </tr>";
			$subtotal = ($subtotal + $total_producto);
			$cantidad_total = ($cantidad_total + $cantidad);
		}
		$total = $subtotal + $envio;
				
		if ($comprar=='si') {
			$cuerpo = '<!doctype html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>Datos de tu Compra</title>
					<style type="text/css">
					body,td,th {
						color: #555555;
						font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
					}
					body {
						background-color: #fff;
					}
					</style>
					</head>

					<body>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td align="center"><table width="650" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center"><img src="https://tienda.luliygabo.com/images/logo/LuliyGabo-logo.png" alt="LULI Y GABO" style="width: 150px;"/></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center" style="color:#222222;">
							<h1 style="font-size:25px; font-weight:500">DATOS DE TU COMPRA</h1>
							</td>
						  </tr>
						  <tr>
							<td height="10" align="center"></td>
						  </tr>
						  <tr>
							<td align="center">
							  ¡Hola '.$nombre_completo.'!
							</td>
						  </tr>
						  <tr>
							<td align="center">&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="10">&nbsp;</td>
								<td width="489" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td colspan="2" style="font-size:14px; text-align:justify">Gracias por tu compra. Recibirás tu pedido de 3 a 4 días hábiles. <br>
									  <br>
									  Los detalles de tu pedido se indican a continuación.</td>
								  </tr>
								  </table></td>
								<td width="10">&nbsp;</td>
							  </tr>
							</table></td>
						  </tr>
						  <tr>
							<td height="30">&nbsp;</td>
						  </tr>
						  <tr>
							<td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px;">
							  <tr>
								<td width="10">&nbsp;</td>
								<td width="387" align="left"><strong>Pedido #: '.$id_pedido.'</strong></td>
								<td width="232" align="right"><strong>'.$fecha_nueva.'</strong></td>
								<td width="21">&nbsp;</td>
							  </tr>
							</table></td>
						  </tr>
						  <tr>
							<td height="30">&nbsp;</td>
						  </tr>
						  <tr>
							<td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px">
							  <tr>
								<td></td>
								<td align="center"><strong>Imagen</strong></td>
								<td align="center"><strong>Nombre</strong></td>
								<td align="center"><strong>Precio</strong></td>
								<td align="center"><strong>Cantidad</strong></td>
								<td align="center"><strong>Subtotal</strong></td>
								<td></td>									
							  </tr>
							  <tr>
								<td colspan="8" align="center">&nbsp;</td>
								</tr>
							  <tr>
								<td height="1" colspan="8" align="center" bgcolor="#f0f0f0"></td>
								</tr>
							  <tr>
								<td colspan="8" align="center">&nbsp;</td>
							  </tr>
							  '.$carrito.'
							  <tr>
								<td colspan="8" align="center">&nbsp;</td>
							  </tr>
							  <tr>
								<td height="1" colspan="8" align="center" bgcolor="#f0f0f0"></td>
							  </tr>
							  <tr>
								<td colspan="8" align="center">&nbsp;</td>
							  </tr>
							  <tr>
								<td colspan="8" align="center">Rastrea tu pedido: '.$liga_rastreo.'</td>
							  </tr>
							  <tr>
								<td colspan="8" align="center">&nbsp;</td>
							  </tr>
							  <tr>
								<td colspan="8" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td width="300">&nbsp;</td>
									<td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:21x;">
									  <tr>
										<td height="25" align="right"><strong># Producto(s)</strong></td>
										<td align="right"><strong>'.$cantidad_total.' piezas</strong></td>
										</tr>
									  <tr>
									  <tr>
										<td height="25" align="right">&nbsp;</td>
										<td align="right"><strong>&nbsp;</strong></td>
										</tr>
									  <tr>
										<td height="25" align="right" ><strong>Subtotal</strong></td>
										<td align="right"><strong>$'.number_format($subtotal,0,'.',',').'</strong></td>
									  </tr>
									  <tr>
										<td height="25" align="right" ><strong>Envio</strong></td>
										<td align="right"><strong>$'.number_format($envio,0,'.',',').'</strong></td>
									  </tr>
									  <tr>
										<td height="25" align="right"  style="color:#f38a24"><h2><strong>TOTAL</strong></h2></td>
										<td align="right"  style="color:#f38a24"><h2><strong>$'.number_format($total,0,'.',',').'</strong></h2></td>
									  </tr>
									  <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
									  </table></td>
									</tr>
								  </table></td>
								</tr>
							  
							  
							  </table></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#f0f0f0; font-size: 13px; text-align:center">
							  <tr>
								<td width="10">&nbsp;</td>
								<td width="489" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td colspan="2">&nbsp;</td>
								  </tr>
								  <tr>
									<td colspan="2" align="center">Para cualquier duda, aclaración o comentario marcar al <strong>01800 22 64535</strong> o envía un correo a <a href="mailto:info@tiendaluliygabo.com.mx">info@tiendaluliygabo.com.mx</a></td>
								  </tr>
								  <tr>
									<td colspan="2"></td>
								  </tr>
								  </table></td>
								<td width="10">&nbsp;</td>
							  </tr>
							</table>
							</td>
						  </tr>
						</table></td>
					  </tr>
					</table>
					</body>
					</html>';
			$msg =  "Has comprado tus productos con éxito. ";
			unset($_SESSION["productos"]);
			$compra_fallida = FALSE; 
		} else {
			$cuerpo = '<!doctype html>
					<html>
					<head>
					<meta charset="UTF-8">
					<title>Datos de tu Compra</title>
					<style type="text/css">
					body,td,th {
						color: #555555;
						font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
					}
					body {
						background-color: #fff;
					}
					</style>
					</head>

					<body>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td align="center"><table width="650" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center"><img src="https://tienda.luliygabo.com/images/logo/LuliyGabo-logo.png" alt="LULI Y GABO" style="width: 150px;"/></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center" style="color:#222222;">
							<h1 style="font-size:25px; font-weight:500">PEDIDO NO EXITOSO</h1>
							</td>
						  </tr>
						  <tr>
							<td height="10" align="center"></td>
						  </tr>
						  <tr>
							<td align="center">
							  ¡Hola '.$nombre_completo.'!
							</td>
						  </tr>
						  <tr>
							<td align="center">&nbsp;</td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="10">&nbsp;</td>
								<td width="489" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td colspan="2" style="font-size:14px; text-align:justify">Su pedido no pudo ser terminado, ya que ocurrió un error. <br><br>Le pedimos volver a intentar y de antemano le ofrecemos una disculpa.
									<br><br>Gracias. <br></td>
								  </tr>
								  </table></td>
								<td width="10">&nbsp;</td>
							  </tr>
							</table></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#f0f0f0; font-size: 13px; text-align:center">
							  <tr>
								<td width="10">&nbsp;</td>
								<td width="489" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td colspan="2">&nbsp;</td>
								  </tr>
								  <tr>
									<td colspan="2" align="center">Para cualquier duda, aclaración o comentario marcar al <strong>01800 22 64535</strong> o envía un correo a <a href="mailto:info@tiendaluliygabo.com.mx">info@tiendaluliygabo.com.mx</a></td>
								  </tr>
								  <tr>
									<td colspan="2"></td>
								  </tr>
								  </table></td>
								<td width="10">&nbsp;</td>
							  </tr>
							</table>
							</td>
						  </tr>
						</table></td>
					  </tr>
					</table>
					</body>
					</html>';
			$msg =  "Ocurrió un error, por favor vuelva a intentarlo. ";
			$compra_fallida = TRUE; 
		}

		$encabezado = "MIME-Version: 1.0\r\n";
		$encabezado .= "Content-type: text/html; charset=utf-8\r\n";
		$encabezado .= "From: Luli y Gabo <".$email.">\r\n";
		//$encabezado .= "CC: <$cc>\n";
		$encabezado .= "BCC: <$bcc>\n";

		/*echo "<br>############################mail: "; var_dump($mail); echo "<br>";
		echo "<br>############################asunto: "; var_dump($asunto); echo "<br>";
		echo "<br>############################encabezado: "; var_dump($encabezado); echo "<br>";
		/*if(mail("jesus@klteck","prueba","prueba",$encabezado)){
		echo "<br>############################PUNTOS 1: "; var_dump($_SESSION['puntos']); echo "<br>";
		echo "<br>############################TOTAL: "; var_dump($total); echo "<br>";*/
		
		//echo "<br>############################PUNTOS 2: "; var_dump($_SESSION['puntos']); echo "<br>";
			
		if(mail($mail,$asunto,$cuerpo,$encabezado)){
			$msg .=  "<br>Recibirás un correo con la información.<br>";
			$color = "#fa5b0f";
		} else {
			$msg .=  "Error al enviar el correo.";
			$color = "red";
		}
	} else {
		$msg =  "Error: Inténtalo de nuevo." . $conn->error;
		$color = "red";
	}
} else {
	?>
	<script language="javascript">
	location.href = "login.php?seccion=orden";
	</script>
	<?php
}
//}
//echo "<br>ORDEN: "; var_dump($orden);
?>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <?php include 'header.php' ?>
        <!-- End Header Area -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
              <!-- Start Search Popap -->
        <?php include 'search-pop.php' ?>
        <!-- End Search Popap -->

        <!-- Start Cart Panel -->
        <?php include 'cart-panel.php' ?>
        <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
     
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--50 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>					
									<?php
									if ($msg!=NULL) {
										///Ponerle saltos de línea al mensaje.
										//$pizza  = $msg_conekta;
										//$largo = strlen(strip_tags($msg_conekta);
										$porciones = explode(" ", $msg_conekta);
										foreach ($porciones as $k => $v) {
											//echo "<br>Array: ";var_dump($k); echo " "; var_dump($v);
											if ($k%10==0) $new_msg .= "<br>".$v;
											else $new_msg .= " ".$v;
										}
									?>
										<tr>
											<th class="ErrorCode" colspan="6" style="text-align: center; color:<?=$color?>; background-color:#fff; "><?php echo $msg; ?><?php echo $new_msg; ?><br><?php echo $liga; ?></th>
										</tr>
									<?php
									}
									if ( $compra_fallida == FALSE ) {
										include 'config/db.php';
										
										$sql = "SELECT p.*, pr.nombre AS nombre, pr.precio, pr.imagen
												FROM pedidos AS p, productos AS pr
												WHERE p.correo =  '".$correo."'
												AND p.id_pedido = '".$id_pedido."'
												AND p.id_producto = pr.id
												AND p.comprado = 1
												ORDER BY p.id ASC ";
										//echo "<br>SQL: "; var_dump($sql);
										$result = $conn->query($sql);
										
										$num_total_registros = $result->num_rows;
										//echo "<br>REGS: "; var_dump($num_total_registros);

										if ($num_total_registros>=1) {
										?>
											<tr>
												<th class="product-thumbnail">Producto</th>
												<th class="product-price">Precio</th>
												<th class="product-quantity">Cantidad</th>
												<th class="product-subtotal">Total</th>
												<th class="product-subtotal">Compra</th>
												<th class="product-subtotal">Rastrea tu pedido </th>
											</tr>
										<?php
										}
										?>
										</thead>
										<tbody>
										<?php
										while($row = $result->fetch_assoc()) {
											$id = $row['id'];
											$id_pedido = $row['id_pedido'];
											$nombre = $row['nombre'];
											$precio = $row['precio'];
											$cantidad = $row['cantidad'];
											$precio_total = $row['precio_total'];
											$imagen = $row['imagen'];
											$fecha = $row['fecha'];
											$arrDate = explode("-", $fecha);
											$dia = $arrDate[2];
											$mes = $arrDate[1];
											$anio = $arrDate[0];
											$mes_letra = mes_letra($mes);
											#$dia_letra = dia_letra($dia_nombre);
											$fecha_nueva = $dia." de ".$mes_letra." del ".$anio;
											$total_productos = $total_productos + $precio_total;
										?>

											<tr style="line-height: 14px;">
												<td class="product-thumbnail">
													<div class="col-md-4 col-sm-4 col-xs-4" style="padding: 0px;">
														<img src="<?=$imagen?>" alt="product img" />
													</div>
													<div class="col-md-7 col-sm-7 col-xs-7 table-title">
														<?=$nombre?>
													</div>
												</td>
												<td class="product-price"><span class="amount"><?=number_format($precio,0,'.',',');?> MXN</span></td>
												<td class="product-subtotal"><?=$cantidad;?></td>
												<td class="product-subtotal"><?=number_format($precio_total,0,'.',',');?> MXN</td>
												<td class="product-subtotal"><?=$fecha_nueva;?></td>
												<td class="product-subtotal"><?=$liga_rastreo;?></td>
											</tr>
											
										<?php
										}
										$conn->close();
										$total_total = $total_productos + $envio;
									}
										?>
										</tbody>
									</table>
									<?php
									if ( $compra_fallida == FALSE ) {
										if ($num_total_registros>=1) {
										?>
										<table style="width:50%; text-align:right; border:0; float: right;">
											<tr>
												<td colspan="3">&nbsp;</td>
												<td class="product-price">Subtotal:</td>
												<td class="product-subtotal"><?=number_format($total_productos,0,'.',',');?> MXN</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td colspan="3">&nbsp;</td>
												<td class="product-price">Envío:</td>
												<td class="product-subtotal"><?=number_format($envio,0,'.',',');?> MXN</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td colspan="3">&nbsp;</td>
												<td class="product-price">TOTAL:</td>
												<td class="product-subtotal"><?=number_format($total_total,0,'.',',');?> MXN</td>
												<td>&nbsp;</td>
											</tr>
										</table>
										<?php
										}
									}
								?>
                            </div>
                           
                        </form> 
                    </div>
            
                </div>
            </div>
        </div>
        <div style="padding:50px;"></div>
        <!-- cart-main-area end -->
        <!-- Start Footer Area -->
        <?php include 'footer.php' ?>
        <!-- End Footer Style -->
    </div>
    <!-- Body main wrapper end -->

    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>

</body>

</html>