<?php
	include_once("ChromePhp.php");
	include_once("ConexionDAO.php");

	if(isset($_POST["noticiaSeleccionada"]))
	{		
		//Conectamos al SGDB
		$iden = ConexionDAO::conectarBD();

		foreach ($_POST["noticiaSeleccionada"] as $check ) 
		{
			$query = "DELETE FROM t_noticia WHERE id_noticia = '".$check."';" ;
            $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

            $query = "DELETE FROM t_comentario WHERE id_noticia = '".$check."';" ;
            $select = mysqli_query($iden,$query) or die('Error'.mysql_error());
		}	

        if (isset($iden)) 
            ConexionDAO::desconectarBD();
	}

	header('Location:'.$_SERVER['HTTP_REFERER']);
?>
