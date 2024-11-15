<?php

require_once("../panel/includes/db.php");
@session_start();

$mensajeSesion = "";

if (!empty($_POST['email']) && !empty($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$stmt = $conx->prepare("SELECT * FROM usuarios WHERE email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_object();

    if ($usuario === null) {
    	$mensajeSesion = "Email o contraseña incorrecta";
    } else {
    	$_SESSION['usuario'] = ['id' => $usuario->id, 'nombre' => $usuario->nombre];
        header("Location: ../index.php");
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
	<title>Iniciar Sesion</title>
</head>
<body>
	
<div id="contenido">
	<h2>Iniciar Sesión</h2>

	<p class="error"><?php echo $mensajeSesion ?></p>
	
	<form method="POST">
		<label>Correo electrónico:</label><br>
		<input type="email" name="email">

		<br><label>Contraseña:</label><br>
		<div class="password-container">
			<input id="password" type="password" name="password">
			<i id="mostrarPassword" class="fas fa-eye eye-icon"></i>
		</div>

		<input type="submit" value="Iniciar Sesion">
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