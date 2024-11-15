<?php 

require_once("../../includes/db.php");
require_once("../../login/validar.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$stmt = $conx->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$user = $resultado->fetch_object();

$stmt->close();

if ($user === NULL) {
	$id = 0;
	$nombre = "";
	$email = "";
	$password = "";
	$rango = "";
} else {
	$id = $user->id;
	$nombre = $user->nombre;
	$email = $user->email;
	$password = $user->password;
	$rango = $user->rango;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/formulario.css">
	<title>Formulario de Usuarios</title>
</head>
<body>

<div class="form-container">

	<?php if (isset($_GET['id'])) { ?>
		<h2>Editar Usuario</h2>
	<?php } else { ?>
		<h2>Nuevo Usuario</h2>
	<?php } ?>

	<form class="miForm" method="POST" action="../../controllers/usuarios.php?operacion=<?php echo (isset($_GET['id']) ? "EDIT" : "NEW") ?>">

		<input type="hidden" name="form_enviado" value="1">

		<input type="hidden" name="id" value="<?php echo $id ?>">

		<label>Nombre:</label>
		<input class="nombre" type="text" name="nombre" value="<?php echo $nombre ?>">

		<label>Email:</label><br>
		<input class="email" type="email" name="email" value="<?php echo $email ?>">

		<br><label>Contraseña:</label><br>
		<input class="password" type="password" name="password" value="<?php echo $password ?>">

		<br><label>Rango:</label><br>
		<select name="rango" class="rango">
			<option value="0">Seleccione un rango</option>
			<option value="admin">admin</option>
			<option value="usuario">usuario</option>
		</select>
			
		<input type="submit" value="<?php echo (isset($_GET['id']) ? "Actualizar" : "Cargar") ?>">
	</form>
</div>

<script>
	document.querySelector(".miForm").addEventListener("submit", function(event) {
		var email = document.querySelector(".email").value.trim();
		var password = document.querySelector(".password").value.trim();
		var rango = document.querySelector(".rango").value.trim();

		if (email == "") {
			alert("Ingrese su email");
			event.preventDefault();
			return;
		}

		if (password == "") {
			alert("Ingrese su contraseña");
			event.preventDefault();
			return;
		}

		if (rango == 0) {
			alert("Ingrese el rango");
			event.preventDefault();
			return;
		}
	});
</script>

</body>
</html>