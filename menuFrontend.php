<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

<nav>
    <div class="hamburger" onclick="toggleMenu()">
        <img src="panel/uploads/icons8-menu-50.png" alt="Menu"> 
    </div>

    <div class="search-icon" onclick="toggleMenu(true)">
        <img src="panel/uploads/icons8-búsqueda-50.png" alt="Buscar">
    </div>
    
    <div class="titulo">Mundo Informativo🌍</div>

    <?php @session_start(); ?>

    <?php if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])): ?>
        <div class="usuario-logueado">
            <span><img class="foto-perfil" src="panel/uploads/icons8-test-account-48.png"> <?php echo $_SESSION['usuario']['nombre']; ?></span>
            <a href="auth/cerrarSesion.php">Cerrar sesión</a>
        </div>
    <?php else: ?>
        <div class="registro-login">
            <a href="auth/registro.php">Registrarse</a>
            <a href="auth/iniciarSesion.php">Iniciar sesión</a>
        </div>
    <?php endif; ?>

    <div id="nav-links" class="nav-links">
    	<div class="close-btn" onclick="toggleMenu()">✖</div>

        <form action="index.php" method="GET" class="search-form">
            <input id="buscador" class="buscador" type="text" name="buscar" placeholder="Buscar noticias" value="<?php echo str_replace('%', '', $buscar) ?>">
            <button type="submit" aria-label="buscar">
                <img src="panel/uploads/icons8-búsqueda-50.png" alt="buscar">
            </button>
        </form>

        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?categoria=4">Accidentes</a></li>
            <li><a href="index.php?categoria=1">Deportes</a></li>
            <li><a href="index.php?categoria=3">Economía</a></li>
            <li><a href="index.php?categoria=2">Política</a></li>
        </ul>
    </div>
</nav>

<script>
	function toggleMenu(focusSearch = false) {
    	var links = document.getElementById('nav-links');
    	links.classList.toggle('active');
        
        if (focusSearch && links.classList.contains('active')) {
            document.getElementById('buscador').focus();
        }
	}
</script>

</body>
</html>