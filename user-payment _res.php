<?php
session_start();
//echo "<br>SESIÓN <pre>"; var_dump($_SESSION); echo "</pre>";

extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
//echo "<br>REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";

if ($cerrar_session=='si') {
	session_unset();
	session_destroy();
}
/*echo "SESIÓN "; var_dump($_SESSION);*/

include 'config/db.php';

### VALIDAMOS QUE SOLO COMPREN 2 PRODUCTOS MÁXIMO DE CADA PRODUCTO###
$i=0;
if( isset($_SESSION["productos"]) && (count($_SESSION["productos"])>0) ){ //if we have session variable
    foreach($_SESSION["productos"] as $key => $value){
		$i++;
		//echo "<br>NEW ID: <pre>"; var_dump($key); echo "</pre>";
		//echo "<br>VALUE ID: <pre>"; var_dump($value); echo "</pre>";
		//echo "<br>CANTIDAD: <pre>"; var_dump($value['cantidad']); echo "</pre>";
		if ( ($value['cantidad'])>2 ){ //if we have session variable
			//echo "<br>NEW ID: <pre>"; var_dump($key); echo "</pre>";
			$_SESSION["productos"][$key]['cantidad'] = 2; //cantidad máxima 2			
			if ($i==1) $orden = $_SESSION["productos"][$key]['cantidad']." ".$_SESSION["productos"][$key]['nombre'];
			else $orden .= " / ".$_SESSION["productos"][$key]['cantidad']." ".$_SESSION["productos"][$key]['nombre'];
			if ($i==1) $total_p = ($_SESSION["productos"][$key]['cantidad'] * $_SESSION["productos"][$key]['precio']);
			else $total_p += ($_SESSION["productos"][$key]['cantidad'] * $_SESSION["productos"][$key]['precio']);
			//echo "<br>ORDEN <pre>"; var_dump($orden); echo "</pre>";
			//echo "<br>TOTAL_P <pre>"; var_dump($total_p); echo "</pre>";
		} else {		
			if ($i==1) $orden = $_SESSION["productos"][$key]['cantidad']." ".$_SESSION["productos"][$key]['nombre'];
			else $orden .= " / ".$_SESSION["productos"][$key]['cantidad']." ".$_SESSION["productos"][$key]['nombre'];
			if ($i==1) $total_p = ($_SESSION["productos"][$key]['cantidad'] * $_SESSION["productos"][$key]['precio']);
			else $total_p += ($_SESSION["productos"][$key]['cantidad'] * $_SESSION["productos"][$key]['precio']);
			//echo "<br>ORDEN <pre>"; var_dump($orden); echo "</pre>";
			//echo "<br>TOTAL_P <pre>"; var_dump($total_p); echo "</pre>";
		}
    }
}

//echo "<br>SESIÓN DESPUÉS <pre>"; var_dump($_SESSION); echo "</pre>";
//echo "<br>ORDEN DESPUÉS <pre>"; var_dump($orden); echo "</pre>";
//echo "<br>TOTAL_P DESPUÉS <pre>"; var_dump($total_p); echo "</pre>";
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
	<!-- Conekta JS -->
	<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function() {
		$('body').on('click', '#pagar', function(){
			if(validarForm()) {
				//alert("exito");
				return true;
			} else {
				alert("ERROR: Le falta llenar datos. Verifique los mensajes de alerta en rojo.");
				return false;
			}
		});
	});
	//Validar Form
	function validarForm(){
		//alert("Entro");
		var resultado = true;

		$("#txtError_Datos").text("");
		$("#txtError_CP").text("");

		if($("#estado").val() == ""){
			$("#txtError_Edo").text("DEBE INGRESAR EL ESTADO.");
			resultado = false;
			//alert("RESULT1:"+resultado);
		}

		//if( ($("#cp").val() == "") || ($("#calle").val() == "") || ($("#ciudad").val() == "") || ($("#telefono").val() == "") ){
		if($("#guardados").val() == ""){
			$("#txtError_Datos").text("DEBE GUARDAR LA INFORMACIÓN DE LOS DATOS DE ENVÍO.");
			resultado = false;
			//alert("RESULT2:"+resultado);
		}
		return resultado;
	}
	</script>	

