<?php
	include_once("ConexionDAO.php");
	
	function comentarioDelete($idBorrado)
	{
		
		//Conectamos al SGDB
		$iden = ConexionDAO::conectarBD();

		$query = "DELETE FROM t_comentario WHERE id_comentario = '".$idBorrado."';" ;
        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

        if (isset($iden)) 
            ConexionDAO::desconectarBD();
    }
?>
