<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	error_reporting(0);

	extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
	//echo "REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";
	
	function Mayus($variable) {
		$variable = strtr(strtoupper($variable),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
		return $variable;
	}
	
	include('../config/db.php');
	
	//echo "CAT: "; var_dump($categoria);
		
	switch ($cat) {
		case 'bocinasaudifonos':
			$where = " WHERE activo = 1 AND (categoria= 'BOCINAS Y AUDIFONOS') ";
			$cat = "bocinasaudifonos";				
		break;
		case 'computacion':
			$where = " WHERE activo = 1 AND (categoria= 'COMPUTACION') ";
			$cat = "computacion";				
		break;
		case 'deportes':
			$where = " WHERE activo = 1 AND (categoria= 'DEPORTES') ";
			$cat = "Deportes";
		break;
		case 'gadgets':
			$where = " WHERE activo = 1 AND (categoria= 'GADGETS') ";
			$cat = "gadgets";				
		break;
		case 'mochilasymaletas':
			$where = " WHERE activo = 1 AND (categoria= 'MOCHILAS Y MALETAS') ";
			$cat = "mochilasymaletas";				
		break;
		case 'moda':
			$where = " WHERE activo = 1 AND (categoria= 'MODA') ";
			$cat = "Moda y Belleza";				
		break;
		case 'pantallas':
			$where = " WHERE activo = 1 AND (categoria= 'PANTALLAS') ";
			$cat = "pantallas";				
		break;
		case 'perfumeria':
			$where = " WHERE activo = 1 AND (categoria= 'PERFUMERIA') ";
			$cat = "perfumeria";				
		break;
		case 'tecnologia':
			$where = " WHERE activo = 1 AND (categoria= 'TECNOLOGIA') ";
			$cat = "Tecnología";				
		break;
		case 'telefonia':
			$where = " WHERE activo = 1 AND (categoria= 'TELEFONIA') ";
			$cat = "telefonia";				
		break;
		case 'sistsonido':
			$where = " WHERE activo = 1 AND (categoria= 'SISTEMAS DE SONIDO') ";
			$cat = "sistsonido";				
		break;
		case 'varios':
			$where = " WHERE activo = 1 AND (categoria= 'VARIOS') ";
			$cat = "Varios";
		break;
		case 'buscador':
			$where = " WHERE activo = 1 AND (nombre LIKE '%".$buscar."%' OR descripcion LIKE '%".$buscar."%') ";
			$cat = "buscador";
		break;
		case 'filtro':
			$where = " WHERE activo = 1 AND ( precio BETWEEN '".$rango_i."' AND '".$rango_f."') ORDER BY precio ASC ";
			$cat = "Filtro";
		break;
		default:
			$where = " 1 = 1 ";
		break;
	}
					
	$select_vacio="";	
	$select_nombre="";	
	$select_precio_asc="";	
	$select_precio_desc="";		
	
	switch($order){
		case "precio_asc":
			$orderby = " ORDER BY precio ASC";
			$select_precio_asc="selected";
		break;
		case "precio_desc":
			$orderby = " ORDER BY precio DESC ";
			$select_precio_desc="selected";
		break;
		default:
			$orderby = "";
			$select_vacio="selected";
		break;
	}
	
	$sql = "SELECT * FROM productos ".$where." ".$orderby." ";
	//echo "SQL: "; var_dump($sql);
	$result = $conn->query($sql);
	//echo "result: "; var_dump($result);
	
	$num_total_registros = $result->num_rows;
	//echo "REGISTROS: "; var_dump($num_total_registros);
	
	$conn->close();

	//numero de registros por página
	$rowsPerPage = 9;	

	// si $page esta definido, usamos este número de página
	if(isset($page)) {
		sleep(1);
		$pageNum = $page;
	}
	
	$total_paginas = ceil($num_total_registros / $rowsPerPage);	
	//echo "PAGINAS: "; var_dump($total_paginas);
		
	?>
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">						
							<!-- Ordering -->
							<form action="tecnologia.php" method="post" name="form" id="form">
								<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
									<select class="selection-2" name="order" onchange="this.form.submit()" style="border: none; height: 50px; background-color: #fff;">
										<option value="" <?php echo $select_vacio;?>>Ordenar por...</option>
										<option value="precio_asc" <?php echo $select_precio_asc;?>>Precio (Menor a Mayor)</option>
										<option value="precio_desc" <?php echo $select_precio_desc;?>>Precio (Mayor a Menor)</option>
									</select>
								</div>
							</form>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							Mostrando <?=$pageNum?> de <?=$total_paginas?> páginas
						</span>
					</div>

					<!-- Product -->
					<div class="row">
	
					<?php
					include('../config/db.php');

					//Si hay registros
					if ($num_total_registros > 0) {
							
						//echo 'page'.$_GET['page'];

						//contando el desplazamiento
						$offset = ($pageNum - 1) * $rowsPerPage;
						$total_paginas = ceil($num_total_registros / $rowsPerPage);			
						
						$i=0;
						$sql = "SELECT * FROM productos ".$where." ".$orderby." LIMIT $offset, $rowsPerPage";
						//$sql = "SELECT * FROM productos WHERE activo = 1 LIMIT 9 ";
						//echo "<br>SQL: "; var_dump($sql);
						$resultado = $conn->query($sql);
							
						while($row_productos = $resultado->fetch_assoc()) {
							//echo "<pre>: "; var_dump($row_productos);echo "</pre>: ";
							$id = $row_productos['id'];
							$nombre = $row_productos['nombre'];
							$sku = $row_productos['sku'];
							$precio = $row_productos['precio'];
								
							if (!is_array(@getimagesize($row_productos["imagen"]))) {
								$imagen = "images/logo-kool.jpg"; // Photo unavailable
							} else {
								$imagen = $row_productos["imagen"];
							}
							$i++;
							echo '<!-- Product # '.$i.' -->
									<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
										<!-- Block2 -->
										<div class="block2">
											<div class="block2-img wrap-pic-w of-hidden pos-relative">
												<img src="'.$imagen.'" alt="IMG-PRODUCT">

												<div class="block2-overlay trans-0-4">
													
													<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
														<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
														<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
													</a>											

													<div class="block2-btn-viewdetail w-size1 trans-0-4">
														<a href="product-detail.php?id_p='.$id.'" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														 <i style="margin-right:10px;"  class="fa fa-link"></i> Detalle
														</a>
													</div>

													<div class="block2-btn-addcart w-size1 trans-0-4" data-code="'.$id.'" data-name="'.$nombre.'">
														<!-- Button -->
														<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
															<li style="margin-right:10px;" class="fa fa-shopping-cart"></li>   Agregar
														</button>
													</div>

												</div>
											</div>

											<div class="block2-txt p-t-20">
												<a href="product-detail.php?id_p='.$id.'" class="block2-name dis-block s-text3 p-b-5">
													'.$nombre.'
												</a>

												<small style="color: #0079bc;">SKU: '.$sku.'</small><br>
												

												<span class="block2-price m-text6 p-r-5">
													'.number_format($precio,2,".",",").' puntos
												</span>
											</div>
										</div>
									</div>';
						}
					?>	
					</div>
					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
					<?php
					
						if ($total_paginas > 1) {
						//mostramos sólo 5 antes y 5 después
						$page_before = $pageNum - 5;
						if ($page_before<=0) $page_before = 1;
						$page_after =  $pageNum + 5;
						if ($page_after>=$total_paginas) $page_after = $total_paginas;
						//echo "NUMERO DE PAGINA: ". $pageNum;								
							for ($i=$page_before; $i<=$page_after; $i++) {
								if ($pageNum == $i) {
									//si muestro el índice de la página actual, no coloco enlace
									echo '<a class="paginate item-pagination flex-c-m trans-0-4 active-pagination">'.$i.'</a>';
								} else {
									//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
									echo '<a style="cursor: pointer" class="paginate item-pagination flex-c-m trans-0-4" data="'.$i.'"  data-order="'.$order.'" data-buscar="'.$buscar.'" data-rango_i="'.$rango_i.'" data-rango_f="'.$rango_f.'">'.$i.'</a>';
								}
							}
					   
								/*if ($pageNum != 1) 
							echo '<a style="cursor: pointer" class="paginate prev" data="'.($pageNum-1).'" data-order="'.$order.'"></a>';
								
								if ($pageNum != $total_paginas) 
							echo '<a style="cursor: pointer" class="paginate next" data="'.($pageNum+1).'" data-order="'.$order.'"></a>';*/
						}
						
					}
					$conn->close();
					?>	
					</div>