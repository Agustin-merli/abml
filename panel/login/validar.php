<?php

@session_start();

if (!isset ($_SESSION['id']) || empty($_SESSION['id'])) {
	header("Location: /programacion/abml/panel/login/login.php");
	exit();
}

?>