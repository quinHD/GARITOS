<?php

	include("ChromePhp.php");
	if(isset($_POST["usuarioSeleccionado"]))
	{		
		//Conectamos al SGDB
		if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
			die ("No se ha podido conectar");

		foreach ($_POST["usuarioSeleccionado"] as $check ) 
		{
			$query = "DELETE FROM t_usuario WHERE id_usuario = '".$check."';" ;
            ChromePhp::log($query);

            $select = mysqli_query($iden,$query) or die('Error'.mysql_error());
		}	

        if (isset($iden)) 
            mysqli_free_result($iden);
	}

	header('Location:'.$_SERVER['HTTP_REFERER']);
?>
