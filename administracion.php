<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <?php
            require("headHTML.php");
            session_start();

            $categoria = 1;
            $validacion = validarCredencial($_SESSION["id_tipo_usuario"], $categoria);
            if(!$validacion)
                header("location:index.php");

        ?>
        <link rel="stylesheet" type="text/css" href="css/administracion.css">
    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");

            ?>

            <div id="contenido" >
                <h2 id="tituloContenedorAdministracion" class="tituloSeleccion" >Administración</h2>
                <p id="descripcionAdministracion">
                    Esta sección esta disponible solo para el administrador, desde aquí se pueden visualizar y administrar los elementos que componen la web. A este apartado sólo tiene acceso los usuarios con privilegios de administrador.
                </p>
                <div id="adminContenedorImg">
                    <span class="seccionesAdminImg" id="adminUsuariosImg"><img src="/img/usuariosIcon.svg"></img></span>
                    <span class="seccionesAdminImg" id="adminNoticiasImg"><img src="/img/noticiasIcon.svg"></img></span>
                    <span class="seccionesAdminImg" id="adminEstablecimientosImg"><img src="/img/establecimientosIcon.svg"></img></span>
                    
                </div>
                <div id="adminContenedor">
                    <span class="seccionesAdmin" id="adminUsuarios"><a href="adminUsuarios.php">Administrar Usuarios</a> </span>
                    <span class="seccionesAdmin" id="adminNoticias"><a href="adminNoticias.php">Administrar Noticias</a> </span>
                    <span class="seccionesAdmin" id="adminEstablecimientos"><a href="adminEstablecimientos.php">Administrar Establecimientos</a> </span>
                    
                </div>

                <?php
                    require("bannersHTML.php");
                ?>
               
            </div><!--Fin contenido -->

            <?php
                require("pieHTML.php");
            ?>
        </div><!--Fin Contenedor -->
    </body>

</html>