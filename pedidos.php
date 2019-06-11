<?php
session_start();
//echo "SESIÓN <pre>"; var_dump($_SESSION); echo "</pre>";
/*echo "POST "; var_dump($_POST);*/

ini_set('display_errors','off');
ini_set('display_startup_errors','off');
error_reporting(1);

if ($_POST['cerrar_session']=='si') {
	session_unset();
	session_destroy();
}

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

      <!--limpiar chace -->
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
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
    <!-- Pedidos style -->
    <link rel="stylesheet" href="css/pedidos.css">
    <!--Font GOOGLE-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet">

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>

    <script type="text/javascript" src="//www.sanwebe.com/wp-content/themes/sanwebe-lite/js/jquery-1.11.2.min.js"></script>
<body>
    
    <div class="wrapper">
        <!-- Start Header Style -->
        <?php include 'header.php' ?>
        <!-- End Header Area -->
        <div class="container pedidos">
            <div class="col-md-12">
                <table cellspacing="0" cellpadding="0" id="mi-tabla" class="tabla">
				<?php
				if ($_SESSION["id"]==NULL || $_SESSION["id"]=="") {
					?>
					<tr>
					  <td>Necesitas estar registrados para ver tus pedidos.</td>
					</tr>
					<?php
				} else {
					include 'config/db.php';
					
					$sql = "SELECT p.*, pr.nombre AS nombre, pr.precio, pr.imagen
							FROM pedidos AS p, productos AS pr
							WHERE p.id_usuario =  '".$_SESSION['id']."'
							AND p.id_producto = pr.id
							AND p.comprado = 1
							ORDER BY p.id ASC ";
					//echo "<br>SQL: "; var_dump($sql);
					$result = $conn->query($sql);
					
					$num_total_registros = $result->num_rows;
					//echo "<br>REGS: "; var_dump($num_total_registros);

					if ($num_total_registros>=1) {
					?>
					  <thead>
							<tr>
							  <th><span>Producto</span></th>
							  <th><span>Precio</span></th>
							  <th><span>Cantidad</span></th>
							  <th><span>Total</span></th>
							  <th><span>Compra</span></th>
							  <th><span>Rastrea tu pedido</span></th>
							</tr>
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
							$id_order = $row['id_order'];
							$arrDate = explode("-", $fecha);
							$dia = $arrDate[2];
							$mes = $arrDate[1];
							$anio = $arrDate[0];
							$mes_letra = mes_letra($mes);
							#$dia_letra = dia_letra($dia_nombre);
							$fecha_nueva = $dia." de ".$mes_letra." del ".$anio;
							$total_productos = $total_productos + $precio_total;
							//echo "<br>ID ORDER: "; var_dump($id_order);
							if ($id_order!=NULL || $id_order!="") $liga_rastreo = " ID ORDER: <a href=\"http://www.99minutos.com/rastreo_shopify.php?counter=".$id_order."\" target=\"_blank\">".$id_order;
							else $liga_rastreo = "Tu pedido llegará de 2 a 3 días hábiles después de tu compra, en horario de oficina (9:00 am - 6:00 pm) ";
							
						?>
							<tr>
							  <td class="align-left">
								  <img class="ProductoGabo" src="<?=$imagen?>">
								  <?=$nombre?>
							  </td>
							  <td>$<?=number_format($precio,0,'.',',');?> MXN</td>
							  <td><?=$cantidad;?></td>
							  <td>$<?=number_format($precio_total,0,'.',',');?> MXN</td>
							  <td><?=$fecha_nueva;?></td>
							  <td><?=$liga_rastreo;?></td>
							</tr>                                        
						<?php
						}
						$conn->close();
						?>
					</tbody>
					<?php
					} else {
						?>
						<tr>
						  <td colspan="6">No tienes ningún pedido aún.</td>
						</tr>
						<?php
					}
				}
				?>
                </table>
            </div>
        </div>
    
        <!-- End Offset Wrapper -->
     
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