<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="estiloBackend.css">
		<?php
			session_start();
		?>
		<script type="text/javascript">

			function calculoNota(){
				var notaAux;
				notaAux = document.getElementById("notaField").value;
				notaAux = notaAux*2;
				notaAux = Math.round(notaAux);
				notaAux =  notaAux/2;
				document.getElementById("notaField").value = notaAux;

			}
	
			function objetoAjax()
			{
				var xmlhttp=  new XMLHttpRequest();
				return xmlhttp;
			}

			function enviarDatos()
			{
				var formElement = document.getElementById("formAltaEstablecimiento");

				resultado = document.getElementById("resultadoCarga");
				ajax = objetoAjax();
				ajax.open("POST", "guardarEstablecimiento.php", true);
				ajax.onreadystatechange = function()
				{
					if(ajax.readyState == 4)
					{
						resultado.innerHTML = (ajax.responseText);
						formElement.reset();
						document.getElementById("nombreField").focus();
					}
				}

				//ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajax.send(new FormData(formElement));
			}

		</script>
		<title>Garitolandia BackEnd</title>
	</head>
	
	<body>
		<div id="cabeceraPrincipal" class="cabecera">
			<div id="menuCont">
		        <ul id="menu">
		            <li><a href="/">Inicio</a></li>
		            <li><a href="/">Establecimientos</a></li>
		            <li><a href="/backend.html" target="_blank">Subir</a></li>
		            <li><a href="/">Comercios</a></li>
		            <li><a href="/">Contacto</a></li>
		          
		        </ul>
            	<div class="clear"></div> 
            </div>

        	<div id="loginUsuario">
				
				<?php
					if($_SESSION['usuario']){
						echo('<form id="formlogout" name="formlogout" method="post" action="logout.php">');
						echo('<label for="usuario">Usuario: </label>');
						echo('<span name="usuario" type="text" id="usuariocampo" size="20">'.$_SESSION['usuario'].'</span>');
						echo('<input type="submit" name="botonenviar" id="botonenviar" value="Salir"/>');
						echo('</form>');
					}
					else{
						echo('<form id="formlogin" name="formlogin" method="post" action="login.php">');
						echo('<label for="usuario">Usuario: </label>');
						echo('<input name="usuario" type="text" id="usuariocampo" size="20" />');
						echo('<label for="password">Contraseña: </label>');
						echo('<input name="password" type="password" id="passwordcampo" size="20"/>');
						echo('<input type="submit" name="botonenviar" id="botonenviar" value="Enviar"/>');
						echo('</form>');
					}

				?>
				
				<div class="clear"></div> 
        	</div>

          
        </div> <!--Fin Cabecera -->



		<div id="contenedorPrincipal">
			<form id="formAltaEstablecimiento" name="formAltaEstablecimiento" method="post" action="" enctype="multipart/form-data" onSubmit="enviarDatos(); return false">
				<div class="camposFormulario"><label class="lblFormulario" for="nombreField">Nombre: </label><input name="nombre" type="text" id="nombreField" size="50" autocomplete="off"/></div>
				<div class="camposFormulario"><label class="lblFormulario" for="direccionField">Dirección: </label><input name="direccion" type="text" id="direccionField" size="50" autocomplete="off"/></div>
				<div class="camposFormulario"><label class="lblFormulario" for="horarioField">Horario: </label><input name="horario" type="text" id="horarioField" size="20" autocomplete="off"/></div>
				<div class="camposFormulario"><label class="lblFormulario" for="telefonoField">Teléfono: </label><input name="telefono" type="text" id="telefonoField" size="9" autocomplete="off"/></div>
				<div class="camposFormulario"><label class="lblFormulario" for="notaField">Nota: </label><input name="nota" type="text" id="notaField" size="5" autocomplete="off" onblur='calculoNota()'/></div>
				<div class="camposFormulario"><label class="lblFormulario" for="categoriaField">Categoría: </label><input name="categoria" type="text" id="categoriaField" size="50" autocomplete="off"/></div>
				<div class="camposFormulario"><label class="lblFormulario" for="caractField">Características: </label><input name="caracteristicas" type="text" id="caractField" size="50" autocomplete="off"/></div>
				<div class="camposFormulario"><label class="lblFormulario" for="comentarioField">Comentario: </label><textarea rows="5" cols="60" id ="comentarioField"  name ="comentario" form="formAltaEstablecimiento"></textarea></div>
				<div class="camposFormulario"><label class="lblFormulario" for="imgField">Imagen: </label><input class="botonImagen" name="imagen" type="file" id="imgField" /></div>
				<div id="botonera">
				<div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>
				<div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>
				</div>
				
			</form>

			<div id="contenedorResultado"><span id="resultadoCarga">Jejeje</span></div>
			
		</div>

	</body>

</hmtl>