</head>
<?php

$msg = NULL;
$color = NULL;
if ($guardar=='si') {
	if ($_SESSION["id"]==NULL || $_SESSION["id"]=="") {
		$class = "alert alert-info";
		$msg="Necesita hacer Login para poder Guardar los datos.";
	} else {
		if ( $telefono==NULL || $celular==NULL || $ciudad==NULL || $calle==NULL || $cp==NULL || $referencias==NULL ) {
			$msg="Todos los campos son Obligatorios.";
			$class="alert alert-info";
		} else {
			if ($id_du!=NULL || $id_du!=0) {
				$sql = "UPDATE datos_usuario SET telefono = '".$telefono."', celular = '".$celular."', ciudad = '".$ciudad."', calle = '".$calle."', cp = '".$cp."', referencias = '".$referencias."' WHERE id = '".$id_du."' ";
				if ($conn->query($sql) === TRUE) {
					$class = "alert alert-info";
					$msg=" Los datos se guardaron correctamente.";
				} else {
					$class = "alert alert-info";
					$msg=" Los datos no se guardaron. Inténtelo de nuevo.";
				}
			} else {
				$sql = "INSERT INTO datos_usuario (id, id_usuario, telefono, celular, ciudad, calle, cp, referencias) VALUES 
						('', '".$_SESSION["id"]."', '".$telefono."', '".$celular."', '".$ciudad."', '".$calle."', '".$cp."', '".$referencias."');";
				if ($conn->query($sql) === TRUE) {
					$class = "alert alert-info";
					$msg=" Los datos se guardaron correctamente.";
				} else {
					$class = "alert alert-info";
					$msg=" Los datos no se guardaron. Inténtelo de nuevo.";
				}
			}				
		}				
	}	
}

if ($estado==NULL) $envio = "0";
elseif ($estado=="CDMX") $envio = "120";
else $envio = "250";

if ($total_p==NULL || $total_p=='') $total_p = 0;

//echo "CUPÓN:"; var_dump($cupon);

if ($aplicar=="Aplicar") {
	if ($cupon!=NULL || $cupon!="") {
		###Validar Cupón
		$sql = "SELECT * FROM cupones WHERE validado != 0 LIMIT 1 ";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$id_cupon = $row['id'];
				$cupon = $row['cupon'];
				$validado = $row['validado'];
			}
		} else $validado = 0;
		if ($validado) {
			$msg =  "Este cupón ya fue usado.";
			$color = "red";
			$total_pro = $total_p;
			//echo "<br>TOTAL: "; var_dump($total_pro);
		} else {
			$msg =  "El descuento fue aplicado a tu total .";
			$color = "#fa5b0f";
			$sql = "UPDATE cupones SET validado = 1 WHERE id = '".$id_cupon."' ";
			//echo "<br>SQL: "; var_dump($sql); echo "<br>";
			$result = $conn->query($sql);
			$total_pro = $total_p*0.85;
			//echo "<br>*TOTAL: "; var_dump($total_pro);
		}	
	} else {
		$total_pro = $total_p;
	}
}

if ($cupon!=NULL || $cupon!="") {
	###Validar Cupón
	$sql = "SELECT * FROM cupones WHERE validado != 0 LIMIT 1 ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$id_cupon = $row['id'];
			$cupon = $row['cupon'];
			$validado = $row['validado'];
		}
	} else $validado = 0;
	if ($validado) {
		$msg =  "Este cupón ya fue usado.";
		$color = "red";
		$total_pro = $total_p;
		//echo "<br>TOTAL: "; var_dump($total_pro);
	} else {
		$msg =  "El descuento fue aplicado a tu total .";
		$color = "#fa5b0f";
		$sql = "UPDATE cupones SET validado = 1 WHERE id = '".$id_cupon."' ";
		//echo "<br>SQL: "; var_dump($sql); echo "<br>";
		$result = $conn->query($sql);
		$total_pro = $total_p*0.85;
		//echo "<br>*TOTAL: "; var_dump($total_pro);
	}	
} else $total_pro = $total_p;

