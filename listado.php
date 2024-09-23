<?php

require_once("db.php");
require_once("validar.php");

$stmt = $conx->prepare("SELECT * FROM clientes WHERE eliminado = 0");

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
	<title></title>
</head>
<body>

	<a href="formulario.php">Nuevo Usuario</a>

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
						<a href="formulario.php?id=<?php echo $fila->id ?>">Editar</a>
						<form action="eliminar.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $fila->id ?>">
							<input type="submit" value="Eliminar">
						</form>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>