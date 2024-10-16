<?php 

$servidor = "localhost";
$user = "root";
$password = "";
$database = "mi_base_de_datos";

$conx = new mysqli($servidor, $user, $password, $database);

if ($conx->connect_error) {
	echo "error: ".$conx->connect_error;
}

?>