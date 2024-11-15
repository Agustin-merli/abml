<?php

require_once("../includes/db.php");
require_once("../login/validar.php");

$operacion = $_GET['operacion'];

if ($operacion == "NEW") {

	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$password = isset($_POST['password']) ? $_POST['password'] : "";
	$rango = isset($_POST['rango']) ? $_POST['rango'] : "";

	$stmt = $conx->prepare("INSERT INTO usuarios (nombre, email, password, rango) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("ssss", $nombre, $email, $password, $rango);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "EDIT") {

	$idForm = isset($_POST['id']) ? $_POST['id'] : 0;
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$password = isset($_POST['password']) ? $_POST['password'] : "";
	$rango = isset($_POST['rango']) ? $_POST['rango'] : "";

	$stmt = $conx->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ?, rango = ? WHERE id = ?");
	$stmt->bind_param("ssssi", $nombre, $email, $password, $rango, $idForm);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "DELETE") {

	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	$stmt = $conx->prepare("DELETE FROM usuarios WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->close();
}

header("Location: ../views/usuarios/listado.php");
exit();

?>