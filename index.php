<?php

require_once("panel/includes/db.php");

$categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : "";

if ($categoria_id) {
	$stmt = $conx->prepare("SELECT N.*, C.nombre as categoria FROM noticias N INNER JOIN categorias C ON(C.id = N.id_categoria) WHERE N.id_categoria = ? ORDER BY N.fecha DESC");
    $stmt->bind_param("i", $categoria_id);
} else {
	$stmt = $conx->prepare("SELECT N.*, C.nombre as categoria FROM noticias N INNER JOIN categorias C ON(C.id = N.id_categoria) order by fecha desc");
}

$stmt->execute();
$resultadoSTMT = $stmt->get_result();

$nuestroResultado = [];

while ($fila = $resultadoSTMT->fetch_object()) {
	$nuestroResultado[] = $fila;
}

$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="panel/css/web.css">
	<title>Mundo Informativo</title>
</head>
<body>

<?php require_once("menuFrontend.php"); ?>

<div class="container">
	<?php if (empty($nuestroResultado)) { ?>
        <p>No hay noticias disponibles para esta categoría.</p>
    <?php } else { ?>
		<?php foreach ($nuestroResultado as $fila) { ?>
			<section>
				<h2><a href="detalle.php?id=<?php echo $fila->id ?>"><?php echo $fila->titulo ?></a></h2>
				<a href="detalle.php?id=<?php echo $fila->id ?>"><img src="panel/<?php echo $fila->imagen ?>" width="300"></a>
				<p><span><?php echo $fila->categoria ?></span> | Publicado el <?php echo $fila->fecha ?></p>
			</section>
		<?php } ?>
	<?php } ?>
</div>

</body>
</html>