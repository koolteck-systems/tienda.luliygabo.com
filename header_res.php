
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" href="css/menuMovil.css"> 
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="menumenu__container-m">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5"> 
                                    <div class="logo">
                                         <a href="index.php"><img src="images/logo/LuliyGabo-logo.png" alt="Luli y Gabo - Tienda en línea - GNP"></a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-lg-10 col-sm-10 col-xs-3" style="padding-right: 0px;">
                                    <div>
                                        <nav class="main__menu__nav hidden-xs hidden-sm">
                                            <ul class="main__menu">

                                                <li>
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/nuestra-mision">
                                                            <img id="Mision" src="images/icons/star-off.png">
                                                            <h1>Nuestra Misión</h1>
                                                        </a>
                                                </li>
                                                <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/star-on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/star-off.png'); }
                                                    }, '#Mision');
                                               </script>
                                               <!--End Scrip-->
                                                <li>
                                                    <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/capitulos-y-juegos">
                                                        <img id="CapJuegos" src="images/icons/cap_head_off.png">
                                                        <h1>Capítulos y Juegos</h1>
                                                    </a>
                                                </li>
                                                 <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/cap_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/cap_head_off.png'); }
                                                    }, '#CapJuegos');
                                               </script>
                                               <!--End Scrip-->
                                                <li>
                                                        <a href="index.php">
                                                            <img src="images/icons/store_head_on.png">
                                                            <h1>Tienda</h1>
                                                        </a>
                                                 </li>

                                                <li>
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/descarga-la-app">
                                                            <img id="descarga" src="images/icons/app_head_off.png">
                                                            <h1>Descarga la App</h1>
                                                        </a>
                                                </li>
                                                <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/app_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/app_head_off.png'); }
                                                    }, '#descarga');
                                               </script>
                                               <!--End Scrip-->
                                                <li>
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/descargables" target="_blank">
                                                            <img id="aprende" src="images/icons/tips_head_off.png">
                                                            <h1>Aprende más</h1>
                                                        </a>
                                                </li>
                                                <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/tips_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/tips_head_off.png'); }
                                                    }, '#aprende');
                                               </script>
                                               <!--End Scrip-->
                                                <li>
                                                        <a href="http://pruebasgtec.com.mx/en/web/luli-y-gabo/contacto" target="_blank">
                                                            <img id="contac"src="images/icons/contact_head_off.png">
                                                            <h1>Contacto</h1>
                                                        </a>
                                                </li>
                                                <!--Script hover header -->
                                                <script>
                                                    $(document).on({        
                                                        mouseenter: function() { $(this).attr('src', 'images/icons/contact_head_on.png'); },
                                                        mouseleave: function() { $(this).attr('src', 'images/icons/contact_head_off.png'); }
                                                    }, '#contac');
                                               </script>
                                               <!--End Scrip-->
                                                <div class="dropdown">
                                                        <span class="dropdown_adul">
                                                            <img src="images/icons/adulto_usuario.png">
                                                            <p>ADULTO</p>
                                                        </span>
                                                        <div class="dropdown-content">
                                                            <a href="http://pruebasgtec.com.mx/en/web/ninos" target="_blank">
                                                                <img src="images/icons/nino_usuario.png">
                                                                <p>NIÑOS</p>
                                                            </a>
                                                        </div>
                                                </div>
                                            </ul>
                                        </nav>
                                        <div class="mobile-menu clearfix visible-xs visible-sm">
                                             <?php include 'menuMovil.php' ?>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                    <div class="mobile-menu-area">
                    </div>
                </div>

                <!--Menu Solicitado-->
                <div class="row">
                    <div class="sidenav">
                        <div class="Migajas">Tienda</div>
                        <div class="Naranjanav">
                            <div class="dropdown">
                                <div class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									 <?php
										if ($_SESSION['id']!= "" || $_SESSION['id']!=0 || $_SESSION['id']!=NULL) {
									?>
                                    <div class="marker">
                                        
                                        <img src="images/icons/Perfil.png" title="Usuario">
                                        ¡Hola! <?=$_SESSION['nombre'];?>
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
                                    <div>
                                        
                                        <a href="login.php">
                                        <img src="images/icons/Perfil.png" title="Usuario">
                                        Login 
                                       </a>
                                    </div>
									<?php
										}
									?>
                                    <div class="Btn1 dropdown-item" type="button">
                                        <a href="cart.php">
                                            <img src="images/icons/Carrito.png" title="Carrito">
                                            Tu Carrito
                                        </a>
                                    </div>
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