$total_producto = $total_pro + $envio;
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
    		<div class="body__overlay">
    		</div>
        	<!-- Start Offset Wrapper -->
        	<div class="offset__wrapper">
              <!-- Start Search Popap -->
        		<?php //include 'search-pop.php' ?>
        			<!-- End Search Popap -->
        			<!-- Start Cart Panel -->
        			<?php //include 'cart-panel.php' ?>
        			<!-- End Cart Panel -->
        	</div>
        	<!-- End Offset Wrapper -->
        	<!-- cart-main-area start -->
        	<div class="cart-main-area ptb--100 bg__white">
        		<div class="container">
        			<div class="row">
        				<div class="col-md-8 col-sm-8 col-xs-12 address">
        					<?php
	        					$sql = "SELECT * FROM datos_usuario WHERE id_usuario = '".$_SESSION['id']."' ";
	        					//echo "SQL: "; var_dump($sql);
	        					$result = $conn->query($sql);
	        					$num_total_registros = $result->num_rows;
	        					//Si hay registros
	        					if ($num_total_registros > 0) {
	        						while($row = $result->fetch_assoc()) {
										  $id_du = $row['id'];
										  $id_u = $row['id_usuario'];
										  $telefono = $row['telefono'];
										  $celular = $row['celular'];
										  $ciudad = $row['ciudad'];
										  $calle = $row['calle'];
										  $cp = $row['cp'];
										  $referencias = $row['referencias'];
									}
									$guardados = "si";
								} else $guardados = "";
								$nombre_s = $_SESSION['nombre'];
								$apellidos = $_SESSION['apellidos'];
								$nombre_completo = $nombre_s." ".$apellidos;			
							?>					
							<form id="contact-form" action="" name="formContact" method="post">
								<div style="margin-bottom: 30px; font-size: 15px; line-height: 15px;"><span style="color: #ff5a33;"><b>Importante:</b></span> para poder realizar una compra tienes que haber iniciado sesión y guardar sus datos de envío.</div>
                    			<h2>Detalles de Envio</h2>
                    			<br>
								<?php
									if ($msg!=NULL) {
								?>
								<div class="single-contact-form">
									<div class="contact-box name">
										<center><?php echo $msg; ?></center>
									</div>
								</div>
								<?php
									 }
								?>
								<div class="single-contact-form">
									<div class="contact-box name">
										<input type="text" name="nombre_s" placeholder="Nombre" value="<?=$nombre_s?>" disabled>
										<input type="text" name="apellidos" placeholder="Apellidos" value="<?=$apellidos?>" disabled>									
									</div>
								</div>
								<div class="single-contact-form">
									<div class="contact-box name">
										<input type="text" name="telefono" id="telefono" placeholder="Teléfono" value="<?=$telefono?>">
										<input type="text" name="celular" id="celular" placeholder="Celular" value="<?=$celular?>">
									</div>
								</div>
								<div class="single-contact-form">
									<div class="contact-box name">
										<input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" value="<?=$ciudad?>">
										<input type="text" name="cp" id="cp" placeholder="Código Postal" value="<?=$cp?>">
									</div>
								</div>
								<div class="single-contact-form">
									<div class="contact-box subject">
										<input type="text" name="calle" id="calle" placeholder="Calle - Número" value="<?=$calle?>">
									</div>
								</div>
								<div class="single-contact-form">
									<div class="contact-box subject">
										<input type="text" name="referencias" placeholder="Referencias"  value="<?=$referencias?>">
									</div>
								</div>
								<input type="hidden" name="guardados" id="guardados" value="<?=$guardados?>">
								<span style="color: #ffffff; background-color: red; font-size: 13px; " class="span_error" id="txtError_Datos"></span>
								<div class="contact-btn" style="width:50%">
									<button type="submit" name="guardar" value="si" class="fv-btn">
										Guardar Información
									</button>
								</div>
								<input type="hidden" name="id_du" value="<?=$id_du?>">
								<input type="hidden" name="total_p" value="<?=$total_p?>">
								<input type="hidden" name="cupon" value="<?=$cupon?>">
								<input type="hidden" name="estado" value="<?=$estado?>">
								<input type="hidden" name="envio" value="<?=$envio?>">
								<input type="hidden" name="id_pedido" value="<?=$id_pedido?>">
								<input type="hidden" name="nombre_completo" value="<?=$nombre_completo?>">
								<input type="hidden" name="cardName" value="<?=$cardName?>">
								<input type="hidden" name="cardNumber" value="<?=$cardNumber?>">
								<input type="hidden" name="cardMes" value="<?=$cardMes?>">
								<input type="hidden" name="cardAnio" value="<?=$cardAnio?>">
								<input type="hidden" name="orden" value="<?=$orden?>">
								<br>
                                La entrega estimada es de 3 a 4 días hábiles
							</form>
                    	</div>
                    	<div class="resume-box col-md-4 col-sm-4 col-xs-12 smt-0 xmt-40">
							<div class="htc__cart__total">
								<h2>Tu Pedido</h2>
								<?php
									$sel_cdmx ="";
									$sel_agua ="";
									$sel_bc ="";
									$sel_bcs ="";
									$sel_cam ="";
									$sel_coa ="";
									$sel_chia ="";
									$sel_chi ="";
									$sel_dur ="";
									$sel_gua ="";
									$sel_gue ="";
									$sel_hid ="";
									$sel_jal ="";
									$sel_mex ="";
									$sel_mich ="";
									$sel_mor ="";
									$sel_nay ="";
									$sel_nl ="";
									$sel_oax ="";
									$sel_pue ="";
									$sel_que ="";
									$sel_quir ="";
									$sel_slp ="";
									$sel_sin ="";
									$sel_son ="";
									$sel_tab ="";
									$sel_tam ="";
									$sel_tlax ="";
									$sel_vera ="";
									$sel_yuc ="";
									$sel_zac ="";
									switch($estado){
										case "CDMX";
											$sel_cdmx = 'selected="selected"';
										break;
										case "Aguascalientes";
											$sel_agua = 'selected="selected"';
										break;
										case "Baja California";
											$sel_bc = 'selected="selected"';
										break;
										case "Baja California Sur";
											$sel_bcs = 'selected="selected"';
										break;
										case "Campeche";
											$sel_cam = 'selected="selected"';
										break;
										case "Coahuila de Zaragoza";
											$sel_coa = 'selected="selected"';
										break;
										case "Colima";
											$sel_col = 'selected="selected"';
										break;
										case "Chiapas";
											$sel_chia = 'selected="selected"';
										break;
										case "Chihuahua";
											$sel_chi = 'selected="selected"';
										break;
										case "Durango";
											$sel_dur = 'selected="selected"';
										break;
										case "Guanajuato";
											$sel_gua = 'selected="selected"';
										break;
										case "Guerrero";
											$sel_gue = 'selected="selected"';
										break;
										case "Hidalgo";
											$sel_hid = 'selected="selected"';
										break;
										case "Jalisco";
											$sel_jal = 'selected="selected"';
										break;
										case "México";
											$sel_mex = 'selected="selected"';
										break;
										case "Michoacán de Ocampo";
											$sel_mich = 'selected="selected"';
										break;
										case "Morelos";
											$sel_mor = 'selected="selected"';
										break;
										case "Nayarit";
											$sel_nay = 'selected="selected"';
										break;
										case "Nuevo León";
											$sel_nl = 'selected="selected"';
										break;
										case "Oaxaca";
											$sel_oax = 'selected="selected"';
										break;
										case "Puebla";
											$sel_pue = 'selected="selected"';
										break;
										case "Querétaro";
											$sel_que = 'selected="selected"';
										break;
										case "Quintana Roo";
											$sel_quir= 'selected="selected"';
										break;
										case "San Luis Potosí";
											$sel_slp = 'selected="selected"';
										break;
										case "Sinaloa";
											$sel_sin = 'selected="selected"';
										break;
										case "Sonora";
											$sel_son = 'selected="selected"';
										break;
										case "Tabasco";
											$sel_tab = 'selected="selected"';
										break;
										case "Tamaulipas";
											$sel_tam = 'selected="selected"';
										break;
										case "Tlaxcala";
											$sel_tlax = 'selected="selected"';
										break;
										case "Veracruz de Ignacio de la Llave";
											$sel_vera = 'selected="selected"';
										break;
										case "Yucatán";
											$sel_yuc = 'selected="selected"';
										break;
										case "Zacatecas";
											$sel_zac = 'selected="selected"';
										break;
									}
								?>
								<form action="" method="post" name="formCP" id="formCP">
									<div class="cart__desk__list">
										<ul class="cart__desc">
											<?
												if ($id_pedido==NULL) $id_pedido = "LG".date('dmYhms').mt_rand(10,99);
													//Método con str_shuffle() 
												/*function generateRandomString($length = 10) { 
													return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
												}
												//$id_pedido2 = generateRandomString();
												//echo "ID PEDIDO"; var_dump($id_pedido2);*/
											?>
											<li>ID: <?=$id_pedido?></li>
											<li>
												<select style="width:200px;" class="place" id="estado" name="estado" onChange="this.form.submit();" required>
													<option selected="selected" value="" >-Selecciona tu Estado-</option>
													<option value="CDMX" <?=$sel_cdmx?>>CDMX</option>
													<option value="Aguascalientes" <?=$sel_agua?>>Aguascalientes</option>
													<option value="Baja California" <?=$sel_bc?>>Baja California</option>
													<option value="Baja California Sur" <?=$sel_bcs?>>Baja California Sur</option>
													<option value="Campeche" <?=$sel_cam?>>Campeche</option>
													<option value="Coahuila de Zaragoza" <?=$sel_coa?>>Coahuila de Zaragoza</option>
													<option value="Colima" <?=$sel_col?>>Colima</option>
													<option value="Chiapas" <?=$sel_chia?>>Chiapas</option>
													<option value="Chihuahua" <?=$sel_chi?>>Chihuahua</option>
													<option value="Durango" <?=$sel_dur?>>Durango</option>
													<option value="Guanajuato" <?=$sel_gua?>>Guanajuato</option>
													<option value="Guerrero" <?=$sel_gue?>>Guerrero</option>
													<option value="Hidalgo" <?=$sel_hid?>>Hidalgo</option>
													<option value="Jalisco" <?=$sel_jal?>>Jalisco</option>
													<option value="México" <?=$sel_mex?>>México</option>
													<option value="Michoacán de Ocampo" <?=$sel_mich?>>Michoacán de Ocampo</option>
													<option value="Morelos" <?=$sel_mor?>>Morelos</option>
													<option value="Nayarit" <?=$sel_nay?>>Nayarit</option>
													<option value="Nuevo León" <?=$sel_nl?>>Nuevo León</option>
													<option value="Oaxaca" <?=$sel_oax?>>Oaxaca</option>
													<option value="Puebla" <?=$sel_pue?>>Puebla</option>
													<option value="Querétaro" <?=$sel_que?>>Querétaro</option>
													<option value="Quintana Roo" <?=$sel_quir?>>Quintana Roo</option>
													<option value="San Luis Potosí" <?=$sel_slp?>>San Luis Potosí</option>
													<option value="Sinaloa" <?=$sel_sin?>>Sinaloa</option>
													<option value="Sonora" <?=$sel_son?>>Sonora</option>
													<option value="Tabasco" <?=$sel_tab?>>Tabasco</option>
													<option value="Tamaulipas" <?=$sel_tam?>>Tamaulipas</option>
													<option value="Tlaxcala" <?=$sel_tlax?>>Tlaxcala</option>
													<option value="Veracruz de Ignacio de la Llave" <?=$sel_vera?>>Veracruz de Ignacio de la Llave</option>
													<option value="Yucatán" <?=$sel_yuc?>>Yucatán</option>
													<option value="Zacatecas" <?=$sel_zac?>>Zacatecas</option>
												</select>
												<input type="hidden" name="id_du" value="<?=$id_du?>">
												<input type="hidden" name="id_pedido" value="<?=$id_pedido?>">
												<input type="hidden" name="total_p" value="<?=$total_p?>">
												<input type="hidden" name="cupon" value="<?=$cupon?>">
												<input type="hidden" name="envio" value="<?=$envio?>">
												<input type="hidden" name="nombre_completo" value="<?=$nombre_completo?>">
												<input type="hidden" name="correo" value="<?=$correo?>">
												<input type="hidden" name="calle" value="<?=$calle?>">
												<input type="hidden" name="cp" value="<?=$cp?>">
												<input type="hidden" name="referencias" value="<?=$referencias?>">
												<input type="hidden" name="telefono" value="<?=$telefono?>">
												<input type="hidden" name="cardName" value="<?=$cardName?>">
												<input type="hidden" name="cardNumber" value="<?=$cardNumber?>">
												<input type="hidden" name="cardMes" value="<?=$cardMes?>">
												<input type="hidden" name="cardAnio" value="<?=$cardAnio?>">
												<input type="hidden" name="orden" value="<?=$orden?>">
											</li>
										</ul>
										<ul class="cart__price">
											<li>$<?=number_format($total_p,2,'.',',')?>MXN</li>
										</ul>
									</div>
								</form>
								<span style="color: #ffffff; background-color: red; font-size: 13px;" class="span_error" id="txtError_Edo"></span>
									<!--<hr>
									<form name="form1" role="form" method="post" action="">
									<span>¿TIENES ALGÚN CUPÓN?</span>
									<div class="coupon__box">
										<input type="text" placeholder="Introduce tu cupón" name="cupon" id="cupon" value="<?=$cupon?>">
										<input type="hidden" name="total_p" value="<?//=$total_p?>">
										<input type="hidden" name="estado" value="<?//=$estado?>">
										<div class="ht__cp__btn">
											<input type="submit" name="aplicar" value="Aplicar"> 
										</div>
									</div>-->
								<div class="cart__total" style="font-weight:600">
									<span>Subtotal</span>
									<span>$<?=number_format($total_pro,2,'.',',')?> MXN</span>
								</div>
								<div class="cart__total" style="font-weight:600">							
									<span>Envío</span>
									<span>$<?=number_format($envio,2,'.',',')?> MXN</span>
								</div>
								<div class="cart__total" style="font-weight:600">
									<span>Total</span>
									<span>$<?=number_format($total_producto,2,'.',',')?> MXN.</span>
								</div>
								<!--</form>-->
								<hr>
								<div class="panel panel-default">
                					<div class="panel-heading">
                    					<h3 class="panel-title">
                        					Tarjeta de Crédito / Débito
                    					</h3>
                					</div>
                					<div class="panel-body">
                    					<form action="orders.php" method="post" name="card-form" id="card-form" >
											<span class="card-errors"></span>
                    						<div class="form-group">
                        						<label for="cardNumber">
                           							NOMBRE DEL TARJETAHABIENTE
                           						</label>
                        						<div class="input-group">
                            						<input class="form-control" id="cardName" name="cardName" placeholder="Validar Nombre" value="<?=$cardName?>" required data-conekta="card[name]" type="text"/>
                            						<span class="input-group-addon">
                            							<span class="glyphicon glyphicon-lock"></span>
                            						</span>
                        						</div>
                        						<label for="cardNumber">
                            						NUMERO DE TARJETA
                            					</label>
                        						<div class="input-group">
                            						<input class="form-control" id="cardNumber" name="cardNumber" placeholder="Validar Tarjeta" value="<?=$cardNumber?>" required autofocus data-conekta="card[number]" type="text"/>
                            						<span class="input-group-addon">
                            							<span class="glyphicon glyphicon-lock"></span>
                            						</span>
                        						</div>
                    						</div>
                    						<div class="row">
                        						<div class="col-xs-7 col-md-7">
                            						<div class="form-group">
                                						<label for="expityMonth">
                                    						EXPIRACIÓN
                                    					</label>
														<?
														if ($cardMes == NULL) $cardMes ="";
														if ($cardAnio == NULL) $cardAnio ="";
														if ($cardCode == NULL) $cardCode ="";
														?>
                                						<div class="col-xs-6 col-lg-6 pl-ziro" style="padding: 0px;">
															<input size="2" class="form-control" id="cardMes" name="cardMes" value="<?=$cardMes?>" placeholder="MM" required data-conekta="card[exp_month]" type="text">
                                						</div>
                                						<div class="col-xs-6 col-lg-6 pl-ziro" style="padding: 0px;">
                                    						<input size="2" class="form-control" id="cardAnio" name="cardAnio" value="<?=$cardAnio?>" placeholder="YYYY" required data-conekta="card[exp_year]" type="text" />
                                    					</div>
                            						</div>
                        						</div>
                        						<div class="col-xs-5 col-md-5 pull-right">
                            						<div class="form-group">
                                						<label for="cvCode">
                                    						CÓDIGO CVC
                                    					</label>
														<input class="form-control" size="4" id="cvCode" name="cardCode" placeholder="CVC" required data-conekta="card[cvc]" type="text">
                            						</div>
                        						</div>
                    						</div>
											<input type="hidden" name="id_du" value="<?=$id_du?>">
											<input type="hidden" name="total_p" value="<?=$total_p?>">
											<input type="hidden" name="cupon" value="<?=$cupon?>">
											<input type="hidden" name="calle" value="<?=$calle?>">
											<input type="hidden" name="estado" value="<?=$estado?>">
											<input type="hidden" name="cp" value="<?=$cp?>">
											<input type="hidden" name="referencias" value="<?=$referencias?>">
											<input type="hidden" name="telefono" value="<?=$telefono?>">
											<input type="hidden" name="envio" value="<?=$envio?>">
											<input type="hidden" name="id_pedido" value="<?=$id_pedido?>">
											<input type="hidden" name="nombre_completo" value="<?=$nombre_completo?>">
											<input type="hidden" name="orden" value="<?=$orden?>">
											<button type="submit" class="fv-btn" id="pagar">Pago Tarjeta</button>
											<br>
											<br>
											<br>
                    					</form>
                					</div>
           						</div>
            					<!--<hr>
            					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="business" value="---@gmail.com">
                                    <input type="hidden" name="upload" value="1">
                                    <input type="hidden" name="currency_code" value="MXN">
                                    <input type="hidden" name="item_name_1" value="L&G15-01-201983450-6">
                                    <input type="hidden" name="amount_1" value="918">
                                    <input type="hidden" name="quantity_1" value="1">
                                    <input type="hidden" name="return" value="successpay.php">
                                    <input type="hidden" name="cancel" value="cancelpay.php">
                                    <button class="btn btn-success btn-lg btn-block" name="submit" value="PAGAR">PAGO PAYPAL</button>
                                </form>
            					<br>
            						<img src="https://www.paypalobjects.com/webstatic/mktg/logo-center/logotipo_paypal_tarjetas.jpg" border="0" alt="Marcas de aceptación">
                                    </div>
                                </div>
                				</div>
            					</div>-->
       						</div>
        					<div style="padding:5px;">
        					</div>
        						<!-- cart-main-area end -->
        						<!-- Start Footer Area -->
        					
        						<!-- End Footer Style -->
    					</div>
    					<!-- Body main wrapper end -->
    					<!-- Placed js at the end of the document so the pages load faster -->
    				</div>
    			</div>
    		</div>
    		<?php include 'footer.php' ?>
    </div>

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
	
	<script type="text/javascript" >
	/////// Key de Pruebas //////
	//Conekta.setPublicKey('key_DX5kTzyuayc1xxpYqqmMNrQ');
	/////// Key de Producción //////
	Conekta.setPublicKey('key_bQdcyaArqAwq5wY1VfzhhUQ');

	var conektaSuccessResponseHandler = function(token) {
	var $form = $("#card-form");
	//Inserta el token_id en la forma para que se envíe al servidor
	 $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
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