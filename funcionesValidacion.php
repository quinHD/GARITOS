<?php
	function getRango($id_tipo_usuario)
	{
		$rng = 9;
		//Conectamos al SGDB	                        
	    if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
	        die ("No se ha podido conectar");

	    $query = "SELECT rango
	              FROM t_tipo_usuario 
	              WHERE id_tipo_usuario = '".$id_tipo_usuario."';"
	            ;

	    $select = mysqli_query($iden,$query) or die('Error'.mysqli_error());

	    while($valor=mysqli_fetch_assoc($select))
	    {
	    	$rng = $valor['rango'];
	    }

	    if (isset($iden)) 
	    {
	        mysqli_close($iden);
	    }

	    return $rng;
	}
    /*
    	Un usuario será válido si su rango (una vez obtenido con el id_tipo_usuario) es menor o igual a la categoría recibida.
    */
	function validarCredencial($id_tipo_usuario, $categoria)
	{
		$valido = false;
		
		if($id_tipo_usuario == null)
			$rango = 9;
		else
			$rango = getRango($id_tipo_usuario);


		if($categoria >= $rango)
			$valido = true;

		return $valido;
	}

?>