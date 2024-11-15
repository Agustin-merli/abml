<?php

require_once("../includes/db.php");
require_once("../login/validar.php");

$operacion = $_GET['operacion'];

if ($operacion == "NEW") {

	$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
	$password = isset($_POST['password']) ? $_POST['password'] : "";

	$stmt = $conx->prepare("INSERT INTO administradores (usuario, password) VALUES (?, ?)");
	$stmt->bind_param("ss", $usuario, $password);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "EDIT") {

	$idForm = isset($_POST['id']) ? $_POST['id'] : 0;
	$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
	$password = isset($_POST['password']) ? $_POST['password'] : "";

	$stmt = $conx->prepare("UPDATE administradores SET usuario = ?, password = ? WHERE id = ?");
	$stmt->bind_param("ssi", $usuario, $password, $idForm);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "DELETE") {

	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	$stmt = $conx->prepare("DELETE FROM administradores WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->close();
}

header("Location: ../views/administradores/listado.php");
exit();

?>