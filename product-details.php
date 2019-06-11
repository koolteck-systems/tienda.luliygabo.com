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

    <!--limpiar chace -->
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<?php

if ($agregar=='si') {	
	$_SESSION["productos"][$id_producto]["id_producto"]=$id_producto;
	$_SESSION["productos"][$id_producto]["nombre"]=$nombre;
	$_SESSION["productos"][$id_producto]["precio"]=$precio;
	 
	if( isset($_SESSION["productos"][$id_producto]) ){ //if we have session variable
		if ($_SESSION["productos"][$id_producto]['cantidad'] == 0) $_SESSION["productos"][$id_producto]['cantidad'] = $cantidad;
		else if ($_SESSION["productos"][$id_producto]['cantidad'] <= 2) $_SESSION["productos"][$id_producto]['cantidad'] = 2;
		else $_SESSION["productos"][$id_producto]['cantidad']= $cantidad; //agregar item
		//echo "<br>SESSION: <pre>"; var_dump($_SESSION["productos"][$id_producto]['cantidad']); echo "</pre>"; 
	} else {
		$_SESSION["productos"][$id_producto]["cantidad"]=$cantidad;
	}
	?>
	<script language="javascript">
	location.href = "cart.php";
	</script>
	<?php
}
?>
<body>

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

		<?php
				
		$sql = "SELECT * FROM productos WHERE id = '".$_GET['id_producto']."' AND activo = 1 ";
		//echo "SQL: "; var_dump($sql);
		$result = $conn->query($sql);
		$num_total_registros = $result->num_rows;

		//Si hay registros
		if ($num_total_registros > 0) {
			while($row = $result->fetch_assoc()) {
				$id_p = $row['id'];
				$sku = $row['sku'];
				$nombre = $row['nombre'];
				$descripcion = $row['descripcion'];
				$detalles = $row['detalles'];
				$categoria = $row['categoria'];
				$color = $row['color'];
				$marca = $row['marca'];
				$precio = $row['precio'];
				$imagen = $row['imagen'];
				$imagen2 = $row['imagen2'];
                $imagen3 = $row['imagen3'];
                $imagen4 = $row['imagen4'];
                $imagen5 = $row['imagen5'];
				$p_activo = 1;
			} 
		} else  {
			$p_activo = 0;
		}
		$id = $_GET['id_producto'];
		$precio_format = number_format($precio,2,'.',',');
		if ($cantidad=='' || $cantidad==NULL) $cantidad = 1;
		
		?>        
        
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white pt--70 pb--200 mbm40">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="<?=$imagen?>" alt="full-image">
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="img-tab-2">
                                            <img src="<?=$imagen2?>" alt="full-image">
                                        </div>
                                         <div role="tabpanel" class="tab-pane fade" id="img-tab-3">
                                            <img src="<?=$imagen3?>" alt="full-image">
                                        </div>
                                         <div role="tabpanel" class="tab-pane fade" id="img-tab-4">
                                            <img src="<?=$imagen4?>" alt="full-image">
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="img-tab-5">
                                            <img src="<?=$imagen5?>" alt="full-image">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                <!-- Start Small images -->
                                <ul class="product__small__images" role="tablist">
                                    <li role="presentation" class="pot-small-img active">
                                        <a href="product-details.php#img-tab-1" role="tab" data-toggle="tab">
                                            <img src="<?=$imagen?>" alt="small-image">
                                        </a>
                                    </li>
                                    <li role="presentation" class="pot-small-img">
                                        <a href="product-details.php#img-tab-2" role="tab" data-toggle="tab">
                                            <img src="<?=$imagen2?>" alt="small-image">
                                        </a>
                                    </li>
                                    <li role="presentation" class="pot-small-img">
                                        <a href="product-details.php#img-tab-3" role="tab" data-toggle="tab">
                                            <img src="<?=$imagen3?>" alt="small-image">
                                        </a>
                                    </li>
                                    <li role="presentation" class="pot-small-img">
                                        <a href="product-details.php#img-tab-4" role="tab" data-toggle="tab">
                                            <img src="<?=$imagen4?>" alt="small-image">
                                        </a>
                                    </li>
                                    <li role="presentation" class="pot-small-img">
                                        <a href="product-details.php#img-tab-5" role="tab" data-toggle="tab">
                                            <img src="<?=$imagen5?>" alt="small-image">
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Small images -->
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-65">

                        <div class="ht__product__dtl" style="margin-bottom: 40px;">
                                <h2><?=$nombre?></h2>
                                <h6>Modelo: <span><?=$sku?></span></h6>
                        </div>        

                        <div class="col-xs-12" style="padding:0px">
                            <!-- Start List And Grid View -->
                            <ul class="pro__details__tab" role="tablist">
                                <li role="presentation" class="description active"><a href="product-details.php#description" role="tab" data-toggle="tab">DESCRIPCIÓN</a></li>
                                <li role="presentation" class="review"><a href="product-details.php#review" role="tab" data-toggle="tab">DETALLES</a></li>
                                <li role="presentation" class="shipping"><a href="product-details.php#shipping" role="tab" data-toggle="tab">ENVÍO</a></li>
                            </ul>
                            <!-- End List And Grid View -->
                        </div>

                        <div class="col-xs-12" style="padding:0px">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <p>
                                        <?=nl2br($descripcion)?>
                                    </p>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="review" class="pro__single__content tab-pane fade">
                                <div class="pro__tab__content__inner">
                                <p><?=nl2br($detalles)?></p>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="shipping" class="pro__single__content tab-pane fade">
                                <div class="pro__tab__content__inner">
                                <p> Ofrecemos servicios de paquetería express en la CDMX y cualquier parte de la República.</p>
                                </div>
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>


                    
                                    <div>
										<form name="formulario" method="post" action="">
                                        <div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
                                            <p class="Pregunta">
                                                <span><b>PIEZAS</b></span>
                                            </p>
                                        </div>
                                        <div class="col-md-7 col-lg-7 col-sm-7 col-xs-6">
                                            <br><br>
                                            <p>
                                                <span class="quantity">
                                                    <input type="number" name="cantidad" value="1" min="1" max="2">
                                                </span>
                                            </p>
                                        </div>

                                        <div class="col-md-5 col-lg-5 col-sm-5 col-xs-6" style="padding:49px 0px">
                                            <p class="col-md-8 col-lg-8 col-sm-8 col-xs-8 cr__pro__prize">
                                                    <small>$</small><?=$precio?>
                                                </p>
                                                <p class="col-md-3 col-lg-3 col-sm-3 col-xs-3 cr__pro__device">
                                                    00<br><small>MXN</small>
                                            </p>
											<input type="hidden" name="precio" value="<?=$precio?>">
											<input type="hidden" name="detalle" value="1">
											<input type="hidden" name="id_producto" value="<?=$id_p?>">
											<input type="hidden" name="nombre" value="<?=$nombre?>">
											<input type="hidden" name="agregar" value="si">
                                        </div>

                                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="0px">
                                         <hr>
                                         <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 "></div>
                                         <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 ">
                                            <ul class="shopping__btn">
                                                <li><a href="#" onClick="document.formulario.submit();">Agregar al Carrito</a></li>
                                            </ul>

                                            </div>
                                        </div>
										</form>
                                        
                                    </div>
                            
                                   <!--<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                       <div class="Compartir">
                                           Comparte con tus amigos:
                                       </div>
                                       <div>
                                            <a href="https://www.facebook.com/luliygabo/" target="_blank">
                                                <div>
                                                  <i class="fab fa-facebook-f"></i>  
                                                </div>
                                            </a>
                                           <ul>
                                               <li>
                                                   <a href="https://www.facebook.com/luliygabo/" target="_blank">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                               </li>
                                           </ul>
                                       </div>
                                   </div>-->
                                    
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 sin__desc product__share__link">
                                        <div class="Compartir"><span><b>Comparte con tus amigos:</b></span></div>

                                         <div class="ft__social__link">
                                            <ul class="social__link">
                                                <li>
                                                    <a href="https://www.facebook.com/luliygabo/" target="_blank" onclick="ga('send', 'event', 'Redes Sociales', 'click', 'Facebook');">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.youtube.com/user/GNPviviresincreible" target="_blank"><i class="fab fa-youtube"></i></a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/gnpseguros" target="_blank"><i class="fab fa-twitter"></i></a>
                                                </li>
                                        
                                                <li>
                                                    <a href="https://www.instagram.com/luliygabo/" target="_blank"><i class="fab fa-instagram"></i></a>
                                                </li>
                                            </ul>
                                        </div>
    
                                    </div>
                                
                                    
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <!-- End Product Details Area -->
       
        <!-- Start Product Area -->
        <!--<section class="htc__product__area--2 pb--100 product-details-res">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center PT100">
                            <h2 class="title__line">Similares</h2>
                            <p>Los mejores estilos de Gabo.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__wrap clearfix">

                    
                        --Start Single Category --

                       <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <a href="product-details.php?id_producto=1">
                                <div class="category green_home">
                                    <div class="ht__cat__thumb text-center">
                                        <img src="images/product/examples/Gabo.png" alt="product images">
                                    </div>
                                   
                                    <div class="fr__product__inner">
                                        <h4>Peluche Gabo</h4>
                                            <p class="col-md-8 col-lg-8 col-sm-8 col-xs-8 fr__pro__prize">
                                                <small>$</small>649
                                            </p>
                                            <p class="col-md-3 col-lg-3 col-sm-3 col-xs-3 fr__pro__device">
                                                00<br><small>MXN</small>
                                            </p>
                                        <p class="category_bot col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            COMPRAR
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            -- End Single Category --
                           

                           -- Start Single Category --
                           <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <a href="product-details.php?id_producto=2">
                                <div class="category orange_home">
                                    <div class="ht__cat__thumb text-center">
                                        <img src="images/product/examples/PijamaGabo.png" alt="product images">
                                    </div>
                                   
                                    <div class="fr__product__inner">
                                        <h4>PIJAMA GABZILLA</h4>
                                        <p class="col-md-8 col-lg-8 col-sm-8 col-xs-8 fr__pro__prize">
                                            <small>$</small>150
                                        </p>
                                        <p class="col-md-3 col-lg-3 col-sm-3 col-xs-3 fr__pro__device">
                                            00<br><small>MXN</small>
                                        </p>
                                        <p class="category_bot col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            COMPRAR
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            -- End Single Category --

                            
                            -- Start Single Category --
                           <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">f
                                <a href="product-details.php?id_producto=1">
                                <div class="category yellow_home">
                                    <div class="ht__cat__thumb text-center">
                                        <img src="images/product/examples/Gabo.png" alt="product images">
                                    </div>
                                   
                                    <div class="fr__product__inner">
                                        <h4>Peluche Gabo</h4>
                                        <p class="col-md-8 col-lg-8 col-sm-8 col-xs-8 fr__pro__prize">
                                            <small>$</small>649
                                        </p>
                                        <p class="col-md-3 col-lg-3 col-sm-3 col-xs-3 fr__pro__device">
                                            00<br><small>MXN</small>
                                        </p>
                                        <p class="category_bot_v2 col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            COMPRAR
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            -- End Single Category --

                            
                        
                    </div>
                </div>
            </div>
        </section>-->
        <!-- End Product Area -->
       
        
        <!-- End Banner Area -->
        
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