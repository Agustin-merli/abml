<?php

require_once("login/validar.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/programacion/abml/panel/css/menu.css">
	<title>Panel</title>
</head>
<body>

	<div class="container">
		<nav>
			<h3>Menú</h3>
			<ul>
			    <li><a href="/programacion/abml/panel/views/noticias/listado.php">Noticias</a></li>
			    <li><a href="/programacion/abml/panel/views/categorias/listado.php">Categorias</a></li>
			    <li><a href="/programacion/abml/panel/views/clientes/listado.php">Clientes</a></li>
			    <li><a href="/programacion/abml/panel/login/cerrarSesion.php">Cerrar Sesion</a></li>
			 	<li><a href="/programacion/abml/index.php">Ver Web</a></li>
			</ul>
		</nav>
	</div>

	<main>
		<h1></h1>
	</main>

</body>
</html>