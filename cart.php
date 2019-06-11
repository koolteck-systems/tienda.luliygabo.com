<?php
session_start();
//echo "<br>SESIÓN "; var_dump($_SESSION);

extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
//echo "<br>REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";

if ($cerrar_session=='si') {
	session_unset();
	session_destroy();
}
/*echo "SESIÓN "; var_dump($_SESSION);*/

include 'config/db.php';

if ($_GET['removeid']!=NULL ) {
	
    $id_producto   = filter_var($_GET["removeid"], FILTER_SANITIZE_STRING); //get the product code to remove

    if(isset($_SESSION["productos"][$id_producto])) {
        unset($_SESSION["productos"][$id_producto]);
		echo '<script>window.history.back();</script>';
    }
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
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>

	<script type="text/javascript" src="//www.sanwebe.com/wp-content/themes/sanwebe-lite/js/jquery-1.11.2.min.js"></script>
		
	<script type="text/javascript">
	jQ = jQuery.noConflict( true );
	jQ(document).ready(function() {
		jQ('body').on('click', '.qtyplus', function(){			
			var id = jQ(this).attr('data-code');
			var cantidad = jQ(this).attr('data-cantidad');
			//alert ("ID: "+ id);
			if (cantidad==2) {
				alert("¡No puede comprar más de 2 artículos de cada producto por pedido!");
			} else {
				var dataString = 'qtyplus='+id;
				jQ.ajax({ //make ajax request to cart_process.php
					url: "includes/cart_process.php",
					type: "GET",
					data: dataString,
				}).done(function(data){ //on Ajax success
					//jQ('#total_p').html(total_p_text); //reset button text to original text
					location.reload(true);
				})
			}
		});
		jQ('body').on('click', '.qtyminus', function(){			
			var id = jQ(this).attr('data-code');
			var cantidad = jQ(this).attr('data-cantidad');
			var nameProduct = jQ(this).attr('data-name');
			if (cantidad==1) {
				alert("¡No puede dejar la cantidad del producto en 0, por favor elimine el Producto presionando la 'x' a un lado de la imagen!");
			} else {
				//alert ("ID: "+ id);
				var dataString = 'qtyminus='+id;		
				//alert ("Data: "+ dataString);		
				
				jQ.ajax({ //make ajax request to cart_process.php
					url: "includes/cart_process.php",
					type: "GET",
					data: dataString,
				}).done(function(data){ //on Ajax success
					location.reload();
				})
			}				
		});             
	});    
	</script>
	<script type="text/javascript">
	jQ = jQuery.noConflict( true );
	jQ(document).ready(function() {	              
	});    
	</script>
</head>

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
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">      
						<div class="table-content table-responsive">
							<table>
	
								<?php
								if ($msg!=NULL) {
								?>
								<tr>
									<th colspan="4" style="text-align: center; color:<?=$color?>; background-color:#fff; font-size: 29px;"><?php echo $msg; ?></th>
								</tr>
								<?php
								}
								
								if( isset($_SESSION["productos"]) && (count($_SESSION["productos"])>0) ){ //if we have session variable
								?>	
								<thead>
									<tr>
										<th class="product-thumbnail">Producto</th>
										<th class="product-price">Precio</th>
										<th class="product-quantity">Cantidad</th>
										<th class="product-subtotal">Total</th>
										
									</tr>
								</thead>
								<tbody>									
					
								<?php
									$total = 0;
									$i=0;
									foreach($_SESSION["productos"] as $producto){ //loop though items and prepare html content
										$i++;
										$carrito = "<!-- Item #".$i." -->
													<tr>";
										
										//set variables to use them in HTML content below
										$id = $producto["id_producto"];
										$nombre = $producto["nombre"]; 
										$precio = $producto["precio"];
										$cantidad = $producto["cantidad"];
										$total_producto = $cantidad * $precio;
										$precio_format = number_format($precio,2,'.',',');
										
										### Obtener Imagen ###
										include 'config/db.php';
										$sql = "SELECT sku, imagen FROM productos WHERE id = '$id' ";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												//echo "row: <pre>"; var_dump($row); echo "</pre>";
												$imagen = $row["imagen"];
												$sku = $producto["sku"];
											}
										}	
										$conn->close();
										
										$carrito .=  '<tr style="line-height: 14px;">';
										$carrito .=  '    <td class="product-thumbnail">';
										$carrito .=  '        <div class="col-md-1 col-sm-1 col-xs-1 table-title">';
										$carrito .=  '        <a href="cart.php?removeid='.$id.'"><i class="fas fa-times"></i></a> ';
										$carrito .=  '        </div>';
										$carrito .=  '        <div class="col-md-4 col-sm-4 col-xs-4" style="padding: 0px;">';
										$carrito .=  '            <img src="'.$imagen.'" alt="product img" />';
										$carrito .=  '        </div>';
										$carrito .=  '        <div class="col-md-6 col-sm-6 col-xs-6 table-title">'.$nombre.'</div>';                                            
										$carrito .=  '	</td>';
										$total_producto = $precio * $cantidad;                                            
										$carrito .=  '	<td class="product-price"><span class="amount">$'.number_format($precio,2,'.',',').' MXN</span></td>';
										$carrito .=  '	<td class="product-quantity">
														<form action="#">
														<div style="margin: 0 auto;">
															<div class="fa fa-minus btn-menos qtyminus" data-code="'.$id.'" data-cantidad="'.$cantidad.'" data-name="'.$nombre.'" ></div>
															<input class="qty" name="cantidad_'.$id.'" size="2" type="texto" value="'.$cantidad.'">
															<div class="fa fa-plus btn-mas qtyplus"  data-code="'.$id.'" data-cantidad="'.$cantidad.'" data-name="'.$nombre.'"></div>
														</form>
														</td>';
										$carrito .=  '	<td class="product-subtotal">$'.number_format($total_producto,2,'.',',').' MXN</td>';
										$carrito .=  '</tr>';
										
										$total_p = ($total_p + $total_producto);
										echo $carrito;
										if ($i==1) $orden = $cantidad." ".$nombre;
										else $orden .= " / ".$cantidad." ".$nombre;
									}
									?>
								
									
								<?php
								} else {
									echo '<tr><td colspan="4" style="text-align:center;">Tu carrito está vacío</td></tr>'; //we have empty cart
								?>
								</tbody>
								<?php
								}
								?>
							</table>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="buttons-cart--inner">
									<div class="buttons-cart-regresar">
										<a href="index.php">
											<i class="flecha fas fa-arrow-left"></i>
											Seguir Comprando
										</a>
									</div>
								</div>
							</div>
						</div>
						
                    </div>
                    <div class="resume-box col-md-4 col-sm-4 col-xs-12 smt-40 xmt-40">
						<div class="htc__cart__total">
							<h2>Total de tu carrito</h2>
							<div class="cart__desk__list">
								<ul class="cart__desc">
									<li>Subtotal</li>
									<!--<li>Envio</li>
									<li>
									<select class="place" id="estado" name="estado">
											<option selected="" value="CDMX">CDMX</option>
											<option value="Aguascalientes">Aguascalientes</option>
											<option value="Baja California">Baja California</option>
											<option value="Baja California Sur">Baja California Sur</option>
											<option value="Campeche">Campeche</option>
											<option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
											<option value="Colima">Colima</option>
											<option value="Chiapas">Chiapas</option>
											<option value="Chihuahua">Chihuahua</option>
											<option value="Distrito Federal">Distrito Federal</option>
											<option value="Durango">Durango</option>
											<option value="Guanajuato">Guanajuato</option>
											<option value="Guerrero">Guerrero</option>
											<option value="Hidalgo">Hidalgo</option>
											<option value="Jalisco">Jalisco</option>
											<option value="México">México</option>
											<option value="Michoacán de Ocampo">Michoacán de Ocampo</option>
											<option value="Morelos">Morelos</option>
											<option value="Nayarit">Nayarit</option>
											<option value="Nuevo León">Nuevo León</option>
											<option value="Oaxaca">Oaxaca</option>
											<option value="Puebla">Puebla</option>
											<option value="Querétaro">Querétaro</option>
											<option value="Quintana Roo">Quintana Roo</option>
											<option value="San Luis Potosí">San Luis Potosí</option>
											<option value="Sinaloa">Sinaloa</option>
											<option value="Sonora">Sonora</option>
											<option value="Tabasco">Tabasco</option>
											<option value="Tamaulipas">Tamaulipas</option>
											<option value="Tlaxcala">Tlaxcala</option>
											<option value="Veracruz de Ignacio de la Llave">Veracruz de Ignacio de la Llave</option>
											<option value="Yucatán">Yucatán</option>
											<option value="Zacatecas">Zacatecas</option>
									</select><br><small>Cambiar Estado</small>
									</li>-->
								</ul>
								<ul class="cart__price">
									<li id="total_producto">$<?=number_format($total_p,2,'.',',')?> MXN</li>
									<!--<li>$0.00
										<br></li>-->
								</ul>
							</div>
							<!--<div class="cart__total" style="font-weight:600">							   
						
									<span>Total</span>
									<span id="total_p">$<?//=number_format($total_p,2,'.',',')?> MXN.</span>
							</div>
							<hr>
							<form name="form1" role="form" method="post" action="cart.php">
							<span>¿TIENES ALGÚN CUPÓN?</span>
							<div class="coupon__box">
								<input type="text" placeholder="Introduce tu cupón" name="cupon" id="cupon" value="<?//=$cupon?>">
								<input type="hidden" name="total_producto" value="<?//=$total_producto?>">
								<div class="ht__cp__btn">
									<input type="submit" name="aplicar" value="Aplicar"> 
									<!--<a href="" onclick="document.form1.submit();">APLICAR</a>-->
								<!--</div>
							</div>
							</form>-->

							<hr>
							<form name="form2" role="form" method="post" action="user-payment.php">
							<ul class="payment__btn">
								<li>
									<input type="submit" name="comprar" value="Comprar" class="btn-Compra">
									<!--<a href="" onclick="document.form2.submit();" style="color:#fff;" class="fv-btn">COMPRAR</a>-->
								</li>
							</ul>
							<input type="hidden" name="orden" value="<?=$orden?>">
							<input type="hidden" name="total_p" value="<?=$total_p?>">
							</form>
							
						</div>
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