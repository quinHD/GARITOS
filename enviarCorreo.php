<?php

	if(isset($_POST["mensaje"]))
	{
		$respuesta = "";

		
		$destinatario = "insertmail";
		
		$mensaje = $_POST["mensaje"];
		$asunto = "Mensaje del usuario: ".$_POST["usuario"];

		/*$headers = 'From: jrsa@enresa.es \r\n'.
					'Reply-To: '.$destinatario.'\r\n'.
					'X-Mailer: PHP/'.phpversion();*/
		if(mail($destinatario, $asunto, $mensaje))
			$respuesta = "Mensaje enviado correctamente!";
		else
			$respuesta = "Fallo!";

		echo $respuesta;
	}
?>
