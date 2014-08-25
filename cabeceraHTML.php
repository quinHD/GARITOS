    <div id="cabecera">
        <div id="loginUsuario">
            <?php
                include_once("_librerias.php");
            ?>
        
            <?php
                session_start();
               
 
                if(isset($_SESSION['usuario'])){
                    echo('<form id="formlogout" name="formlogout" method="post" action="logout.php">');
                    echo('<label for="usuario">Usuario: </label>');
                    echo('<span name="usuario" type="text" id="usuariocampo" size="20">'.$_SESSION['usuario'].'</span>');
                    echo('<input type="submit" name="botonenviar" id="botonenviar" value="Salir"/>');
                    echo('</form>');
                }
                else
                {
                    echo('<form id="formlogin" name="formlogin" method="post" action="Login.php">');
                    echo('<label for="usuario">Usuario: </label>');
                    echo('<input name="usuario" type="text" id="usuariocampo" size="20" />');
                    echo('<label for="password">Contraseña: </label>');
                    echo('<input name="password" type="password" id="passwordcampo" size="20"/>');
                    echo('<input type="submit" name="botonenviar" id="botonenviar" value="Enviar"/>');
                    echo('<span><a id="nuevoUsuario" href="nuevoUsuario.php">Registrarse</a></span>');
                    echo('</form>');
                }
            ?>
            <div class="clear"></div> 
        </div>

        
        <a name="arriba"><img id="imgCabecera" alt="imagen de cabecera" src="img/cabecera.jpg"/></a>
    </div> <!--Fin Cabecera -->

    <div id="menuPrincipal" >

        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="noticias.php">Noticias</a></li>
            <li><a href="establecimientos.php">Establecimientos</a></li>
            <?php
                $categoria = 1;
                $validacion = validarCredencial($_SESSION["id_tipo_usuario"], $categoria);
                if($validacion)
                    echo('<li><a href="administracion.php">Administración</a></li>');

            ?>
            <li><a href="index.php">Quienes somos</a></li>
            <li><a href="index.php">Contacto</a></li>
          
        </ul>
       
        <div class="clear"></div> 
      
    </div ><!--Fin Menu -->