<?php
session_start();
//echo "SESIÓN <pre>"; var_dump($_SESSION); echo "</pre>";

extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
//echo "REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";

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
    <link rel="stylesheet" href="css/perfil.css">
    <!--Font GOOGLE-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet">

    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>

    <script type="text/javascript" src="//www.sanwebe.com/wp-content/themes/sanwebe-lite/js/jquery-1.11.2.min.js"></script>
	
	<?
	include 'config/db.php';
	if ($enviar=="Agregar"){
		$id_u = $_SESSION['id'];
		$nombre_archivo =$_FILES['imagen']['name'];
		$tipo_archivo = $_FILES['imagen']['type'];
		$tamano_archivo = $_FILES['imagen']['size'];
		$archivo= $_FILES['imagen']['tmp_name'];
		//echo "_FILES: <pre>"; var_dump($_FILES); echo "</pre>";
		//Limitar el tipo de archivo y el tamaño    
		if (!((strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")))) {
            $class = "alert alert-info";
			$msg =  "El formato de los archivos no es correcto. Se permiten archivos JPG o PNG.";
		} else {
			if ($tamano_archivo  > 2000000) {
                $class = "alert alert-info";
				$msg =  "El tamaño de los archivos no es correcto. Se permiten archivos de 2 Mb máximo.";
			} else {
				$file = $_FILES['imagen']['name'];
				$res = explode(".", $nombre_archivo);
				$extension = $res[count($res)-1];
				$nombre= "user_".$id_u.".". $extension; //renombrarlo como nosotros queramos
				$dirtemp = "images/users/".$nombre."";//Directorio temporal para subir el fichero
				//echo "DIR: "; var_dump($dirtemp);

				if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
					copy($_FILES['imagen']['tmp_name'], $dirtemp);

					unlink($archivo); //Borrar el fichero temporal
					$sql2 = "UPDATE usuarios SET imagen = '".$nombre."' WHERE id = '".$id_u."' ";
					if ($conn->query($sql2) === TRUE) {
						$class = "alert alert-info";
						$msg=" La foto se guardó correctamente.";
					} else {
						$class = "alert alert-info";
						$msg =" La foto no se guardó. Inténtelo de nuevo.";
					}
				} else {
					$msg = "Ocurrió algún error al subir el fichero. No pudo guardarse.";
				}
			}
		}
	}
	
if ($_SESSION['id']!= "" || $_SESSION['id']!=0 || $_SESSION['id']!=NULL) {
?>
<body>
    
    <div class="wrapper">
        <!-- Start Header Style -->
        <?php include 'header.php' ?>
        <!-- End Header Area -->
        <div class="container Perfil">
                <div class="row">
    				<?php
    				include 'config/db.php';
    				
    				$sql = "SELECT * FROM usuarios WHERE id='" . $_SESSION['id'] . "'";
    				#echo "SQL "; var_dump($sql);

    				$result = $conn->query($sql);

    				if ($result->num_rows > 0) {
    					while($row = $result->fetch_assoc()) {
    						$id = $row['id'];
    						$nombre = $row['nombre'];
    						$apellidos = $row['apellidos'];
    						$correo = $row['correo'];
    						$telefono = $row['telefono'];
    						$celular = $row['celular'];
    						$ciudad = $row['ciudad'];
    						$cp = $row['cp'];
    						$direccion = $row['direccion'];
    						$referencias = $row['referencias'];
    						$imagen = $row['imagen'];
    						if ($imagen!=NULL || $imagen!="") $foto = "images/users/".$imagen;
    						else $foto = "images/icons/SecPerfil.png";						
    					}
    				}
    				?>
                    <?php
                            if ($msg!=NULL) {
                            ?>
                                
                                <div class="<?=$class;?>">
                                    <center><?=$msg;?></center>
                                </div>
                            <?php
                            }
                            ?>
                    <div class="col-md-4 text-center">
                       
                            <div class="Perfil_img text-center col-md-12 col-xs-6">
                                <img class="Perfil_img-icon" src="<?=$foto?>" title="Perfil">   
                            </div>  
    					
    					<div class="row btnrow text-center">  
    					   
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="col-xs-12 ">
                                    <label class="boton-agregar fileContainer">
                                        Seleccionar imagen
                                        <input name="imagen" type="file"/>
                                    </label>
                                    
                                </div>
                                <div class="col-xs-12" >
                                    <label class="boton-agregar fileContainer">
                                        Subir
                                        <input type="submit" value="Agregar" name="enviar">
                                    </label>
                                    
                                </div>
                            </form>
        					<!--<form action="" method="POST" enctype="multipart/form-data">
        						<table>
        							<tr>
        								<td>
        									<div align="center">
                                                <div>
        										  <input name="imagen" type="file">
        										</div>
                                                <br><br>                                     
        										<input type="submit" value="Agregar" name="enviar" style="cursor: pointer">
        									</div>
        								</td>
        							</tr>
        						</table>
        					</form>-->
    					</div>
    					
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="Perfil-data-personal">DATOS PERSONALES</div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 pb--30">
                                <div>
                                    Nombre
                                </div>
                                <div>   
                                    <input class="Perfil_input" type="text" name="Nombre" placeholder="<?=$nombre?>" value="<?=$nombre?>" disabled>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 pb--30">
                                <div>
                                    Apellidos
                                </div>
                                <div>   
                                    <input class="Perfil_input" type="text" name="Apellido" placeholder="<?=$apellidos?>" value="<?=$apellidos?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 pb--30">
                                <div>
                                        Correo
                                </div>
                                <div>   
                                    <input class="Perfil_input" type="text" name="Correo" placeholder="<?=$correo?>" value="<?=$correo?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 pb--30">
                                <div>
                                    Teléfono
                                </div>
                                <div>
                                    <input class="Perfil_input" type="text" name="Telefono" placeholder="<?=$telefono?>" value="<?=$telefono?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="ol-md-6 col-xs-12 pb--30">
                                <div>
                                    Celular
                                </div>
                                <div>
                                    <input class="Perfil_input" type="text" name="Celular" placeholder="<?=$celular?>" value="<?=$celular?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="row">
                    <div class="Perfil-data-personal pb--30">
                        DIRECCIÓN
                    </div>
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
    					}			
    				?>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 pb--30">
                            <div>
                                Ciudad
                            </div>
                            <div>
                                <input class="Perfil_input" type="text" name="Ciudad" placeholder="<?=$ciudad?>" value="<?=$ciudad?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 pb--30">
                            <div>
                                Codigo Postal
                            </div>
                            <div>
                                <input class="Perfil_input" type="text" name="Codigo Postal" placeholder="<?=$cp?>" value="<?=$cp?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 pb--30">
                            <div>
                                Estado
                            </div>
                            <div>
                                <input class="Perfil_input" type="text" name="Estado" placeholder="" value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 pb--30">
                            <div>
                                Colonia
                            </div>
                            <div>
                                <input class="Perfil_input" type="text" name="Colonia" placeholder="" value="" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 pb--30">
                            <div>
                                Dirección
                            </div>
                            <div>
                                <input class="Perfil_input" type="text" name="Direccion" placeholder="<?=$calle?>" value="<?=$calle?>" disabled>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 pb--30">
                            <div>
                                Refencias
                            </div>
                            <div>
                                <input class="Perfil_input" type="text" name="Referencia" placeholder="<?=$referencias?>" value="<?=$referencias?>" disabled>
                            </div>
                        </div>
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
<?php
} else {
	?>
	<script language="javascript">
	location.href = "index.php";
	</script>
	<?php
}
?>
</html>