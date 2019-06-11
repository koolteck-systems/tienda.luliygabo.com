<?php
session_start(); //start session
require('../config/db.php');//include config file

//echo "CART: "; var_dump($_GET["qtyminus"]);

/*echo "SESSION <pre>"; var_dump($_SESSION); echo "</pre>";
echo "ID PRODUCTO: "; var_dump($_GET["id_producto"]);*/
############# add products to session #########################
//echo "ID PRODUCTO: "; var_dump($_GET["id_producto"]);
if(isset($_GET["id_producto"])) {
    foreach($_GET as $key => $value){
        $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
    }
	//echo "NEW PRODUCTO: <pre>"; var_dump($new_product); echo "</pre>";
    
    //we need to get product name and price from database.
    $statement = $conn->prepare("SELECT nombre, precio FROM productos WHERE id=? LIMIT 1");
    $statement->bind_param('s', $new_product['id_producto']);
    $statement->execute();
    $statement->bind_result($nombre, $precio);
    
	//echo "statement: <pre>"; var_dump($statement->fetch()); echo "</pre>";
	//echo "SESSION: <pre>"; var_dump($_SESSION); echo "</pre>";

    while($statement->fetch()){ 
        $new_product["nombre"] = $nombre; //fetch product name from database
        $new_product["precio"] = $precio;  //fetch product price from database
        $new_product["cantidad"] = 1;  //fetch product cantidad from database
		//echo "NEW PRODUCTO: <pre>"; var_dump($new_product); echo "</pre>";
        
        if(isset($_SESSION["productos"])){  //if session var already exist
            if(isset($_SESSION["productos"][$new_product['id_producto']])) //check item exist in products array
            {
				//echo "<br>SESSION: <pre>"; var_dump($_SESSION["productos"][$new_product['id_producto']]); echo "</pre>";
                $_SESSION["productos"][$new_product['id_producto']]['cantidad']=($_SESSION["productos"][$new_product['id_producto']]['cantidad']) + 1; //add item
				//echo "<br>SESSION: <pre>"; var_dump($_SESSION["productos"][$new_product['id_producto']]); echo "</pre>";
            } else {
				$_SESSION["productos"][$new_product['id_producto']] = $new_product; //update products with new item array  
			}
		} else $_SESSION["productos"][$new_product['id_producto']] = $new_product; //update products with new item array
    }
	
	//echo "<br>SESSION: <pre>"; var_dump($_SESSION); echo "</pre>";
	    
    $total_items = count($_SESSION["productos"]); //count total items
    die(json_encode(array('items'=>$total_items))); //output json 
}

################# remove item from shopping cart ################
if(isset($_GET["remove_code"]) && isset($_SESSION["productos"]))
{
    $id_producto   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

    if(isset($_SESSION["productos"][$id_producto])) {
        unset($_SESSION["productos"][$id_producto]);
    }
    
    $total_items = count($_SESSION["productos"]);
    die(json_encode(array('items'=>$total_items)));	

    if( isset($_SESSION["productos"]) && (count($_SESSION["productos"])>0) ){ //if we have session variable
        $cart_box = '<ul class="cart-products-loaded">';
        $total = 0;
        foreach($_SESSION["productos"] as $producto){ //loop though items and prepare html content
            
            //set variables to use them in HTML content below
            $id = $producto["id_producto"];
            $nombre = $producto["nombre"]; 
            $precio = $producto["precio"];
			$cantidad = $producto["cantidad"];
            
            $cart_box .=  "<li>";
			$cart_box .=  "<a href='carrito-compras.php'>".$nombre."</a>";
			$cart_box .=  "<span>".$cantidad. " x ".number_format($precio,2,'.',',')." puntos <a class=\"remove-item\" data-code=\"$id\">&times;</a></span>";
			$cart_box .=  "<div class=\"clearfix\"></div>";
			$cart_box .=  "</li>";
			$total_producto = $precio * $cantidad;
            $total = ($total + $total_producto);
        }
        $cart_box .= '<li>Total : '.number_format($total,2,'.',',').' puntos </li>';
        $cart_box .= "</ul>";
        die($cart_box); //exit and output content
    }else{
        die("<ul><li>Tu carrito está vacío</li></ul>"); //we have empty cart
    }
	
}

