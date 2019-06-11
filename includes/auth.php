<?php
include '../config/db.php';

// Evitamos inyección sql
$correo = htmlentities(addslashes($_POST['email']));
$password = htmlentities(addslashes($_POST['password']));
$seccion = $_POST['seccion'];

//$sql = "SELECT * FROM empleados WHERE num_empleado ='".$_POST['num_empleado']."' AND password ='".$_POST['password']."' ";
$sql = "SELECT * FROM usuarios WHERE correo ='".$correo."' ";
//echo "SQL: "; var_dump($sql);
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$id = $row['id'];
		//echo "<br>POST: "; var_dump($password);
		//echo "<br>ROW: "; var_dump($row['password']);
		//echo "<br>ID: "; var_dump($row['id']);
		/*echo "<br>seccion: "; var_dump($_POST['seccion']);*/
		if (password_verify($password, $row['password'])) {
        	echo '<script>window.location = "https://tienda.luliygabo.com/config/session.php?id='.$id.'&seccion='.$seccion.'"</script>';
		} else {
            echo '<script>alert("El password es incorrecto. Intentelo de nuevo.")</script>';
            echo '<script>window.location = "https://tienda.luliygabo.com/login.php?seccion='.$seccion.'";</script>';
		}
    }
} 
echo '<script>alert("El Correo que introdujo no existe o el password es incorrecto. Intentelo de nuevo.")</script>';
echo '<script>window.location = "https://tienda.luliygabo.com/login.php?seccion='.$seccion.'";</script>';

$conn->close();
 ?>