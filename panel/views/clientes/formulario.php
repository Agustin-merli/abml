<?php 

require_once("../../includes/db.php");
require_once("../../login/validar.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$stmt = $conx->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$usuario = $resultado->fetch_object();

$stmt->close();

if ($usuario === NULL) {

	$id = 0;
	$nombre = "";
	$email = "";
	$descripcion = "";
	$edad = 0;

} else {
	
	$id = $usuario->id;
	$nombre = $usuario->nombre;
	$email = $usuario->email;
	$descripcion = $usuario->descripcion;
	$edad = $usuario->edad;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/formulario.css">
	<title>Formulario Clientes</title>
</head>
<body>

<div class="form-container">

	<?php if (isset($_GET['id'])) { ?>
		<h2>Editar Cliente</h2>
	<?php } else { ?>
		<h2>Nuevo Cliente</h2>
	<?php } ?>

	<form class="miForm" method="POST" action="../../controllers/clientes.php?operacion=<?php echo (isset($_GET['id']) ? "EDIT" : "NEW") ?>">

		<input type="hidden" name="form_enviado" value="1">

		<input type="hidden" name="id" value="<?php echo $id ?>">

		<label>Nombre:</label><br>
		<input class="nombre" type="text" name="nombre" value="<?php echo $nombre ?>">

		<br><label>Email:</label><br>
		<input class="email" type="email" name="email" value="<?php echo $email ?>">
			
		<br><label>Descripcion:</label><br>
		<textarea class="descripcion" name="descripcion" rows="5"><?php echo $descripcion ?></textarea>

		<br><label>Edad:</label><br>
		<input class="edad" type="number" name="edad" value="<?php echo $edad ?>">

		<input type="submit" value="<?php echo (isset($_GET['id']) ? "Actualizar" : "Cargar") ?>">
	</form>
</div>

<script>
	document.querySelector(".miForm").addEventListener("submit", function(event) {
		var nombre = document.querySelector(".nombre").value.trim();
		var email = document.querySelector(".email").value.trim();
		var descripcion = document.querySelector(".descripcion").value.trim();
		var edad = document.querySelector(".edad").value.trim();

		if (nombre == "") {
			alert("Ingrese su nombre");
			event.preventDefault();
			return;
		}

		if (email == "") {
			alert("Ingrese su email");
			event.preventDefault();
			return;
		}

		if (descripcion == "") {
			alert("Ingrese su descripcion");
			event.preventDefault();
			return;
		}

		if (edad == 0) {
			alert("Ingrese su edad");
			event.preventDefault();
			return;
		}
	});
</script>

</body>
</html>