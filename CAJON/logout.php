<?php
	//Inicio de sesión
	session_start();

	//Liberación de sesión
	session_destroy();

	//Liberación de variables por seguridad
	unset($_SESSION['usuario']);

	session_unset();

	header("Location: index.php");

?>