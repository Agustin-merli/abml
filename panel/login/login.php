<?php

require_once("../includes/db.php");
@session_start();

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$rango = "admin";
$mensajeError = "";

if (!empty($nombre) && !empty($password)) {
	$stmt = $conx->prepare("SELECT * FROM usuarios WHERE (nombre = ? AND password = ?) AND rango = ?");
	$stmt->bind_param("sss", $nombre, $password, $rango);
	$stmt->execute();
	$resultado = $stmt->get_result();
	$stmt->close();

	$admin = $resultado->fetch_object();

	if ($admin === NULL) {
		$mensajeError = "Usuario o Contraseña incorrecta";
	} else {
		$_SESSION['id'] = $admin->id;
		$_SESSION['usuario'] = $admin->usuario;
		header("Location: ../index.php");
		exit();
	}
} 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<title>Login</title>
</head>
<body>

	<div class="container">
		<h2>Iniciar Sesión</h2>

		<?php if (!empty($mensajeError)) { ?>
            <div class="error">
                <?php echo $mensajeError; ?>
            </div>
        <?php } ?>

		<form method="POST">
			<label>Nombre: </label>
			<input class="nombre" type="text" name="nombre" required>
			
			<label>Contraseña: </label>
			<div class="password-container">
				<input type="password" id="password" name="password" required>
				<i id="mostrarPassword" class="fas fa-eye eye-icon"></i>
			</div>

			<input class="form-btn" type="submit" value="Iniciar Sesion">
		</form>
	</div>

	<script>
		var mostrarPassword = document.querySelector('#mostrarPassword');
		var password = document.querySelector('#password');

		mostrarPassword.addEventListener('click', function() {
			if (password.type === 'password') {
				password.type = 'text';
				mostrarPassword.classList.remove('fa-eye');
				mostrarPassword.classList.add('fa-eye-slash');
			} else {
				password.type = 'password';
				mostrarPassword.classList.remove('fa-eye-slash');
				mostrarPassword.classList.add('fa-eye');
			}
		});
	</script>

</body>
</html>