<?php


	if(isset($_POST['nombre']))
	{
		include("ConexionDAO.php");	
	   	$eCreate = new EstablecimientoCreate();
	   	$eCreate->insertEstablecimiento();
	   	$eCreate->cerrarConexion();
	}

	class EstablecimientoCreate
    {
    	public $iden;

    	public function __construct()
        {
            $this->iden = ConexionDAO::conectarBD();
        }      

        function cerrarConexion()
        {
        	ConexionDAO::desconectarBD();
        }

        function insertEstablecimiento()
	    {
			//Variables de apoyo
			$mensajeLog = "";

			//Variables del formulario
			$nombre = $_POST['nombre'];	
			$direccion = $_POST['direccion'];
			$horario = $_POST['horario'];
			$telefono = $_POST['telefono'];
			$nota = $_POST['nota'];
			$categoria = $_POST['categoria'];
			$caracteristicas = $_POST['caracteristicas'];
			$creado = time();
			$comentario  = $_POST['comentario'];
			if(!isset($_FILES['imagen']))
			{
				$imagen = "";
			}
			else
			{
				$anchoEstandar = 320;
				$altoEstandar = 180;
				$cordX = 0;
				$cordY = 0;

				$nombreImagen = $_FILES['imagen']['name'];
				$nombreImagenTemporal = $_FILES['imagen']['tmp_name'];
				$errorImagen = $_FILES['imagen']['error'];

				$ext_permitidas = array('jpg','jpeg','gif','png');
				$extension = end(explode('.',$nombreImagen));
				$ext_correcta = in_array($extension, $ext_permitidas);
				$tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $_FILES['imagen']['type']);		

				if($ext_correcta && $tipo_correcto)
				{
					if($errorImagen>0)
					{
						$mensajeLog = 'Error: '.$errorImagen;
					}
					else
					{
						if(file_exists('/'.$nombreImagen)){
							$mensajeLog = 'El archivo ya extiste: ';
						}
						else
						{
							$rutaImagen = 'imgs/'.$nombreImagen;
							move_uploaded_file($nombreImagenTemporal, $rutaImagen);

							$recursoFuente = imagecreatefromjpeg($rutaImagen);
							$infoFuente = getimagesize($rutaImagen);
							$imagenCopia = imagecreatetruecolor($anchoEstandar, $altoEstandar);

							//ancho < alto

							if(($infoFuente[0]<$anchoEstandar)&&($infoFuente[1]<$altoEstandar))
							{

								$nuevoAncho = $anchoEstandar;
								$nuevoAlto = $altoEstandar;
								$cordY = ($altoEstandar - $infoFuente[1])/2;
								$cordX = ($anchoEstandar - $infoFuente[0])/2;

								imagecopyresampled($imagenCopia, $recursoFuente, $cordX, $cordY, 0, 0, $infoFuente[0], $infoFuente[1], $infoFuente[0], $infoFuente[1]);
							}
							else
							{
								if($infoFuente[0]>$infoFuente[1])
								{
									$nuevoAncho = $anchoEstandar;
									$nuevoAlto = ($infoFuente[1] * $anchoEstandar)/$infoFuente[0];
									$cordX=0;
									$cordY = ($altoEstandar - $nuevoAlto)/2;
								}
								else
								{
									$nuevoAncho = ($infoFuente[0] * $altoEstandar)/$infoFuente[1];
									$nuevoAlto = $altoEstandar;
									$cordX = ($anchoEstandar - $nuevoAncho)/2;
									$cordY=0;
								}

								imagecopyresampled($imagenCopia, $recursoFuente, $cordX, $cordY, 0, 0, $nuevoAncho, $nuevoAlto, $infoFuente[0], $infoFuente[1]);
							}

							imagejpeg($imagenCopia,$rutaImagen);

							$mensajeLog = 'Guardado copón ya';
							$imagen = $nombreImagen;
						}
					}
				}
			}

			$sql="INSERT INTO t_establecimiento (nombre, direccion, horario, telefono, nota, categoria, caracteristicas, imagen, creado, comentario) VALUES ('$nombre','$direccion','$horario','$telefono','$nota','$categoria','$caracteristicas','$imagen',FROM_UNIXTIME('$creado'),'$comentario' )";

			$insertar = mysqli_query($this->iden, $sql);

			if($insertar)
			{
				$mensajeLog = "Establecimiento añadido con éxito";
			}
			else
			{
				$mensajeLog = "Ha habido un fallo con el guardado del establecimiento";
			}
			echo $mensajeLog;
		}
	}
?>