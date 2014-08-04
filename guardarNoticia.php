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
			$titular = $_POST['titular'];	
			$categoria = $_POST['categoria'];
			$noticia = $_POST['noticia'];
			$usuario = $_POST['usuario'];
			$creado = time();

			$sql="INSERT INTO t_noticia (titular_noticia, texto_noticia, id_categoria_noticia, fecha_creacion, id_usuario) VALUES ('$titular','$noticia','$categoria', FROM_UNIXTIME('$creado'),'$usuario')";

			$insertar = mysqli_query($iden, $sql);

			if($insertar){
				$mensajeLog = "Noticia creada con éxito";
			}
			else{
				$mensajeLog = "Ha habido un fallo en la creación de la noticia";
			}

			echo $mensajeLog;
		?>

	</body>

</hmtl>