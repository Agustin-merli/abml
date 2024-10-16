<?php

require_once("../../includes/db.php");
require_once("../../login/validar.php");
require_once("../../menu.php");

$stmt = $conx->prepare("SELECT * FROM clientes");

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
	<title>Listado de Clientes</title>
</head>
<body>
	<main class="contenido">
		<div class="table-container">
			<h1>Listado de Clientes</h1>

			<a href="formulario.php">Nuevo Cliente</a>

			<table border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Email</th>
						<th>Descripcion</th>
						<th>Edad</th>
						<th>Opciones</th>
					</tr>			
				</thead>
				<tbody>
					<?php foreach ($nuestroResultado as $fila) { ?>
						<tr>
							<td><?php echo $fila->id ?></td>
							<td><?php echo $fila->nombre ?></td>
							<td><?php echo $fila->email ?></td>
							<td><?php echo $fila->descripcion ?></td>
							<td><?php echo $fila->edad ?></td>
							<td>
								<a href="formulario.php?id=<?php echo $fila->id ?>">Editar</a><br>
								<a href="../../controllers/clientes.php?operacion=DELETE&id=<?php echo $fila->id ?>">Eliminar</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>
</body>
</html>