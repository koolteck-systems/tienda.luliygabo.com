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
    <!--Meta Facebook-->
    <meta property="og:url" content="https://tiendaluliygabo.com.mx/">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Luli y Gabo - Tienda en Línea">
    <meta property="og:description" content="Luli y Gabo Tienda en Línea">
    <meta property="og:image" content="https://tiendaluliygabo.com.mx/images/logo/LuliyGabo-logo.png">
    <meta property="fb:app_id" content="387836858675915">
    <!--End Facebook-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Luli y Gabo - Tienda en Línea</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--limpiar chace -->
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
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

<body>

    <!-- Body main wrapper start -->
    <div class="wrapper">
        
        <?php include 'header.php' ?>

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

        <!-- Start Slider Area -->
        <div class="slider__container slider--one bg__cat--3">
            <div class="slide__container slider__activation__wrap  owl-carousel">

                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height bg-gabo">
                    <div class="container">
                        <div class="row align-items__center">
                            
                            <div class="col-lg-7 col-sm-7 col-xs-12 col-md-7">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/1.png" alt="slider images">
                                </div>
                            </div>

                            <div class="col-lg-5 col-sm-5 col-xs-12 col-md-5   ">
                                    <div class="slide">
                                        <div class="slider__inner">
                                            
                                            <h1>Gabo de Peluche</h1>
                                            <h2>Es ingenioso, travieso, confiado y divertido.<br>
                                                Gabo fue el regalo de Luli cuando cumplió cinco años. Los adultos lo ven como un hurón de peluche, pero gracias a la imaginación de Luli, Gabo cobra vida convirtiéndose en un hurón muy inquieto.</h2>
                                            <div class="cr__btn">
                                                <a href="product-details.php?id_producto=1">COMPRAR</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height bg-gabo">
                    <div class="container">
                        <div class="row align-items__center">
                            
                            <div class="col-lg-7 col-sm-7 col-xs-12 col-md-7">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/2.png" alt="slider images">
                                </div>
                            </div>

                            <div class="col-lg-5 col-sm-5 col-xs-12 col-md-5   ">
                                    <div class="slide">
                                        <div class="slider__inner">
                                            <h1 class="pijama-title">Pijama Gabzilla</h1>
                                            <h2>Atuendo de Gabzilla </h2>
                                            <div class="cr__btn">
                                                <a href="product-details.php?id_producto=2">
                                                    COMPRAR
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- Start Slider Area -->

        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Nuestros nuevos accesorios ya disponibles</h2>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">

                            <!-- Start Single Category -->
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                <a href="product-details.php?id_producto=1">
                                <div class="category green_home">
                                    <div class="ht__cat__thumb text-center">
                                        <img src="images/product/examples/Gabo.png" alt="product images">
                                    </div>
                                   
                                    <div class="fr__product__inner">
                                        <h4>Gabo de Peluche</h4>
                                            <div class="prize">
                                                <div class="col-md-12 text-center">
                                                    <p class="fr__pro__prize1">
                                                        <small>$</small>599
                                                        <span class="fr__pro__device1">
                                                            00 </span><small class="mxn">MXN</small>
                                                        
                                                    </p>
                                                </div>
                                                <div class="device">
                                                    
                                                </div>

                                            </div>
                                            <!--<div class="prize">
                                                <div class="col-md-12 text-center">
                                                    <p class="col-md-8 col-lg-8 col-sm-8 col-xs-8 fr__pro__prize">
                                                        <small>$</small>599
                                                    </p>
                                                    <p class="col-md-3 col-lg-3 col-sm-3 col-xs-3 fr__pro__device">
                                                        00<br><small>MXN</small>
                                                    </p>
                                                </div>
                                            </div>-->
                                        <p class="category_bot col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            COMPRAR
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <!-- End Single Category -->
                           

                           <!-- Start Single Category -->
                           <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                <a href="product-details.php?id_producto=2">
                                <div class="category orange_home">
                                    <div class="ht__cat__thumb text-center">
                                        <img src="images/product/examples/PijamaGabo2.png" alt="product images">
                                    </div>
                                   
                                    <div class="fr__product__inner">
                                        <h4>Pijama Gabzilla</h4>
                                        <div class="prize">
                                            <div class="col-md-12 text-center">
                                                <p class="fr__pro__prize1">
                                                    <small>$</small>149
                                                    <span class="fr__pro__device1">00 </span><small class="mxn">MXN</small>
                                                </p>
                                            </div>
                                            <div class="device">
                                                    
                                            </div>

                                        </div>
                                        <!--<div class="prize">
                                            <p class="col-md-8 col-lg-8 col-sm-8 col-xs-8 fr__pro__prize pijama-prize">
                                                <small>$</small>149
                                            </p>
                                            <p class="col-md-3 col-lg-3 col-sm-3 col-xs-3 fr__pro__device">
                                                00<br><small>MXN</small>
                                            </p>
                                        </div>-->
                                        <p class="category_bot col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            COMPRAR
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <!-- End Single Category -->

                            
                            <!-- Start Single Category 
                           <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                                <a href="product-details.php?id_producto=1">
                                <div class="category yellow_home">
                                    <div class="ht__cat__thumb text-center">
                                        <img src="images/product/examples/Gabo.png" alt="product images">
                                    </div>
                                   
                                    <div class="fr__product__inner">
                                        <h4>Gabo de Peluche</h4>
                                        <div class="prize">
                                            <p class="col-md-8 col-lg-8 col-sm-8 col-xs-8 fr__pro__prize">
                                                <small>$</small>599
                                            </p>
                                            <p class="col-md-3 col-lg-3 col-sm-3 col-xs-3 fr__pro__device">
                                                00<br><small>MXN</small>
                                            </p>
                                        </div>
                                        <p class="category_bot_v2 col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                            COMPRAR
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>-->
                            <!-- End Single Category -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Category Area -->

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