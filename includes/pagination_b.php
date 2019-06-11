<?php
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(0);
		
		include '../config/db.php';
		
		$where = " WHERE (nombre LIKE '%".$_GET['buscar']."%' OR descripcion LIKE '%".$_GET['buscar']."%') ";	
		$order = $_GET['order'];
		
		//echo "ORDEN: "; var_dump($_POST);
		
		$select_vacio="";
		$select_precio="";		
		$select_nombre="";		
		
		switch($order){
			case "nombre":
				$orderby = " ORDER BY nombre ";
				$select_nombre="selected";
			break;
			case "precio":
				$orderby = " ORDER BY precio ";
				$select_precio="selected";
			break;
			default:
				$orderby = "";
				$select_vacio="selected";
			break;
		}
		
		$sql = "SELECT * FROM productos ".$where." AND activo = 1 ".$orderby;
		$result = $conn->query($sql);
		$num_total_registros = $result->num_rows;
		
		$conn->close();


		include '../config/db.php';
		
		//Si hay registros
		if ($num_total_registros > 0) {
			//numero de registros por página
			$rowsPerPage = 6;

			//por defecto mostramos la página 1
			$pageNum = 1;

			// si $_GET['page'] esta definido, usamos este número de página
			if(isset($_GET['page'])) {
				sleep(1);
				$pageNum = $_GET['page'];
			}
				
			//echo 'page'.$_GET['page'];

			//contando el desplazamiento
			$offset = ($pageNum - 1) * $rowsPerPage;
			$total_paginas = ceil($num_total_registros / $rowsPerPage);			
			
			$i=0;
			$sql = "SELECT * FROM productos ".$where." AND activo = 1 ".$orderby." LIMIT $offset, $rowsPerPage";
			//echo "SQL: "; var_dump($sql);
			$resultado = $conn->query($sql);
			
			if ($resultado->num_rows > 0) {
			
				while($row_productos = $resultado->fetch_assoc()) {
					$id = $row_productos['id'];	
					/*$descripcion_desformateada = strip_tags($row_productos['descripcion']);
					$arrayTexto = split(' ',$descripcion_desformateada);
					$texto = '';
					$contador = 0;
					// Reconstruimos la cadena
					while(800 >= strlen($texto) + strlen($arrayTexto[$contador])){
						$texto .= ' '.$arrayTexto[$contador];
						$contador++;
					}
					$p_desc = $texto.'...<br>';*/
					$nombre = $row_productos['nombre'];
					$precio = $row_productos['precio'];
						
					if (!is_array(@getimagesize($row_productos["imagen"]))) {
						$imagen = "images/logo-kool.jpg"; // Photo unavailable
					} else {
						$imagen = $row_productos["imagen"];
					}
					//echo "<br>IMAGEN: "; var_dump($imagen);	
					$i++;
					echo '<!-- Product # '.$i.' -->
							<div class="cell-md-4 cell-sm-6">
							  <div class="product reveal-inline-block">
								<div class="product-media"><a href="producto_detalle.php?id_producto='.$id.'"><img alt="" src="'.$imagen.'" width="290" height="389" class="img-responsive"></a>
								  <div class="product-overlay"><a href="producto_detalle.php?id_producto='.$id.'" class="icon icon-circle icon-base fl-line-icon-set-shopping63"></a></div>
								</div>
								<div class="offset-top-10">
								  <p class="big"><a href="producto_detalle.php?id_producto='.$id.'" class="text-base">'.$nombre.'</a></p>
								</div>
								<div class="product-price text-bold">'.number_format($precio,0,'.',',').' puntos</div>
							  </div>
							</div>
						';
				}
				echo '<!-- Pagination -->
				';
			
				if ($total_paginas > 1) {
					//mostramos sólo 5 antes y 5 después
					$page_before = $pageNum - 5;
					if ($page_before<=0) $page_before = 1;
					$page_after =  $pageNum + 5;
					if ($page_after>=$total_paginas) $page_after = $total_paginas;
					//echo "NUMERO DE PAGINA: ". $pageNum;
				
					/*for ($i=$page_before; $i<=$page_after; $i++;) {*/
					echo '<div class="text-center offset-top-30" style="width:100%; float: left;">
							<ul class="pagination">';			
							for ($i=$page_before; $i<=$page_after; $i++) {
								if ($pageNum == $i) {
									//si muestro el índice de la página actual, no coloco enlace
									echo '<li class="active"><a class="paginate">'.$i.'</a></li>';
								} else {
									//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
									echo '<li><a style="cursor: pointer" class="paginate" data="'.$i.'" data-order="'.$order.'">'.$i.'</a></li>';
								}
						}
				   
							if ($pageNum != 1) 
						echo '<li class="prev"><a style="cursor: pointer" class="paginate mdi mdi-chevron-right" data="'.($pageNum-1).'" data-order="'.$order.'"></a></li>';
							
							if ($pageNum != $total_paginas) 
						echo '<li class="next"><a style="cursor: pointer" class="paginate mdi mdi-chevron-right" data="'.($pageNum+1).'" data-order="'.$order.'"></a></li>';
					
					echo '</ul>
					
						</div>';
				}
			}
		} else {
			?>
			<br><br>
			<div class="cell-md-12" style="text-align:center; padding: 30px;">Su búsqueda: <b style="color: red; font-weight: bold;">"<?=$buscar?>"</b> no generó resultados</div>
			<br><br>
			<?php
		}
		$conn->close();
?>