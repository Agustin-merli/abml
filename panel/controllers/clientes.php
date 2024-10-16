<?php

require_once("../includes/db.php");
require_once("../login/validar.php");

$operacion = $_GET['operacion'];

if ($operacion == "NEW") {

	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
	$edad = isset($_POST['edad']) ? $_POST['edad'] : 0;

	$stmt = $conx->prepare("INSERT INTO clientes (nombre, email, descripcion, edad) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("sssi", $nombre, $email, $descripcion, $edad);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "EDIT") {

	$idForm = isset($_POST['id']) ? $_POST['id'] : 0;
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
	$edad = isset($_POST['edad']) ? $_POST['edad'] : 0;

	$stmt = $conx->prepare("UPDATE clientes SET nombre = ?, email = ?, descripcion = ?, edad = ? WHERE id = ?");
	$stmt->bind_param("sssii", $nombre, $email, $descripcion, $edad, $idForm);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "DELETE") {

	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	$stmt = $conx->prepare("DELETE FROM clientes WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->close();
}

header("Location: ../views/clientes/listado.php");
exit();

?>