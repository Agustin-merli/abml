<?php

require_once("../../includes/db.php");
require_once("../../login/validar.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$stmt = $conx->prepare("SELECT N.*, A.usuario, C.nombre as categoria FROM noticias N 
    INNER JOIN administradores A ON (N.id_usuario = A.id) 
    INNER JOIN categorias C ON (N.id_categoria = C.id) 
    WHERE N.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$noticia = $resultado->fetch_object();

$stmt->close();

if ($noticia === NULL) {
	$id = 0;
	$titulo = "";
	$descripcion = "";
	$texto = "";
	$fecha = date("Y:m:d H:i:s");
	$imagen = "";
	$id_usuario = 0;
	$id_categoria = 0;
} else {	
	$id = $noticia->id;
	$titulo = $noticia->titulo;
	$descripcion = $noticia->descripcion;
	$texto = $noticia->texto;
	$fecha = $noticia->fecha;
	$imagen = $noticia->imagen;
	$id_usuario = $noticia->id_usuario;
	$id_categoria = $noticia->id_categoria;
}

// Obtengo el valor del usuario
$stmt = $conx->prepare("SELECT * FROM administradores");
$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$resultado = [];

while ($fila = $resultadoSTMT->fetch_object()) {
	$resultado[] = $fila;
}

$stmt->close();

// Obtengo el valor de la categoria
$stmt = $conx->prepare("SELECT * FROM categorias");
$stmt->execute();

$resultadoCategorias = $stmt->get_result();

$resultadoCategoria = [];

while ($fila = $resultadoCategorias->fetch_object()) {
	$resultadoCategoria[] = $fila;
}

$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/formulario.css">	
	<title>Formulario de Noticias</title>
</head>
<body>

<div class="form-container">

	<?php if (isset($_GET['id'])) { ?>
		<h2>Editar Noticia</h2>
	<?php } else { ?>
		<h2>Nueva Noticia</h2>
	<?php } ?>

	<form class="miForm" method="POST" enctype="multipart/form-data" action="../../controllers/noticias.php?operacion=<?php echo (isset($_GET['id']) ? "EDIT" : "NEW") ?>">

		<input type="hidden" name="id" value="<?php echo $id ?>">

		<label>Titulo:</label><br>
		<input class="titulo" type="text" name="titulo" value="<?php echo $titulo ?>" required>
			
		<br><label>Descripcion:</label><br>
		<input class="descripcion" type="text" name="descripcion" value="<?php echo $descripcion ?>" required>

		<br><label>Texto:</label><br>
		<textarea class="texto" name="texto" rows="5" required><?php echo $texto ?></textarea>

		<br><label>Fecha:</label><br>
		<input class="fecha" type="datetime-local" name="fecha" value="<?php echo $fecha ?>" required>

		<?php if (isset($_GET['id'])) { ?>
			<br><label>Imagen Actual:</label><br>
		    <img src="../../<?php echo $imagen ?>" style="max-width: 200px; max-height: 200px;">

			<br><label>Cambiar Imagen (si lo desea):</label><br>
			<input type="file" name="imagen" accept=".jpg, .jpeg, .png">

			<input type="hidden" name="imagen_actual" value="<?php echo $imagen ?>">
		<?php } else { ?>
			<br><label>Imagen:</label><br>
			<input type="file" name="imagen" accept=".jpg">
		<?php } ?>	

		<br><label>Usuario: </label><br>
		<select name="id_usuario" class="id_usuario">
			<option value="" disabled <?php echo ($id_usuario == 0) ? 'selected' : '' ?>>Selecciona un usuario</option>

			<?php foreach ($resultado as $fila) { ?>
				<option value="<?php echo $fila->id ?>" <?php echo ($fila->id == $id_usuario) ? 'selected' : '' ?>>
					<?php echo $fila->usuario ?>
				</option>			
			<?php } ?>
		</select>

		<br><label>Categoria: </label><br>
		<select name="id_categoria" class="id_categoria">
			<option value="" disabled <?php echo ($id_usuario == 0) ? 'selected' : '' ?>>Selecciona una categoria</option>
		
			<?php foreach ($resultadoCategoria as $fila) { ?>
				<option value="<?php echo $fila->id ?>" <?php echo ($fila->id == $id_categoria) ? 'selected' : '' ?>>
					<?php echo $fila->nombre ?>
				</option>
			<?php } ?>
		</select>

		<input type="submit" value="<?php echo (isset($_GET['id']) ? "Actualizar" : "Cargar") ?>">
	</form>
</div>

<script type="text/javascript">
	document.querySelector(".miForm").addEventListener("submit", function() {
		var titulo = document.querySelector(".titulo").value.trim();
		var descripcion = document.querySelector(".descripcion").value.trim();
		var texto = document.querySelector(".texto").value.trim();
		var fecha = document.querySelector(".fecha").value.trim();
		var usuario = document.querySelector(".id_usuario").value.trim();
		var categoria = document.querySelector(".id_categoria").value.trim();

		if (titulo == "") {
			alert("Ingrese el titulo");
			event.preventDefault();
			return;
		}

		if (descripcion == "") {
			alert("Ingrese la descripcion");
			event.preventDefault();
			return;
		}

		if (texto == "") {
			alert("Ingrese el texto");
			event.preventDefault();
			return;
		}

		if (fecha == "") {
			alert("Ingrese la fecha");
			event.preventDefault();
			return;
		}

		if (usuario == "") {
			alert("Ingrese el Usuario");
			event.preventDefault();
			return;
		}

		if (categoria == "") {
			alert("Ingrese la categoria");
			event.preventDefault();
			return;
		}
	});
</script>

</body>
</html>