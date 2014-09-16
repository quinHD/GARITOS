<?php
	include_once("_librerias.php");

	session_start();

	if(isset($_POST["usuario"])&&isset($_POST["password"]))
	{

		Login::doLogin();
	}

	
	class Login
	{
		static function doLogin()
		{
			$nombre = null;
			$password = null;
			$idUsuario = null;
			$idTipoUsuario = 1;
			$resumen = "";
			if(isset($_POST["usuario"])&&isset($_POST["password"]))
			{

				$iden = ConexionDAO::conectarBD();

				$nombre = $_POST["usuario"];
				$password = $_POST["password"];

				$sentencia = "SELECT ID_USUARIO, USUARIO, PASSWORD, ID_TIPO_USUARIO FROM t_usuario WHERE USUARIO ='".$nombre."';";
								
				$resultado = mysqli_query($iden, $sentencia);
				//Si existe el usuario introducido lo cargamos

				while($fila = mysqli_fetch_assoc($resultado))
				{
					$passwordTemp = $fila['PASSWORD'];

					if($passwordTemp == $password)
					{

						$_SESSION["usuario"] = $fila['USUARIO'];
						$_SESSION["id_usuario"] = $fila['ID_USUARIO'];
						$_SESSION["id_tipo_usuario"] = $fila['ID_TIPO_USUARIO'];
						ChromePhp::log("A: ".$_SESSION["id_tipo_usuario"] );
						ChromePhp::log("B: ".$fila['ID_TIPO_USUARIO'] );
						$resumen = "Usuario cargado con éxito";
					}
					else
					{
						$resumen = "Contraseña Incorrecta";
					}
				}

				ConexionDAO::desconectarBD();
			}
			else
			{
				$_SESSION["usuario"] = null;
				$_SESSION["id_usuario"] = null;
				$_SESSION["id_tipo_usuario"] = 1;
			}
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}
	}
?>
