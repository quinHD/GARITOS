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
    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");
            ?>

            <div id="contenido" >
                <div id="adminContenedor" class="tituloSeccion">
                    <div id="adminUsuarios"><a href="adminUsuarios.php">Administrar Usuarios</a> </div>
                    <div id="adminNoticias"><a href="adminNoticias.php">Administrar Noticias</a> </div>
                    <div id="adminEstablecimientos"><a href="adminEstablecimientos.php">Administrar Establecimientos</a> </div>
                    
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