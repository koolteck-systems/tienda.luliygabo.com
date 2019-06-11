
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" href="css/menuMovil.css"> 
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div >
                    <div>
                        <div class="menumenu__container clearfix">
                           
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 logo"> 
                                    <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/">
                                        <img src="images/logo/LuliyGabo-logo.png" alt="Luli y Gabo - Tienda en línea - GNP">
                                    </a>
                                </div>
                                <div class="col-md-10 col-lg-10 col-sm-10 col-xs-3" style="padding-right: 0px;">
                                    
                                        <nav class="main__menu__nav hidden-xs hidden-sm">
                                            <div class="main__menu">

                                                <div class="main__menu-mision" >
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/nuestra-mision">
                                                            <img id="Mision" src="images/icons/star-off.png">
                                                            <p class="mision-text">Nuestra Misión</p>
                                                        </a>
                                                </div>
                                                <!--Script hover header-->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/star-on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/star-off.png'); }
                                                    }, '#Mision');
                                               </script>
                                               <!--End Scrip-->
                                                <div class="main__menu-mision">
                                                    <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/capitulos-y-juegos">
                                                        <img id="CapJuegos" src="images/icons/cap_head_off.png">
                                                        <p class="mision-text">Capítulos y Juegos</p>
                                                    </a>
                                                </div>
                                                 <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/cap_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/cap_head_off.png'); }
                                                    }, '#CapJuegos');
                                               </script>
                                               <!--End Scrip-->
                                                <div class="main__menu-mision">
                                                        <a href="index.php">
                                                            <img src="images/icons/store_head_on.png">
                                                            <p class="mision-text">Tienda</p>
                                                        </a>
                                                 </div>

                                                <div class="main__menu-mision">
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/descarga-la-app">
                                                            <img id="descarga" src="images/icons/app_head_off.png">
                                                            <p class="mision-text">Descarga la App</p>
                                                        </a>
                                                </div>
                                                <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/app_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/app_head_off.png'); }
                                                    }, '#descarga');
                                               </script>
                                               <!--End Scrip-->
                                                <div  class="main__menu-mision">
                                                    <span>
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/descargables" target="_blank">
                                                            <img id="aprende" src="images/icons/tips_head_off.png">
                                                            <p class="mision-text">Aprende más</p>
                                                        </a>
                                                    </span>
                                                </div>
                                                <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/tips_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/tips_head_off.png'); }
                                                    }, '#aprende');
                                               </script>
                                               <!--End Scrip-->
                                                <div class="main__menu-mision">
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/contacto" target="_blank">
                                                            <img id="contac"src="images/icons/contact_head_off.png">
                                                            <p class="mision-text">Contacto</p>
                                                        </a>
                                                </div>
                                                <!--Script hover header -->
                                                 <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/contact_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/contact_head_off.png'); }
                                                    }, '#contac');
                                               </script>
                                               <!--End Scrip-->
                                                <div class="dropdown Menu-img">
                                                        <span class="dropdown_adul">
                                                            <img class="menu-adultos" src="images/icons/adulto_usuario.png">
                                                            <p class="pdropdown">ADULTO</p>
                                                        </span>
                                                        <div class="dropdown-content">
                                                            <a href="http://pruebasgtec.com.mx/en/web/ninos" target="_blank">
                                                                <img class="menu-adultos" src="images/icons/nino_usuario.png">
                                                                <p class="pdropdown">NIÑOS</p>
                                                            </a>
                                                        </div>
                                                </div>
                                            </div>
                                        </nav>
                                        <div class="mobile-menu clearfix visible-xs visible-sm">
                                             <?php include 'menuMovil.php' ?>
                                        </div>
                                    
                                </div>
                           
                        </div>
                    </div>
                    <div class="mobile-menu-area">
                    </div>
                </div>

                <!--Menu Solicitado-->
                <div>
                    <div class="sidenav">
                        
                        <div class="Migajas">
                            <a class="Migajas" href="index.php">
                                <span>
                                    Tienda
                                </span>
                            </a>
                        </div>
                        <div class="Naranjanav">
                            <div class="dropdown">
                                <div class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									 <?php
										if ($_SESSION['id']!= "" || $_SESSION['id']!=0 || $_SESSION['id']!=NULL) {
									?>
                                    <div class="marker">
										<?
										$nombre = $_SESSION['nombre'];
										//echo "Nombre1: "; var_dump($nombre);
										$nombres = preg_split('/\s/', $nombre);
										//echo "<br>Nombre2: <pre>"; var_dump($nombres); echo "</pre>";
										$primer_nombre = $nombres[0];
										?>                                        
                                        <img src="images/icons/Perfil.png" title="Usuario">
                                        ¡Hola! <?=$primer_nombre;?>
                                    </div>
									<?php
										} else {
									?>
                                    <div class="marker">
                                        
                                        <img src="images/icons/Perfil.png" title="Usuario">
                                        ¡Hola! 
                                    </div>
									<?php
										}
									?>
                                </div>

                                <div class="SubMenu dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenu2">
									 <?php
										if ($_SESSION['id']!= "" || $_SESSION['id']!=0 || $_SESSION['id']!=NULL) {
									?>
                                    <div class="Btn1 dropdown-item" type="button">
                                        <a href="pedidos.php">
                                            <img src="images/icons/Pedidos.png" title="Pedidos">
                                            Tus Pedidos
                                        </a>
                                    </div>
                                    <div class="Btn1 dropdown-item" type="button">
                                        <a href="perfil.php">
                                            <img src="images/icons/Perfil.png" title="Usuario">
                                            Tu Perfil
                                       </a>
                                    </div>
									<?php
										} else {
									?>
                                    <div class="marker" type="button">
                                        <a href="login.php">
                                        <img src="images/icons/Perfil.png" title="Usuario">
                                        Login 
                                       </a>
                                    </div>
									<?php
										}
										
									/*if( isset($_SESSION["productos"]) && (count($_SESSION["productos"])>0) ){ //if we have session variable	
										$productos_carrito = 0;
										foreach($_SESSION["productos"] as $producto){ //loop though items and prepare html content	
											$cantidad = $producto["cantidad"];
											$productos_carrito = $productos_carrito + $cantidad;
										}
									} else {
										$productos_carrito = 0;
									}*/
									?>
                                    <!--<div class="Btn1 dropdown-item" type="button">
                                        <a href="cart.php">
                                            <img src="images/icons/Carrito.png" title="Carrito">
                                            Tu Carrito
                                        </a><span class="pill" id = "carrito"><?=$productos_carrito?></span>
                                    </div>-->
									<?php
										if ($_SESSION['id']!= "" || $_SESSION['id']!=0 || $_SESSION['id']!=NULL) {
									?>
									<form name="logout" id="logout" action="" method="post">
                                    <a onclick="document.logout.submit()">
                                    <div class="Btn1 dropdown-item" type="button">
                                        <img src="images/icons/Salir.png" title="Cerrar Sesión">
                                        <input type="hidden" name="cerrar_session" value="si">
                                        Salir
                                    </div>
									</a>
									</form>
									<?php
									} 
									?>
                                </div>
                            </div>
                            <?php
                                        
                                    if( isset($_SESSION["productos"]) && (count($_SESSION["productos"])>0) ){ //if we have session variable 
                                        $productos_carrito = 0;
                                        foreach($_SESSION["productos"] as $producto){ //loop though items and prepare html content  
                                            $cantidad = $producto["cantidad"];
                                            $productos_carrito = $productos_carrito + $cantidad;
                                        }
                                    } else {
                                        $productos_carrito = 0;
                                    }
                                    ?>
                                    <div class="marker-car" type="button" title="Tu Carrito">
                                        <a href="cart.php">
                                            <img src="images/icons/Carrito.png" title="Carrito">
                                        </a>
                                        <div class="circulo">
                                            <span class="pill" id = "carrito"><?=$productos_carrito?></span>
                                        </div>
                                    </div>
                        <div>
                    </div>
                </div>        
                 <!--Menu naranja 1 -->

                <!--<div class="row">
                    <div class="sidenav">
                        <div class="Migajas">Tienda</div>
                        <div class="Naranjanav">
                             <?php
                                if ($_SESSION['id']!= "" || $_SESSION['id']!=0 || $_SESSION['id']!=NULL) {
                            ?>
                            <div class="marker">Hola

                                <div>
                                    <b>
                                      <?=$_SESSION['nombre'];?>
                                    </b>
                                </div>
                            </div>
                                <div class="marker">
                                ¡Hola!
                            </div>  
                            <div>
                                <a href="login.php">
                                    <img src="images/icons/user-login.png" title="Usuario">
                                </a>
                            </div>
                            <form name="logout" id="logout" action="" method="post">
                                <div class="header-wrapicon2">
                                    <a onclick="document.logout.submit()">
                                        <img src="images/icons/logout.png" title="Cerrar Sesión">
                                        <input type="hidden" name="cerrar_session" value="si">
                                    </a>
                                </div>
                            </form>
                            <?php
                                } else {
                            ?>              
                            <?php
                                }
                            ?>

                            <div>
                                <a href="cart.php">
                                    <img src="images/icons/shop.png" title="Carrito">
                                </a>       
                            </div>
                        </div>
                    </div>
                </div>-->        
        </div>
            <!-- End Mainmenu Area -->
            
            <!--<div id="user" class="sidenav">
                <div>
                    <img src="images/icons/user-login.png">¡Hola!
                </div>
                <div class="fas fa-shopping-cart"></div>
                <div class="fas fa-search">buscar</div>
            </div>-->
        </header>
        <!-- End Header Area -->
