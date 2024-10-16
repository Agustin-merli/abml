<?php

require_once("../includes/db.php");
require_once("../login/validar.php");

$operacion = $_GET['operacion'];

if ($operacion == "NEW") {
	
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
	$id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : 0;

	$stmt = $conx->prepare("INSERT INTO categorias (nombre, id_usuario) VALUES (?, ?)");
	$stmt->bind_param("si", $nombre, $id_usuario);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "EDIT") {

	$idForm = isset($_POST['id']) ? $_POST['id'] : 0;
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
	$id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : 0;

	$stmt = $conx->prepare("UPDATE categorias SET nombre = ?, id_usuario = ? WHERE id = ?");
	$stmt->bind_param("sii", $nombre, $id_usuario, $idForm);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "DELETE") {

	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	$stmt = $conx->prepare("DELETE FROM categorias WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->close();
}

header("Location: ../views/categorias/listado.php");
exit();

?>