<?php

require_once("../includes/db.php");
require_once("../login/validar.php");

$operacion = $_GET['operacion'];

if ($operacion == "NEW") {

	$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
	$texto = isset($_POST['texto']) ? $_POST['texto'] : "";
	$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : date("Y:m:d H:i:s");
	$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : "";
	$id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : 0;
	$id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;

	if ($_FILES['imagen']['name']) {
		$carpetaASubir = "../uploads/";
		$nombreImagen = basename($_FILES['imagen']['name']);
		$rutaFinal = $carpetaASubir . $nombreImagen;

		if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFinal)) {
			$imagen = "uploads/" . $nombreImagen;
		} else {
			echo "Error al subir la imagen.";
		}
	}

	$stmt = $conx->prepare("INSERT INTO noticias (titulo, descripcion, texto, fecha, imagen, id_usuario, id_categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssssii", $titulo, $descripcion, $texto, $fecha, $imagen, $id_usuario, $id_categoria);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "EDIT") {
	
	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	$idForm = isset($_POST['id']) ? $_POST['id'] : 0;
	$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
	$texto = isset($_POST['texto']) ? $_POST['texto'] : "";
	$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : date("Y:m:d H:i:s");
	$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : "";
	$id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : 0;
	$id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;
	$imagen_actual = isset($_POST['imagen_actual']) ? $_POST['imagen_actual'] : "";

	if (!empty($_FILES['imagen']['name'])) {
		$carpetaASubir = "../uploads/";
		$nombreImagen = basename($_FILES['imagen']['name']);
		$rutaFinal = $carpetaASubir . $nombreImagen;

		if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFinal)) {
			$imagen = "uploads/" . $nombreImagen;
		} else {
			echo "Error al subir la imagen.";
		}
	} else {
		$imagen = $imagen_actual;
	}

	$stmt = $conx->prepare("UPDATE noticias SET titulo = ?, descripcion = ?, texto = ?, fecha = ?, imagen = ?, id_usuario = ?, id_categoria = ? WHERE id = ?");
	$stmt->bind_param("sssssiii", $titulo, $descripcion, $texto, $fecha, $imagen, $id_usuario, $id_categoria, $idForm);
	$stmt->execute();
	$stmt->close();

} else if ($operacion == "DELETE") {

	$id = isset($_GET['id']) ? $_GET['id'] : 0;

	$stmt = $conx->prepare("DELETE FROM noticias WHERE id = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->close();
}

header("Location: ../views/noticias/listado.php");
exit();

?>