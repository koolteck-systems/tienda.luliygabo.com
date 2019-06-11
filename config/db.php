<?php

$server = "localhost";
$user = "koolteck_root";
$pass = "kool16";
$db   = "koolteck_luliygabo";

// Create connection
$conn = new mysqli($server, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

mysqli_set_charset( $conn, 'utf8');
?>