<?php

$server = "localhost";
$user = "iderobin_root";
$pass = "kool16";
$db   = "iderobin_chilis";

define('DB_SERVER', $server);
define('DB_SERVER_USERNAME', $user);
define('DB_SERVER_PASSWORD', $pass);
define('DB_DATABASE', $db);

$conexion = mysql_connect($server, $user, $pass);

mysql_select_db($db, $conexion);

?>