<?php

require_once("../../includes/db.php");
require_once("../../login/validar.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$stmt = $conx->prepare("SELECT C.*, A.usuario FROM categorias C INNER JOIN administradores A ON(A.id = C.id_usuario) WHERE C.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$categoria = $resultado->fetch_object();

$stmt->close();

if ($categoria === NULL) {	
	$id = 0; 
	$nombre = "";
	$id_usuario = 0;
} else {
	$id = $categoria->id;
	$nombre = $categoria->nombre;
	$id_usuario = $categoria->id_usuario;
}

// obtengo el valor del usuario
$stmt = $conx->prepare("SELECT * FROM administradores");
$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$resultado = [];

while ($fila = $resultadoSTMT->fetch_object()) {
	$resultado[] = $fila;
}

$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/formulario.css">
	<title>Formulario de Categorías</title>
</head>
<body>

<div class="form-container">

	<?php if (isset($_GET['id'])) { ?>
		<h2>Editar Categoría</h2>
	<?php } else { ?>
		<h2>Nueva Categoría</h2>
	<?php } ?>

	<form class="miForm" method="POST" action="../../controllers/categorias.php?operacion=<?php echo (isset($_GET['id']) ? "EDIT" : "NEW") ?>">

		<input type="hidden" name="formEnviado" value="1">

		<input type="hidden" name="id" value="<?php echo $id ?>">

		<label>Nombre: </label><br>
		<input class="nombre" type="text" name="nombre" value="<?php echo $nombre ?>">

		<br><label>Usuario: </label><br>
		<select name="id_usuario" class="id_usuario">
			<option value="" disabled <?php echo ($id_usuario == 0) ? 'selected' : '' ?>>Selecciona un usuario</option>

			<?php foreach ($resultado as $fila) { ?>
				<option value="<?php echo $fila->id ?>" <?php echo ($fila->id == $id_usuario) ? 'selected' : '' ?>>
					<?php echo $fila->usuario ?>
				</option>			
			<?php } ?>
		</select>

		<input type="submit" value="<?php echo (isset($_GET['id']) ? "Actualizar" : "Cargar") ?>">
	</form>
</div>

<script>
	document.querySelector(".miForm").addEventListener("submit", function(event) {
		var nombre = document.querySelector(".nombre").value.trim();
		var usuario = document.querySelector(".id_usuario").value.trim();

		if (nombre == "") {
			alert("Ingrese el nombre de la categoria");
			event.preventDefault();
			return;
		}

		if (usuario == "") {
			alert("Ingrese el Usuario");
			event.preventDefault();
			return;
		}
	});
</script>

</body>
</html>