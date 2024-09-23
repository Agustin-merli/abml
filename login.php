<?php

require_once("db.php");
@session_start();

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (!empty($usuario) && !empty($password)) {
	$stmt = $conx->prepare("SELECT * FROM administradores WHERE usuario = ? AND password = ?");
	$stmt->bind_param("ss", $usuario, $password);
	$stmt->execute();
	$resultado = $stmt->get_result();
	$stmt->close();

	$usuario = $resultado->fetch_object();

	if ($usuario === NULL) {
		echo "Usuario o Contraseña incorrecta";
	} else {
		$_SESSION['id'] = $usuario->id;
		header("Location: listado.php");
		die();
	}
} 

?>

<form method="POST">
	<input type="text" name="usuario" placeholder="Ingrese su usuario" required>
	<input type="password" name="password" placeholder="Ingrese su contraseña" required>

	<input type="submit">
</form>
