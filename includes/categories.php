<?php
$select_tecnologia = "";
$select_hogar = "";
$select_moda = "";
$select_salud = "";
$select_bebes = "";
$select_deportes = "";
$select_varios = "";
switch($cat) {
	case "tecnologia":
		$select_tecnologia = 'class="active"';
	break;
	case "hogar":
		$select_hogar = 'class="active"';
	break;
	case "moda":
		$select_moda = 'class="active"';
	break;
	case "salud":
		$select_salud = 'class="active"';
	break;
	case "bebes":
		$select_bebes = 'class="active"';
	break;
	case "deportes":
		$select_deportes = 'class="active"';
	break;
	case "varios":
		$select_varios = 'class="active"';
	break;
}

?>
<ul class="columns menu">
	<li <?=$select_tecnologia?>><a href="tecnologia.php">Tecnología</a></li>
	<li <?=$select_hogar?>><a href="hogar.php">Hogar</a></li>
	<li <?=$select_moda?>><a href="moda.php">Moda y Belleza</a></li>
	<li <?=$select_salud?>><a href="salud.php">Salud y Cuidado Personal</a></li>
	<li <?=$select_bebes?>><a href="bebes.php">Bebés y Juguetes</a></li>
	<li <?=$select_deportes?>><a href="deportes.php">Deportes</a></li>
	<li <?=$select_varios?>><a href="varios.php">Varios</a></li>
</ul>
