<?php
	include_once("_librerias.php");


	if(isset($_GET['id']))
	{
		$idBorrado = $_GET['id'];

		borrarComentario($idBorrado);
	}

	function borrarComentario($idBorrado)
	{
		$msj = "";
		if(comentarioDelete($idBorrado))
			$msj="Comentario borrado con éxito";
		else
			$msj="No se ha podido borrar el comentario";

		header('Location:'.$_SERVER['HTTP_REFERER']);

	}


?>