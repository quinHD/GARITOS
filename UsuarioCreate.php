<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Garitolandia BackEnd</title>
	</head>

	<body>

		<?php
			include 'ChromePhp.php';

			//Conectamos al SGDB
			if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
				die ("No se ha podido conectar");

			//Variables de apoyo
			$mensajeLog = "";

			//Variables del formulario
			$usuario = $_POST['usuario'];	
			$password = $_POST['password'];
			ChromePhp::log($_POST);
			$tipoUsuario = 1; //Por defecto se crean con 2 porque es el número que corresponde con "usuario registrado"



			$sql="INSERT INTO t_usuario (usuario, password, id_tipo_usuario) VALUES ('$usuario','$password','$tipoUsuario')";

			$insertar = mysqli_query($iden, $sql);

			if($insertar){
				$mensajeLog = "Usuario creado con éxito";
			}
			else{
				$mensajeLog = "Ha habido un fallo en la creación del usuario";
			}

			echo $mensajeLog;
		?>

	</body>

</hmtl>