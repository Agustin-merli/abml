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
    
    <div class="titulo">Mundo Informativo🌍</div>
    <div id="nav-links" class="nav-links">
    	<div class="close-btn" onclick="toggleMenu()">✖</div>
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
	function toggleMenu() {
    	var links = document.getElementById('nav-links');
    	links.classList.toggle('active');
	}
</script>

</body>
</html>