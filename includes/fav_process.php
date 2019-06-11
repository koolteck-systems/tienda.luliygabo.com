<?php
session_start(); //start session
require('../config/db.php');//include config file

/*echo "SESSION <pre>"; var_dump($_SESSION); echo "</pre>";
echo "ID PRODUCTO: "; var_dump($_GET["id_producto"]);*/
############# add products to session #########################
//echo "ID PRODUCTO: "; var_dump($_GET["id_producto"]);
if(isset($_GET["id_producto"])) {
    foreach($_GET as $key => $value){
        $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
    }
	$id_p = $new_product['id_producto'];
	$id_e = $_SESSION['id'];
	### VERIFICA SI YA EXISTE ###	
	$sql_e = "SELECT * FROM favoritos WHERE id_empleado = '$id_e' AND id_producto = '$id_p' ";
	//echo "SQL: "; var_dump($sql_e);
	$result_e = $conn->query($sql_e);	
	$num_total_registros = $result_e->num_rows;
	//echo "REGS: "; var_dump($num_total_registros);
	
	if ($num_total_registros == 0) {
		//echo "NEW PRODUCTO: <pre>"; var_dump($new_product); echo "</pre>";
		$orden = 1;
		$sql = " INSERT INTO favoritos (id, id_empleado, id_producto, orden ) VALUES ('', '$id_e', '$id_p', '$orden') ";
		//echo "SQL: "; var_dump($sql);
		if ($conn->query($sql) === TRUE) {
			$msg=" Se ha agregado un Favorito.";
		}
	}	
	//echo "SESSION: <pre>"; var_dump($_SESSION); echo "</pre>";        
}

?>