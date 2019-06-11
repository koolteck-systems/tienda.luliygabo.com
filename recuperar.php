<?php
session_start();
//echo "SESIÓN "; var_dump($_SESSION);

extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
//echo "REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";

if ($cerrar_session=='si') {
	session_unset();
	session_destroy();
}
/*echo "SESIÓN "; var_dump($_SESSION);*/

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

function validar_pass($pass,&$error_pass){
   if(strlen($pass) < 6){
      $error_pass = "El password debe tener al menos 6 caracteres";
      return false;
   }
   if(strlen($pass) > 18){
      $error_pass = "El password no puede tener más de 18 caracteres";
      return false;
   }/*
   if (!preg_match('`[a-z]`',$pass)){
      $error_pass = "El password debe tener al menos una letra minúscula";
      return false;
   }
   if (!preg_match('`[A-Z]`',$pass)){
      $error_pass = "El password debe tener al menos una letra mayúscula";
      return false;
   }
   if (!preg_match('`[0-9]`',$pass)){
      $error_pass = "El password debe tener al menos un caracter numérico";
      return false;
   }*/
   $error_pass = "";
   return true;
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

      <!--limpiar chace -->
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="https://devitems.com/preview/asbab/apple-touch-icon.png">
    
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

<?
$sql = "SELECT * FROM usuarios WHERE id = '" . $_SESSION['id'] . "'";
//echo "SQL "; var_dump($sql);
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$activo = $row['activo'];
	$nombre = $row['nombre'];
	$apellidos = $row['apellidos'];
}
if ($activo == 1) {
?>
<script language="javascript">
location.href = "index.php";
</script>
<?php
} else {
echo "msg: "; var_dump($msg);
/**
* GUARDAMOS LOS DATOS POR POST
*/
$ok = NULL;
if ($recuperar=="recuperar") {
	//echo "<br>###ENTRÓ 1###";
	if (  $correo==NULL ||  $password==NULL || $vpassword==NULL ) {
		$msg="Todos los campos son Obligatorios.";
		$class="alert alert-info";
	} else {
		### Verificar correo ###				
		$sql = "SELECT correo FROM usuarios WHERE correo = '" . $correo . "'";
		#echo "SQL "; var_dump($sql);
		$result = $conn->query($sql);
		if ($result->num_rows < 1) {
			$msg="El correo no existe, verifique sus datos.";
			$class="alert alert-info";
		} else {
			while($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$nombre = $row['nombre'];
				$apellidos = $row['apellidos'];
				$correo = $row['correo'];						
			}
			if ($password != $vpassword){
				$msg="Las contraseñas no coinciden.";
				$class="alert alert-info";
			} else {
				$error_encontrado="";
				if (validar_pass($password, $error_encontrado)){
					$pass = password_hash($password, PASSWORD_DEFAULT);
					$activo = 1;
					$fecha = date("Y-m-d");
					$sql2 = "UPDATE usuarios SET password = '".$pass."' WHERE correo = '".$correo."' ";
					if ($conn->query($sql2) === TRUE) {
					//echo "SQL: "; var_dump($sql2);
						$class = "alert alert-success";
						$msg = " La contraseña ha sido actualizada.";
						$ok = 1;
						### Generamos la Sesión ###
						$_SESSION['id'] = $id;
						$_SESSION['nombre'] = $nombre;
						$_SESSION['apellidos'] = $apellidos;
						$_SESSION['correo'] = $correo;						

						### ENVIAR CORREO ###						
						$nombre_completo = $nombre." ".$apellidos;
						
						$mail = $correo;
						$email = "info@tiendaluliygabo.com.mx";
						//$cc = "beatriz@klteck.com";
						$bcc = "jesus@klteck.com";
						$asunto = "Contraseña Actualizada con exito en tienda.luliygabo.com";
						$arrDate = explode("-", $fecha);
						$dia = $arrDate[2];
						$mes = $arrDate[1];
						$anio = $arrDate[0];
						$mes_letra=mes_letra($mes);
						#$dia_letra=dia_letra($dia_nombre);
						$fecha_nueva=$dia." de ".$mes_letra." del ".$anio;
							
						$cuerpo = '<!doctype html>
								<html>
								<head>
								<meta charset="UTF-8">
								<title>Registro exitoso</title>
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
										<h1 style="font-size:25px; font-weight:500">CONTRASEÑA ACTUALIZADA CON EXITO</h1>
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
												<td colspan="2" style="font-size:14px; text-align:justify">Gracias por actualizar tu correo en la Tienda de Luli y Gabo. Ahora puedes volver a entrar a comprar tus productos sin problema y de una manera más rápida. <br>
												  <br></td>
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
											<td width="387" align="left"><strong>Tu Correo: '.$correo.'</strong></td>
											<td width="232" align="right"><strong>&nbsp;</strong></td>
											<td width="21">&nbsp;</td>
										  </tr>
										  <tr>
											<td width="10">&nbsp;</td>
											<td width="387" align="left"><strong>Tu Nueva Contraseña: '.$password.'</strong></td>
											<td width="232" align="right"><strong>'.$fecha_nueva.'</strong></td>
											<td width="21">&nbsp;</td>
										  </tr>
										</table></td>
									  </tr>
									  <tr>
										<td height="30">&nbsp;</td>
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

						$encabezado = "MIME-Version: 1.0\r\n";
						$encabezado .= "Content-type: text/html; charset=utf-8\r\n";
						$encabezado .= "From: Luli y Gabo <".$email.">\r\n";
						//$encabezado .= "CC: <$cc>\n";
						$encabezado .= "BCC: <$bcc>\n";

						/*echo "<br>############################mail: "; var_dump($mail); echo "<br>";
						echo "<br>############################asunto: "; var_dump($asunto); echo "<br>";
						echo "<br>############################encabezado: "; var_dump($encabezado); echo "<br>";*/
						
						if(mail($mail,$asunto,$cuerpo,$encabezado)){
							$msg .=  "<br>Recibirás un correo con la información.";
						} else {
							$msg .=  "Error al enviar el correo.";
						}						
						
					} else {
						$class = "alert alert-info";
						$msg=" Los datos no se registraron. Inténtelo de nuevo.";
						$ok = NULL;
					}				   
			   } else {
					$msg="Password NO válido: " . $error_encontrado;
					$class="alert alert-info";
			   }
			}
		}
	}
}
/*$class = "alert alert-success";
$msg=" Los datos han sido actualizados.";
$ok = 1;*/
//echo "MSG "; var_dump($msg);

?>
<body style="bacground-color:#ffc600">

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
        
        
        <!-- Start Product Details Area -->
        <section class="htc__registerboxed htc__product__details ptb--100">


        <div class="register-box col-md-4 col-lg-4 col-sm-6 col-xs-10 mb-55">
        	<div class="logionCerrar">
                <a href="login.php">
                    <img src="images/icons/Cerrar.png">
                </a>
            </div>
			<form id="contact-form" action="recuperar.php" method="post">
				<?php
				if ($msg!=NULL) {
				?>
					<br>
					<div class="<?=$class;?>">
						<center><?=$msg;?></center>
					</div><br><br>
				<?
				}
				if($activo==1){
					?>
					<h2>¡Hola! <?=$nombre?> <?=$apellidos?></h2><br>
					<br><br>
					<?php
				} else {
				?>
				<h2>Recupera tu contraseña</h2>
				<div class="single-contact-form">
					<div class="contact-box subject">
						<input type="email" name="correo" placeholder="correo@luliygabo.com" value="<?=$correo?>">
					</div>
				</div>

				<div class="single-contact-form">
					<div class="contact-box subject">
						<input type="password" name="password" placeholder="Introduzca el nuevo password">
					</div>
				</div>

				<div class="single-contact-form">
					<div class="contact-box subject">
						<input type="password" name="vpassword" placeholder="verificar nuevo password">
					</div>
				</div>
			   
				<div class="contact-btn">
					<button type="submit" class="fv-btn" name="recuperar" value="recuperar">ACEPTAR</button>
				</div>
				<?
				}
				?>
			</form>
			<hr>

			<div style="text-align:center">
				<?
				if($activo==1){
				?>							   
				<div class="single-contact-form" style="margin-top: 10px;">
					Bienvenido(a) a la Tienda de Luli y Gabo.
				</div>
				<?php
				} else {
				?>			   
				
				<?
				}
				?>
			</div>

		   
		</div>

                        
        </section>
        <!-- End Product Details Area -->
       
      
        
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
<?php
}
?>
</html>