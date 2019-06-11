<?php
//start a session
session_start();

//Webhook enviado por shopify
$webhookContent=		"";
$webhook=				fopen('php://input' , 'rb');
while (!feof($webhook)) {
    $webhookContent .=	fread($webhook, 4096);
}
fclose($webhook);
$data=		json_decode($webhookContent,true);

//guardar datos ordenes
$file = 'shipping_ale.txt';
$print = print_r($webhookContent, true);
file_put_contents($file, $print, FILE_APPEND | LOCK_EX);


//obtener desde headers el dominio de shopify
$domain_header=	$_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN'];
//consulta en base 99min
$db =  mysqli_connect("localhost", "minutos_api", "pelas711", "minutos_api");

//comprobar carrier
$shipping=		$data ['shipping_lines']['0']['code'];
$express=		'Envío express en menos de 99 minutos (pedidos de L-V de 9 a 14 hrs) SÓLO CDMX';
$program= 		'Envío programado en menos de 24 horas (pedidos de L-V de 9 a 16 hrs) SÓLO CDMX';

//variables obtenidas desde json
$first_name=	$data['shipping_address']['first_name'];
$last_name=		$data['shipping_address']['last_name'];
$email=			$data['email'];
$phone=			$data['shipping_address']['phone'];
$address1=		$data['shipping_address']['address1'];
$address2=		$data['shipping_address']['address2'];
$province=		$data['shipping_address']['province'];
$zip=			$data['shipping_address']['zip'];
$city=			$data['shipping_address']['city'];
$latitude= 		$data['shipping_address']['latitude'];
$longitude=		$data['shipping_address']['longitude'];
$note=			$data['note'];
$name=			'Orden: '.$data['name'];
$pago=			$data['gateway'];

if($pago =="Pago contra entrega (SOLO DF Y AREA METROPOLITANA)"){
	$total_price= $data['total_price'];
}
else{
	$total_price=0;
}
//busqueda del correo del propietario de la tienda en base de datos
$mail_db=		"SELECT * FROM tbl_usersettings WHERE store_name = '$domain_header'";
$mail_result=	mysqli_query($db, $mail_db);
$mail_q=		mysqli_fetch_array($mail_result, MYSQLI_ASSOC);
$mail_str=		$mail_q['email'];

////////////////////////////////////////////////////
//url encode  para producto en bodegas
function request()
{
    global $total_price,$pago,$latitude, $longitude, $address1, $address2, $city, $province, $zip, $email, $phone, $first_name, $last_name, $productos, $name, $db, $shipping, $express, $program;

    // variables
    $api_key=									'23894thfpoiq10fapo93fmapo';
    $user_id=									'5744125232021504';
    if ($shipping == $express){
        $delivery_type =	'99minutos';
	}
	else if($shipping == $program){
	$delivery_type = 'Programado';
	}
	$latlng=									'19.346857%2C-99.2985648';
	$destination_route=							urlencode(implode(' ', array($address1,$address2)));
	$destination_locality=						urlencode($city);
	$destination_administrative_area_level=		urlencode($province);
	$destination_postal_code=					urlencode($zip);
	$d_latlng=									urlencode(implode(',', array($latitude,$longitude)));
	$customer_phone=							urlencode($phone);
	$nombre =									'Entregar a: '.implode(' ',array($first_name,$last_name));
	$orden =									$name;

    $recolecta= 'Se recolecta con: Ale';

    //Variable que pasa al sistema de 99minutos los datos en la seccion de notas
	//$notes=urlencode(implode(', ', array($name,$nombre)));

	//url que sirve para hacer la peticion de envion al sistema de 99minutos
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
	$request.=	"customer_email=".$email."&";
	$request.=	"customer_phone=".$customer_phone."&";
	$request.=	"notification_email=&";
	if($pago =="Pago contra entrega (SOLO DF Y AREA METROPOLITANA)"){
			$monto = "Cobro:".$total_price;
			$notes = urlencode((implode('|', array($orden,$nombre,$monto))));
			$request.= "notes=".$notes."&";
			$request.= "receivable_order=true&";
			$request.= "amount=".$total_price."&";
		}
		else
		{
			$notes = urlencode((implode('|', array($orden,$recolecta,$nombre))));
			$request.= "notes=".$notes."&";
		}
	$request.=	"dispatch=true";
	/*file_get_contents($request);
	error_log(print_r($request, true));
	$archivo = 'respaldo_malabares.txt';
	$texto = print_r($request, true);
	file_put_contents($archivo, $texto, FILE_APPEND | LOCK_EX);*/
    //funcion curl para enviar la peticion de envio al sistema de 99minutos
    /*$archivo = 'respaldo_innata.txt';
	$texto = print_r($request, true);
	file_put_contents($archivo, $texto, FILE_APPEND | LOCK_EX);*/

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
	die();
}
///////////////////////////////////////////////////
function mailprogramado()
{
    	global $domain_header, $name, $first_name, $last_name, $email, $phone, $address1, $address2, $province, $zip, $latitude, $longitude, $productos, $pago;
		$to = "envios@99minutos.com";
		$subject = "Envio Tienda INNATA";
		$mail_body = '<html>';
		$mail_body .='<body topmargin="25">';
		$mail_body .='<h2> Dirección de Envio</h2>';
		$mail_body .='<table width="500" border="1" cellspacing="10" cellpadding="10">';
		$mail_body .='<tr> <td width="100" align="center"> Tienda: </td> <td align="left"> '. $domain_header .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Orden: </td> <td align="left"> '. $name .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Nombre: </td> <td align="left"> '. $first_name .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Apellidos: </td> <td align="left"> '. $last_name .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Correo: </td> <td align="left"> '. $email .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Teléfono: </td> <td align="left"> '. $phone .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Dirección: </td> <td align="left"> '. $address1 .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Dirección: </td> <td align="left"> '. $address2 .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Estado: </td> <td align="left"> '. $province .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Codigo Postal: </td> <td align="left"> '. $zip .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Latitud: </td> <td align="left"> '. $latitude .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Longitud: </td> <td align="left"> '. $longitude .' </td> </tr>';
		$mail_body .='<tr> <td width="100" align="center"> Metodo de pago: </td> <td align="left"> '. $pago .' </td> </tr>';
		$mail_body .='</table>';
		$mail_body .='</body>';
		$mail_body .='</html>';
		$headers = "From:envios@99minutos.com\r\n";
		$headers .= "Content-type: text/html\r\n";
		mail($to, $subject, $mail_body, $headers);
    }
// error_log(print_r($data, true));

if($shipping == $express){
//Notificacion envio depar
mailprogramado();
//realizar pedido de envio
request();
//destruir sesion
session_destroy();
exit();
}
else if($shipping == $program){
//Notificacion envio depar
mailprogramado();
//realizar pedido de envio
request();
//destruir sesion
session_destroy();
exit();
}
?>
