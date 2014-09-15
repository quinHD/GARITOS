
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <?php
            require("headHTML.php");
        ?>

    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");

                $idUsuario = $_GET['t'];

                if($idUsuario>0)
                {
                    //Conectamos al SGDB
                    $uRead = new UsuarioRead();
                    $arrayUsuarios = $uRead->selectUsuario($idUsuario);

                    //$idUsuario
                    $usuario = $arrayUsuarios['usuario'];
                    $password = $arrayUsuarios['password'];
                    $id_tipo_usuario = $arrayUsuarios['id_tipo_usuario'];
                      
                    $uRead->cerrarConexion();  
                }
            ?>

            <div id="contenido">
                <?php
                    echo('<div id="usuarioContenedor">');                  
                        echo('<form id="formEdicionUsuario" name="formEdicionUsuario" method="post" action="UsuarioUpdate.php" enctype="multipart/form-data">');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="idField">Id: </label><input readonly name="idUsuario" type="text" id="idUsuario" size="50" autocomplete="off" value="'.$idUsuario.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="nombreField">Usuario: </label><input name="usuario" type="text" id="usuarioField" size="50" autocomplete="off" value="'.$usuario.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="passwordField">Usuario: </label><input name="password" type="text" id="passwordField" size="50" autocomplete="off" value="'.$password.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="tipoUsuarioField">Tipo Usuario: </label>');
                            echo('<select name="tipoUsuarioCombo" id="tipoUsuarioCombo" form="formEdicionUsuario">');
                                   
                                //Conectamos al SGDB
                                $iden = ConexionDAO::conectarBD();

                                $query = 'SELECT id_tipo_usuario, tipo_usuario FROM t_tipo_usuario';

                                $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

                                while($valor=mysqli_fetch_assoc($select))
                                {

                                    if($id_tipo_usuario == $valor['id_tipo_usuario'])
                                        echo('<option selectec value="'.$valor['id_tipo_usuario'].'">'.$valor['tipo_usuario'].'</option>');
                                    else
                                        echo('<option value="'.$valor['id_tipo_usuario'].'">'.$valor['tipo_usuario'].'</option>');
                                }
                            echo('</select>');
                            echo('</div>'); //Cerramos el div abierto en TipoUsuario, unas lineas más arriba
                            echo('<div id="botonera">');
                            echo('<div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>');
                            echo('<div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>');
                            echo('</div>');
                        echo('</form>');
                    echo('</div>');
                ?>

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
