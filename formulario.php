<?php 

require_once("db.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$idForm = isset($_POST['id']) ? $_POST['id'] : 0;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$edad = isset($_POST['edad']) ? $_POST['edad'] : 0;

$form_enviado = isset($_POST['form_enviado']) ? $_POST['form_enviado'] : 0;

if ($form_enviado == 1) {

	$error = 0;
	$mensaje = "";

	if (empty($nombre)) {
		$error = 1;
		$mensaje = 'Ingrese su nombre';
	}

	if (empty($email)) {
		$error = 1;
		$mensaje = 'Ingrese su email';
	}

	if (empty($descripcion)) {
		$error = 1;
		$mensaje = 'Ingrese su descripcion';
	}

	if (empty($edad)) {
		$error = 1;
		$mensaje = 'Ingrese su edad';
	}

	if ($error == 0) {

		if ($idForm == 0) {

			$consulta = "INSERT INTO clientes (nombre, email, descripcion, edad) VALUES (?, ?, ?, ?)";

			$stmt = $conx->prepare($consulta);
			$stmt->bind_param("sssi", $nombre, $email, $descripcion, $edad);
			$stmt->execute();
			$stmt->close();

		} else {

			$consulta = "UPDATE clientes SET nombre = ?, email = ?, descripcion = ?, edad = ?";
			$consulta.= " WHERE id = ?";

			$stmt = $conx->prepare($consulta);
			$stmt->bind_param("sssii", $nombre, $email, $descripcion, $edad, $idForm);
			$stmt->execute();
			$stmt->close();

		} 
		header("Location: listado.php");
		die();
	} else {
		echo $mensaje;
	}
}

$stmt = $conx->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();
$usuario = $resultado->fetch_object();

$stmt->close();

if ($usuario === NULL) {
	$id = 0;
	$nombre = "";
	$email = "";
	$descripcion = "";
	$edad = 0;
} else {
	$id = $usuario->id;
	$nombre = $usuario->nombre;
	$email = $usuario->email;
	$descripcion = $usuario->descripcion;
	$edad = $usuario->edad;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<form method="POST">

		<input type="hidden" name="form_enviado" value="1">

		<input type="hidden" name="id" value="<?php echo $id ?>">

		<label>Nombre:</label><br>
		<input type="text" name="nombre" value="<?php echo $nombre ?>">

		<br><label>Email:</label><br>
		<input type="email" name="email" value="<?php echo $email ?>">
		
		<br><label>Descripcion:</label><br>
		<textarea name="descripcion" rows="5"><?php echo $descripcion ?></textarea>

		<br><label>Edad:</label><br>
		<input type="number" name="edad" value="<?php echo $edad ?>">

		<input type="submit">

	</form>

</body>
</html>