<?php

require_once("../../includes/db.php");
require_once("../../login/validar.php");
require_once("../../menu.php");

$stmt = $conx->prepare("SELECT *FROM noticias");
$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$nuestroResultado = [];

while ($fila = $resultadoSTMT->fetch_object()) {
	$nuestroResultado[] = $fila;
}

$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/programacion/abml/panel/css/menu.css">
	<title>Listado de Noticias</title>
</head>
<body>
	<main class="contenido">
		<div class="table-container">
			<h1>Listado de Noticias</h1>

			<a href="formulario.php">Nueva Noticia</a>

			<table border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>Titulo</th>
						<th>Descripcion</th>
						<th>Texto</th>
						<th>Fecha</th>
						<th>Imagen</th>
						<th>id_usuario</th>
						<th>id_categoria</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($nuestroResultado as $fila) { ?>
						<tr>
							<td><?php echo $fila->id ?></td>
							<td><?php echo $fila->titulo ?></td>
							<td><?php echo $fila->descripcion ?></td>
							<td><?php echo $fila->texto ?></td>
							<td><?php echo $fila->fecha ?></td>
							<td><img src="../../<?php echo $fila->imagen ?>" width="125"></td>
							<td><?php echo $fila->id_usuario ?></td>
							<td><?php echo $fila->id_categoria ?></td>
							<td>
								<a href="formulario.php?id=<?php echo $fila->id ?>">Editar</a><br> 
								<a href="../../controllers/noticias.php?operacion=DELETE&id=<?php echo $fila->id ?>">Eliminar</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>
</body>
</html>