<?php
	function loginAnonimo()
	{
		$_SESSION["usuario"] = null;
		$_SESSION["id_usuario"] = null;
		$_SESSION["id_tipo_usuario"] = 1;
	}

?>