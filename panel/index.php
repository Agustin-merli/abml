<?php

require_once("login/validar.php");

@session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/programacion/abml/panel/css/menu.css">
	<title>Panel de Control</title>
</head>
<body>

	<div class="container">
		<nav>
			<h3>Menú</h3>
			<ul>
			    <li><a href="/programacion/abml/panel/views/noticias/listado.php">Noticias</a></li>
			    <li><a href="/programacion/abml/panel/views/categorias/listado.php">Categorias</a></li>
			    <li><a href="/programacion/abml/panel/views/usuarios/listado.php">Usuarios</a></li>
			    <li><a href="/programacion/abml/panel/views/administradores/listado.php">Administradores</a></li>			    
			    <li><a href="/programacion/abml/panel/login/cerrarSesion.php">Cerrar Sesion</a></li>
			 	<li><a href="/programacion/abml/index.php">Ver Web</a></li>
			</ul>
		</nav>
	</div>

	<main class="contenido">
		<?php if (isset($_SESSION['usuario'])) { ?>
			<div class="bienvenido">
				<h1>Bienvenido al Panel de Control, <?php echo htmlspecialchars($_SESSION['usuario']) ?>!</h1>
			</div>
		<?php } ?>
	</main>

</body>
</html>