<?php 

require_once("../../includes/db.php");
require_once("../../login/validar.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$stmt = $conx->prepare("SELECT * FROM administradores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$admin = $resultado->fetch_object();

$stmt->close();

if ($admin === NULL) {
	$id = 0;
	$usuario = "";
	$password = "";
} else {
	$id = $admin->id;
	$usuario = $admin->usuario;
	$password = $admin->password;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/formulario.css">
	<title>Formulario de Administradores</title>
</head>
<body>

<div class="form-container">

	<?php if (isset($_GET['id'])) { ?>
		<h2>Editar Administrador</h2>
	<?php } else { ?>
		<h2>Nuevo Administrador</h2>
	<?php } ?>

	<form class="miForm" method="POST" action="../../controllers/administradores.php?operacion=<?php echo (isset($_GET['id']) ? "EDIT" : "NEW") ?>">

		<input type="hidden" name="form_enviado" value="1">

		<input type="hidden" name="id" value="<?php echo $id ?>">

		<label>Usuario:</label><br>
		<input class="usuario" type="text" name="usuario" value="<?php echo $usuario ?>">

		<br><label>Contraseña:</label><br>
		<input class="password" type="password" name="password" value="<?php echo $password ?>">
			
		<input type="submit" value="<?php echo (isset($_GET['id']) ? "Actualizar" : "Cargar") ?>">
	</form>
</div>

<script>
	document.querySelector(".miForm").addEventListener("submit", function(event) {
		var usuario = document.querySelector(".usuario").value.trim();
		var password = document.querySelector(".password").value.trim();

		if (usuario == "") {
			alert("Ingrese su usuario");
			event.preventDefault();
			return;
		}

		if (password == "") {
			alert("Ingrese su contraseña");
			event.preventDefault();
			return;
		}
	});
</script>

</body>
</html>