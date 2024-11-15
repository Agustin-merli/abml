<?php 

require_once("../panel/includes/db.php");
@session_start();

$mensajeRegistro = "";

if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['password'])) {

	$nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

	$stmt = $conx->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $nombre, $email, $password);
	
	if ($stmt->execute()) {
	    $_SESSION['usuario'] = ['id' => $stmt->insert_id, 'nombre' => $nombre];
	    header("Location: ../index.php");
	} else {
	   	$mensajeRegistro = "Error al registrarse";
	}

	$stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../panel/css/auth.css">
	<title>Registrar</title>
</head>
<body>

<div id="contenido">
	<h2>Registrar</h2>

	<p class="error"><?php echo $mensajeRegistro ?></p>
	
	<form method="POST">
		<label>Nombre completo:</label><br>
		<input type="text" name="nombre">

		<br><label>Correo electrónico:</label><br>
		<input type="email" name="email">

		<br><label>Contraseña:</label><br>
		<div class="password-container">
			<input id="password" type="password" name="password">
			<i id="mostrarPassword" class="fas fa-eye eye-icon"></i>
		</div>

		<input type="submit" value="Registrarse">
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