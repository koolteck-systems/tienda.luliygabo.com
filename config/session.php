<?php
session_start();
//echo "SESSION: <pre>"; var_dump($_SESSION); echo "</pre>";
include 'db.php';

$sql = "SELECT * FROM usuarios WHERE id='" . $_GET['id'] . "'";
#echo "SQL "; var_dump($sql);
//echo "SECCION "; var_dump($_GET['seccion']);
$seccion = $_GET['seccion'];

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$_SESSION['id'] = $row['id'];
	$_SESSION['nombre'] = $row['nombre'];
	$_SESSION['apellidos'] = $row['apellidos'];
	$_SESSION['correo'] = $row['correo'];
	$_SESSION['password'] = $row['password'];
	if ($seccion!=NULL || $seccion !='') echo '<script>window.location = "https://tienda.luliygabo.com/user-payment.php"</script>';
	else echo '<script>window.location = "https://tienda.luliygabo.com/"</script>';
  }
}

$conn->close();
?>