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
    <!-- Perfil style -->
    <link rel="stylesheet" href="css/Terminos.css">
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
        <div class="container Terminos">
            <div class="row">
                

                <div class="col-md-12 p-b-30">
                    <h3 class="Terminos-title">
                        Términos y Condiciones
                    </h3>
            
                    <p style="text-align:justify;">
                        <span style="color:#333333; font-weight:bold;">RESPONSABILIDAD</span>
                        <br><br>
                        Hay casos en los cuales una orden de compra puede no ser procesada por circunstancias ajenas a nosotros y las cuales no pueden ser previstas, circunstancias en las cuales interviene la fuerza mayor 
                        o el caso fortuito, en ese sentido, Luli y Gabo, informara al cliente de inmediato el motivo por el cual no fue posible procesar una orden, restituyendo el costo o producto (s) al suscriptor, 
                        dejando claro que en este proceso se puede pedir información adicional para completar el proceso.
                        <br><br>
                        Asimismo, se refiere que todos los productos ofertados en el sitio <span style="color:#333333; font-weight:bold;">tienda.luliygabo.com</span>, están sujetos a disponibilidad y se ofrecen a nuestros suscriptores hasta agotar existencias, por lo que puede 
                        darse el caso que un mismo producto pueda ser adquirido por varios clientes a la vez y al final del proceso de venta resulte que el producto ya no se encuentre disponible por haberse agotado, aun y cuando 
                        aparezca en el sitio web <span style="color:#333333; font-weight:bold;">tienda.luliygabo.com</span>, en cuyo caso se le informara al suscriptor de tal situación procediendo al reembolso de cualquier cantidad pagada por el producto adquirido si es el caso 
                        o bien se le notificará de la imposibilidad de procesar la orden de compra. <!--<span style="color:#e45a38; font-weight:bold;">LAS IMÁGENES SON DE CARÁCTER ILUSTRATIVO Y EL PRODUCTO PUEDE VARIAR DE LA MISMA</span>.-->
                        <br><br>
                        Si derivado de algunos de los supuestos contemplados en el presente apartado, o de otras circunstancias, tuviéramos que reembolsar al suscriptor alguna cantidad, este reembolso previó consentimiento 
                        del suscriptor podrá adquirir productos sin restricción de categoría o mínimo de compra.
                        <br><br>
                        El suscriptor antes de la compra del producto, debe aceptar las condiciones particulares de venta, siendo el caso que los presente términos y condiciones generales podrán verse adicionados, limitados o 
                        modificados en función de las correspondientes condiciones particulares de venta del producto de que se trate, en caso de conflicto o contradicción en los presentes términos y condiciones y las condiciones 
                        particulares de venta, estas últimas prevalecerán sobre las primeras, en consecuencia el suscriptor debe leer con atención además de los presente términos y condiciones, las condiciones particulares de venta, 
                        las cuales se entenderán aceptadas en el momento que el suscriptor proceda a la compra del producto.
                        <br><br>
                        Todas las ofertas de venta, comunicaciones, solicitudes de información entre otros, se realizan a través del sitio <span style="color:#333333; font-weight:bold;">tienda.luliygabo.com</span>, mi representada no será responsable de comunicaciones que se envíen 
                        fuera de este sitio, asimismo tampoco será responsable por depósitos en efectivo, transferencias o pagos mediante tarjetas de crédito que hagan los suscriptores a cuentas diversas a las autorizadas en la compra 
                        de productos, refiriéndose que jamás se hacen solicitudes de depósito a cuentas de particulares.
                        <br><br>
                        <br>
                        <span style="color:#333333; font-weight:bold;">GARANTÍA DE LOS PRODUCTOS</span>
                        <br><br>
                        La garantía de los productos será brindada directamente por los fabricantes o distribuidores de los mismos, la duración de dichas garantías se refiere claramente en la descripción de cada producto y es emitida 
                        y validada por el fabricante o distribuidor de cada producto, <a href="www.koolteck.com.mx" target="_blank">Koolteck Systems SA de CV.</a>, no asume responsabilidad alguna en torno a dichas garantías y el 
                        suscriptor se obliga a contactar directamente al proveedor o fabricante del producto de que se trate para hacer efectiva dicha garantía.
                        <br><br>
                        Junto con el producto adquirido el suscriptor recibirá un manual de usuario, en donde aparecen las instrucciones para el correcto uso e instalación del producto adquirido, así como toda la información de la 
                        garantía que el fabricante hubiere conferido, ningún suscriptor podrá solicitar una garantía más amplia de la que ahí se indique.
                        <br><br>
                        <a href="www.koolteck.com.mx" target="_blank">Koolteck Systems SA de CV.</a>, no será responsable por las garantías otorgadas por los fabricantes o distribuidores de los productos, pero realizará todas las 
                        acciones tendientes a proporcionar a los suscriptores que así lo soliciten los datos de contacto de dicho servicio.
                        <br><br>
                        Algunos productos cuentan con una garantía que será brindada directamente por <a href="www.koolteck.com.mx" target="_blank">Koolteck Systems SA de CV.</a>, los términos y condiciones particulares, así como la 
                        temporalidad de las mismas, se darán a conocer a los suscriptores junto con la descripción de los productos que le apliquen tales garantías.
                        <br><br>
                        <span style="color:#333333; font-weight:bold;">LEY APLICABLE Y JURISDICCIÓN</span>
                        <br><br>
                        Para la interpretación y cumplimiento de los presentes términos y condiciones, las partes se someten a la jurisdicción de los tribunales de la Ciudad de México renunciado expresamente a cualquier otro fuero 
                        que pudiere corresponderles por razón de sus domicilios presentes o futuros.
                        <br><br>
                        <span style="color:#333333; font-weight:bold;">POLÍTICA DE REEMBOLSO</span>
                        <br><br>
                           Comprar en línea puede ser difícil debido a que no tenemos los productos disponibles al tacto. Si un cliente no está satisfecho con nuestros productos y decide que quiere hacer el reembolso de sus productos, deben enviar un correo a <b>info@tiendaluliygabo.com.mx</b> donde incluya su nombre y número de pedido. Se le enviará una guia prepagada de DHL.
                            <br><br>
                            El cliente tiene 5 días hábiles para imprimir la guía y entregarla junto con su paquete en un DHL cercano. El reembolso no aplica sobre productos dañados o en mal estado. El envío tarda entre 2-3 días hábiles, en cuanto recibamos el paquete notificaremos al cliente que su reembolso está en proceso. El rembolso tarda hasta 30 dias habiles.
                        <br><br>
                        <span style="color:#333333; font-weight:bold;">CONTACTO:</span>
                        <br>
                        <a href="mailto:info@tiendaluliygabo.com.mx">info@tiendaluliygabo.com.mx </a>
                    </p>
                </div>
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