//echo "<br>ID CART: "; var_dump($_GET["load_cart"]);
################## list products in cart ###################
if(isset($_GET["load_cart"]) && $_GET["load_cart"]==1) {

    if( isset($_SESSION["productos"]) && (count($_SESSION["productos"])>0) ){ //if we have session variable
        $cart_box = '<ul class="cart-products-loaded">';
        $total = 0;
        foreach($_SESSION["productos"] as $producto){ //loop though items and prepare html content
            
            //set variables to use them in HTML content below
            $id = $producto["id_producto"];
            $nombre = $producto["nombre"]; 
            $precio = $producto["precio"];
			$cantidad = $producto["cantidad"];
            
            $cart_box .=  "<li>";
			$cart_box .=  "<a href='carrito-compras.php'>".$nombre."</a>";
			$cart_box .=  "<span>".$cantidad. " x ".number_format($precio,2,'.',',')." puntos <a class=\"remove-item\" data-code=\"$id\">&times;</a></span>";
			$cart_box .=  "<div class=\"clearfix\"></div>";
			$cart_box .=  "</li>";
			$total_producto = $precio * $cantidad;
            $total = ($total + $total_producto);
        }
        $cart_box .= '<li>Total : '.number_format($total,2,'.',',').' puntos </li>';
        $cart_box .= "</ul>";
        die($cart_box); //exit and output content
    }else{
        die("<ul><li>Tu carrito está vacío</li></ul>"); //we have empty cart
    }
}

################## More and Minus Products in Cart ###################
if( isset($_GET["qtyplus"]) ) {
	
	//echo "<br>SESSION: <pre>"; var_dump($_SESSION["productos"]); echo "</pre>"; 
	if( isset($_SESSION["productos"]) ){ //if we have session variable
		$_SESSION["productos"][$_GET['qtyplus']]['cantidad']=($_SESSION["productos"][$_GET['qtyplus']]['cantidad']) + 1; //agregar item
		//echo "<br>SESSION: <pre>"; var_dump($_SESSION["productos"][$_GET['qtyplus']]['cantidad']); echo "</pre>"; 
	}
}

if( isset($_GET["qtyminus"]) ) {
	
	//echo "<br>SESSION: <pre>"; var_dump($_SESSION["productos"]); echo "</pre>"; 
	if( isset($_SESSION["productos"]) ){ //if we have session variable
		$_SESSION["productos"][$_GET['qtyminus']]['cantidad']=($_SESSION["productos"][$_GET['qtyminus']]['cantidad']) - 1; //quitar item
		if ( ($_SESSION["productos"][$_GET['qtyminus']]['cantidad']) < 0 ) $_SESSION["productos"][$_GET['qtyminus']]['cantidad']=0;
		//echo "<br>SESSION: <pre>"; var_dump($_SESSION["productos"][$_GET['qtyminus']]['cantidad']); echo "</pre>"; 
	}
}
################# remove item from favoritos ################
if(isset($_GET["remove_id"]))
{
    $id_producto   = filter_var($_GET["remove_id"], FILTER_SANITIZE_STRING); //get the product code to remove

	$sql = " DELETE FROM favoritos WHERE id_producto = '$id_producto' ";
	//echo "SQL: "; var_dump($sql);
	$result = $conn->query($sql);
    
	$cart_box .= '	<div class="row catalog-header">
						<h2><i class="mdi mdi-heart"></i> Mis favoritos</h2>
					</div>
					<div class="row">';
	
	$sql = "SELECT p.id AS id, p.nombre AS nombre, p.imagen AS imagen, p.precio AS puntos
			FROM productos AS p, favoritos AS f
			WHERE p.id = f.id_producto
			AND f.id_empleado = '".$_SESSION['id']."'
			ORDER BY orden ASC ";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		$id_p = $row['id'];
		$nombre = $row['nombre'];
		$imagen = $row['imagen'];
		$puntos = $row['puntos'];
		
		$cart_box .=  '<div class="columns prize">
								<div class="tmb">
									<a style="cursor: pointer" class="remove-fav" title="Remover favorito" data-code="'.$id_p.'" data-nombre="'.$nombre.'"><i class="mdi mdi-heart-off"></i></a>
									<a href="producto.php?id_producto='.$id_p.'"><img src="'.$imagen.'" alt="'.$nombre.'"></a>
								</div>
								<p class="progress">Te falta <span>78%</span> para poder canjear este premio</p>
								<progress value="78" max="100"></progress>
								<p class="prize-name"><a href="producto.php?id_producto='.$id_p.'">'.$nombre.'</a></p>
								<p class="prize-price">'.$puntos.' <span>pts.</span></p>
							</div>';
		$cart_box .=  '</div>';
	}
	die($cart_box); //exit and output content	
}
?>