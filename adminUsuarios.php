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
                <div id="adminUsuarioContenedor" class="tituloSeccion">
                    <?php
                        //Conectamos al SGDB
                        
                        //Conectamos al SGDB
                        $uRead = new UsuarioRead();
                        $arrayUsuarios = $uRead->selectUsuarios();

                        echo('<table>');
                        echo('<tr>');
                            echo('<td>ID</td>');
                            echo('<td>USUARIO</td>');
                            echo('<td>TIPO_USUARIO</td>');
                            echo('<td>SEL</td>');
                        echo('</tr>');
                        foreach ($arrayUsuarios as $valor) 
                        {
                            $id = $valor['id_usuario']; 
                            $usuario = $valor['usuario'];
                            $tipo_usuario = $valor['tipo_usuario'];

                            echo('<tr>');
                                echo('<td><span>'.$id.'</span></td>');
                                echo('<td><span>'.$usuario.'</span></td>');
                                echo('<td><span>'.$tipo_usuario.'</span></td>');
                                echo('<td><span><input type="checkbox"  form="formBajaUsuario" name="usuarioSeleccionado[]" value="'.$id.'"></span></td>');
                            echo('</tr>');
                        }
                        echo('<br/>');
                        echo('</table>');

                        echo('<form id="formBajaUsuario" name="formBajaUsuario" method="post" action="UsuarioDelete.php" >');
                            echo('<div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Eliminar"/></div>');
                        echo('</form>');

                        $uRead->cerrarConexion();  
                    
                    ?>
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