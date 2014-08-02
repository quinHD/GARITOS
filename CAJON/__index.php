<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="estilo.css"/>
		<title>Garitolandia</title>

		<?php
			session_start();
		?>
	</head>
	
	<body>
		<div id="cabeceraPrincipal" class="cabecera">
			<div id="menuCont">
		        <ul id="menu">
		            <li><a href="/">Inicio</a></li>
		            <li><a href="/">Establecimientos</a></li>
		            <li><a href="/backend.php" target="_blank">Subir</a></li>
		            <li><a href="/">Comercios</a></li>
		            <li><a href="/">Contacto</a></li>
		          
		        </ul>
            	<div class="clear"></div> 
            </div>

        	<div id="loginUsuario">
				
				<?php
					if(isset($_SESSION['usuario'])){
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



		<div class="contenedorCentral">
			<?php
				//Conectamos al SGDB
				
				if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
					die ("No se ha podido conectar");

				$query = 'SELECT * FROM t_establecimiento ORDER BY id_establecimiento';

				$select = mysqli_query($iden,$query) or die('Error'.mysql_error());
				$raizImagenes = "imgs/";

				while($valor=mysqli_fetch_assoc($select))
				{

					$id = $valor['id_establecimiento'];	
					$nombre = $valor['nombre'];
					$direccion = $valor['direccion'];
					$horario = $valor['horario'];
					$telefono = $valor['telefono'];
					$nota = $valor['nota'];
					$categoria = $valor['categoria'];
					$caracteristicas = $valor['caracteristicas'];
					$imagen = $raizImagenes.$valor['imagen'];
					$creado = $valor['creado'];
					$comentario = $valor['comentario'];

					echo ('<div class="establecimiento">');
					echo ('<div class="contApartado" id="aptdoImagen"><img src="'.$imagen.'" class="imagenCabecera"></img></div>');
					echo ('<div class="contApartado" id="aptdoNombre"><label class="lblApartado" for="nombre">Nombre: </label><span class="apartado name="nombre">'.$nombre.'</span></div>');
					echo ('<div class="contApartado" id="aptdoDireccion"><label class="lblApartado" for="direccion">Dirección: </label><span class="apartado name="direccion">'.$direccion.'</span></div>');
					echo ('<div class="contApartado" id="aptdoHorario"><label class="lblApartado" for="horario">Horario: </label><span class="apartado name="horario">'.$horario.'</span></div>');
					echo ('<div class="contApartado" id="aptdoTelefono"><label class="lblApartado" for="telefono">Teléfono: </label><span class="apartado name="telefono">'.$telefono.'</span></div>');
					echo ('<div class="contApartado" id="aptdoNota"><label class="lblApartado" for="nota">Nota: </label><span class="apartado name="nota">'.$nota.'</span></div>');
					
					echo ('<div class="contApartado" id="aptdoCategoria"><label class="lblApartado" for="categoria">Categoría: </label>');
					$listaCategorias = explode(",",$categoria);
					foreach ($listaCategorias as $ctgr) 
					{
						echo ('<span class="apartado categoria" name="categoria">'.trim($ctgr).'</span>');	
					}
					echo('</div>');
					echo ('<div class="contApartado" id="aptdoCaracteristicas"><label class="lblApartado" for="caracteristicas">Características: </label>');
					$listaCaracteristicas = explode(",",$caracteristicas);
					foreach ($listaCaracteristicas as $crtrstc) 
					{
						echo ('<span class="apartado caracteristica" name="caracteristicas">'.trim($crtrstc).'</span>');	
					}
					echo('</div>');
					echo ('<div class="contApartado" id="aptdoApartado"><label class="lblApartado" for="comentario"></label><span class="apartado name="comentario">'.$comentario.'</span></div>');
					echo ('</div>');



				}

				if (isset($iden)) 
				{
					mysqli_free_result($iden);
				}

			
			?>
		</div>
	</body>

</html>