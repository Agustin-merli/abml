<?php

require_once("../includes/db.php");
@session_start();

$user = isset($_POST['user']) ? $_POST['user'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$mensajeError = "";

if (!empty($user) && !empty($password)) {
	$stmt = $conx->prepare("SELECT * FROM administradores WHERE usuario = ? AND password = ?");
	$stmt->bind_param("ss", $user, $password);
	$stmt->execute();
	$resultado = $stmt->get_result();
	$stmt->close();

	$usuario = $resultado->fetch_object();

	if ($usuario === NULL) {
		$mensajeError = "Usuario o Contraseña incorrecta";
	} else {
		$_SESSION['id'] = $usuario->id;
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
			<input type="text" name="user" placeholder="Ingrese su usuario" required>
			<input type="password" name="password" placeholder="Ingrese su contraseña" required>

			<input type="submit" value="Iniciar Sesion">
		</form>
	</div>
</body>
</html>

