<?php

require_once("panel/includes/db.php");

$categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : "";
$buscar = isset($_GET['buscar']) ? "%" . $_GET['buscar'] . "%" : "";

$offset = 6;
$pagina = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = ($pagina - 1) * $offset;

// Acumula las condiciones de la consulta
$condiciones = [];
$parametros = [];
$tipos_parametros = "";

// Construye la consulta de conteo de forma dinámica
$contar_sql = "SELECT COUNT(*) as cantidad FROM noticias N INNER JOIN categorias C ON(C.id = N.id_categoria)";
if ($categoria_id) {
    $condiciones[] = "N.id_categoria = ?";
    $parametros[] = $categoria_id;
    $tipos_parametros .= "i";
}

if (!empty($buscar)) {
    $condiciones[] = "N.titulo LIKE ? OR N.texto LIKE ?";
    $parametros[] = $buscar;
    $parametros[] = $buscar;
    $tipos_parametros .= "s";
    $tipos_parametros .= "s";
}

if ($condiciones) {
    $contar_sql .= " WHERE " . implode(" AND ", $condiciones);
}

$contar_stmt = $conx->prepare($contar_sql);
if (!empty($parametros)) {
    $contar_stmt->bind_param($tipos_parametros, ...$parametros);
}
$contar_stmt->execute();
$resultado = $contar_stmt->get_result();
$total = $resultado->fetch_object();
$ultima_pagina = ceil($total->cantidad / $offset);
$contar_stmt->close();

// Consulta principal para obtener las noticias
$sql = "SELECT N.*, C.nombre as categoria FROM noticias N INNER JOIN categorias C ON(C.id = N.id_categoria)";
if ($condiciones) {
    $sql .= " WHERE " . implode(" AND ", $condiciones);
}
$sql .= " ORDER BY N.fecha DESC LIMIT ? OFFSET ?";
$parametros[] = $offset;
$parametros[] = $limit;
$tipos_parametros .= "ii";

$stmt = $conx->prepare($sql);
$stmt->bind_param($tipos_parametros, ...$parametros);
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
			<section class="tarjeta">
				<h2><a href="detalle.php?id=<?php echo $fila->id ?>"><?php echo $fila->titulo ?></a></h2>
				<a href="detalle.php?id=<?php echo $fila->id ?>"><img src="panel/<?php echo $fila->imagen ?>" width="300"></a>
				<p><span><?php echo $fila->categoria ?></span> | Publicado el <?php echo $fila->fecha ?></p>
			</section>
		<?php } ?>
 	<?php } ?>
</div>

<div class="paginacion">
    <?php if ($pagina > 1) { ?>
        <a href="index.php?page=<?php echo $pagina - 1; ?>&buscar=<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>"> << </a>
    <?php } ?>

    <?php if ($ultima_pagina > 1) { 
        for ($i = 1; $i <= $ultima_pagina; $i++) { 
            if ($i == $pagina) { ?>
                <span class="paginaActual"><?php echo $i; ?></span>
            <?php } else { ?>
                <a href="index.php?page=<?php echo $i; ?>&buscar=<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>"><?php echo $i; ?></a>
            <?php } 
        } 
    } ?>

    <?php if ($pagina < $ultima_pagina) { ?>
	    <a href="index.php?page=<?php echo $pagina + 1; ?>&buscar=<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>"> >> </a>
    <?php } ?>
</div>

</body>
</html>