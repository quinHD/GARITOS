<?php
	include_once("ChromePhp.php");
	include_once("ConexionDAO.php");
	
	if(isset($_POST["establecimientoSeleccionado"]))
	{		
		//Conectamos al SGDB
		$iden = ConexionDAO::conectarBD();
		foreach ($_POST["establecimientoSeleccionado"] as $check ) 
		{
			$query = "DELETE FROM t_establecimiento WHERE id_establecimiento = '".$check."';" ;
            $select = mysqli_query($iden,$query) or die('Error'.mysql_error());
		}	

        if (isset($iden)) 
            ConexionDAO::desconectarBD();
	}

	header('Location:'.$_SERVER['HTTP_REFERER']);
?>
