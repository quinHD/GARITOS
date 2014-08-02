<?php
	include 'ChromePhp.php';
	$nombre = null;
	$password = null;
	$resumen = "";
	
	if(isset($_POST["usuario"]))
	{
		$nomTem = $_POST["usuario"];
		$passTem = $_POST["password"];
		
		//Conectamos al SGDB
		if(!($iden = mysql_connect("localhost","root","root")))
			die ("No se ha podido conectar");

		//Conectamos a la base de datos
		if(!mysql_select_db("garitos",$iden))
			die ("No se ha encontrado la base de datos");

		$sentencia = "SELECT * FROM t_usuario WHERE USUARIO ='".$nomTem."';";
		
		$resultado = mysql_query($sentencia,$iden);

echo('que pasa pavo');
		//Si existe el usuario introducido lo cargamos
		if(mysql_num_rows($resultado)>0)
		{	
			while($fila = mysql_fetch_assoc($resultado))
			{
				$password = $fila['PASSWORD'];
			}

			if($password == $passTem)
			{
				$nombre = $nomTem;
				$resumen = "Usuario cargado con éxito";
				$_SESSION["usuario"] = $nombre;
				$_SESSION["id_tipo_usuario"] = $fila['ID_TIPO_USUARIO'];
				ChromePhp::log($_SESSION["usuario"]);
				ChromePhp::log($_SESSION["id_tipo_usuario"]);
			}
			else
			{
				$resumen = "Contraseña Incorrecta";
			}
		}
		else
		{
			if($nomTem && $passTem)
			{
				$sql="INSERT INTO t_usuario (USUARIO, PASSWORD) VALUES ('$nomTem','$passTem')";
				$insertar = mysql_query($sql,$iden);
				if($insertar)
				{
					$resumen = "Usuario registrado con éxito";
					$_SESSION["usuario"] = $nomTem;
				}
				else
					$resumen = "No se ha podido registrar el usuario";
			}
		}
	}

?>
