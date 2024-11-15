<?php

require_once("../../includes/db.php");
require_once("../../login/validar.php");
require_once("../../menu.php");

$stmt = $conx->prepare("SELECT C.id, C.nombre, U.usuario FROM categorias C INNER JOIN administradores U ON(U.id = C.id_usuario)");
$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$nuestroResultado = [];

while ($fila = $resultadoSTMT->fetch_object()) {
	$nuestroResultado[] = $fila;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/programacion/abml/panel/css/menu.css">
	<title>Listado de Categorías</title>
</head>
<body>
	<main class="contenido">
		<div class="table-container">
			<h1>Listado de Categorias</h1>

			<div class="new">
				<a href="formulario.php">Nueva Categoria</a>
			</div>

			<table class="tabla" border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Usuario</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($nuestroResultado as $fila) { ?>
						<tr>
							<td><?php echo $fila->id; ?></td>
							<td><?php echo $fila->nombre; ?></td>
							<td><?php echo $fila->usuario; ?></td>
							<td>
								<div class="new">
									<a href="formulario.php?id=<?php echo $fila->id ?>"><img class="btn-image" src="../../uploads/icons8-editar-50.png"></a>
								</div>
								<div class="new">
									<a href="../../controllers/categorias.php?operacion=DELETE&id=<?php echo $fila->id ?>"><img class="btn-image" src="../../uploads/icons8-eliminar-50.png"></a>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>
</body>
</html>