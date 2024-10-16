<?php

require_once("panel/includes/db.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$stmt = $conx->prepare("SELECT N.*, C.nombre as categoria FROM noticias N INNER JOIN categorias C ON(C.id = N.id_categoria) WHERE N.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

$noticia = $resultado->fetch_object();

$stmt->close();

if ($noticia === NULL) {
	header("Location: 404.php");
	exit();
} else {
	$titulo = $noticia->titulo;
	$descripcion = $noticia->descripcion;
	$texto = $noticia->texto;
	$fecha = $noticia->fecha;
	$imagen = $noticia->imagen;
	$id_usuario = $noticia->id_usuario;
	$id_categoria = $noticia->id_categoria;
	$categoria = $noticia->categoria;
}

$stmt = $conx->prepare("SELECT N.* FROM noticias N INNER JOIN categorias C ON(N.id_categoria = C.id) WHERE C.id = ? AND N.id != ? ORDER BY N.fecha DESC LIMIT 3");
$stmt->bind_param("ii", $noticia->id_categoria, $id);
$stmt->execute();

$resultadoSTMT = $stmt->get_result();

$noticiasRelacionadas = [];

while ($fila = $resultadoSTMT->fetch_object()) {
    $noticiasRelacionadas[] = $fila;
}

$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="panel/css/detalle.css">
	<title><?php echo $titulo ?></title>
</head>
<body>

<?php require_once("menuFrontend.php"); ?>

<div class="container">
	<h1><?php echo $titulo ?></h1>

	<h4><?php echo $descripcion ?></h4>

	<div class="meta-info">
		<span><?php echo $categoria ?></span> | Publicado el <?php echo $fecha ?> | <a href="index.php">mundoinformativo.com</a>
	</div>

	<img src="panel/<?php echo $imagen ?>" alt="<?php echo $titulo ?>">

	<p class="texto"><?php echo $texto ?></p>

	<h2>También te puede interesar...</h2>

	<div class="noticias-relacionadas">
	    <?php foreach ($noticiasRelacionadas as $fila) { ?>
	        <div class="noticia-relacionada">
	            <img src="panel/<?php echo $fila->imagen ?>" alt="<?php echo $fila->titulo ?>" width="100">

		       	<div>
		           	<h3><a href="detalle.php?id=<?php echo $fila->id ?>"><?php echo $fila->titulo ?></a></h3>
		    		<p class="meta-info"><?php echo $categoria ?> | <?php echo $fecha ?></p>
		    	</div>
		    </div>		    
		<?php } ?>
	</div>
</div>

</body>
</html>