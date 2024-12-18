<?php

require_once("../../includes/db.php");
require_once("../../login/validar.php");
require_once("../../menu.php");

$stmt = $conx->prepare("SELECT * FROM administradores");
$stmt->execute();

$resultadoSTMT = $stmt->get_result();
$resultado = [];

$stmt->close();

while ($fila = $resultadoSTMT->fetch_object()) {
	$resultado[] = $fila;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="/programacion/abml/panel/css/menu.css">
	<title>Listado de Administradores</title>
</head>
<body>

	<main class="contenido">
		<div class="table-container">
			<h1>Listado de Administradores</h1>
			
			<div class="new">
				<a href="formulario.php">Nuevo Administrador</a>
			</div>

			<table border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>Usuario</th>
						<th>Password</th>
						<th>Opciones</th>
					</tr>			
				</thead>
				<tbody>
					<?php foreach ($resultado as $fila) { ?>
						<tr>
							<td><?php echo $fila->id ?></td>
							<td><?php echo $fila->usuario ?></td>
							<td>
								<div class="password-container">
									<input type="password" id="password_<?php echo $fila->id ?>" value="<?php echo htmlspecialchars($fila->password) ?>" readonly>
									<i onclick="togglePassword('password_<?php echo $fila->id ?>')" class="fas fa-eye eye-icon"></i>
								</div>
							</td>
							<td>
								<div class="new">
									<a href="formulario.php?id=<?php echo $fila->id ?>"><img class="btn-image" src="../../uploads/icons8-editar-50.png"></a><br>
								</div>
								<div class="new">
									<a href="../../controllers/administradores.php?operacion=DELETE&id=<?php echo $fila->id ?>"><img class="btn-image" src="../../uploads/icons8-eliminar-50.png"></a>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>

	<script>
		function togglePassword(id) {
			var passwordField = document.getElementById(id);
			var eyeIcon = passwordField.nextElementSibling;

			if (passwordField.type === 'password') {
				passwordField.type = 'text';
				eyeIcon.classList.remove('fa-eye');
				eyeIcon.classList.add('fa-eye-slash');
			} else {
				passwordField.type = 'password';
				eyeIcon.classList.remove('fa-eye-slash');
				eyeIcon.classList.add('fa-eye');
			}
		}
	</script>

</body>
</html>