<?php

	if(isset($_POST['titular']))
	{
		include("ConexionDAO.php");	
	   	$nCreate = new NoticiaCreate();
	   	$nCreate->insertNoticia();
	   	$nCreate->cerrarConexion();
	}


	class NoticiaCreate
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

        function insertAutomaticoNoticia($titular, $categoria, $noticia)
        {

        	$usuario = $_SESSION['id_usuario'];
			$creado = time();
        	$sql="INSERT INTO t_noticia (titular_noticia, texto_noticia, id_categoria_noticia, fecha_creacion, id_usuario) VALUES ('$titular','$noticia','$categoria', FROM_UNIXTIME('$creado'),'$usuario')";
        	$insertar = mysqli_query($this->iden, $sql);
        }

        function insertNoticia()
	    {
			//Variables de apoyo
			$mensajeLog = "";

			//Variables del formulario
			$titular = $_POST['titular'];	
			$categoria = $_POST['categoria'];
			$noticia = $_POST['noticia'];
			$usuario = $_POST['usuario'];
			$creado = time();



			$sql="INSERT INTO t_noticia (titular_noticia, texto_noticia, id_categoria_noticia, fecha_creacion, id_usuario) VALUES ('$titular','$noticia','$categoria', FROM_UNIXTIME('$creado'),'$usuario')";

			$insertar = mysqli_query($this->iden, $sql);

			if($insertar){
				$mensajeLog = "1#Noticia creada con éxito";

				//Una vez insertada la noticia creamos un fichero noticia que sigue el patrón de noticiaX donde se mostrará

				$noticiaInsertada = mysqli_insert_id($iden);
				copy("_noticiaX.php", "noticia".$noticiaInsertada.".php");
			}
			else{
				$mensajeLog = "0#Ha habido un fallo en la creación de la noticia";
			}

			echo $mensajeLog;

		}

		function addNoticia($_titular, $_categoria, $_noticia, $_usuario)
		{

			if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
				die ("No se ha podido conectar");

			$creado = time();

			$sql="INSERT INTO t_noticia (titular_noticia, texto_noticia, id_categoria_noticia, fecha_creacion, id_usuario) VALUES ('$_titular','$_noticia','$_categoria', FROM_UNIXTIME('$creado'),'$_usuario')";

			$insertar = mysqli_query($iden, $sql);
		}
	}

?>

