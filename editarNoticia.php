
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

                $idNoticia = $_GET['t'];

                if($idNoticia>0)
                {
                    //Conectamos al SGDB
                    $nRead = new NoticiaRead();
                    $arrayNoticias = $nRead->selectNoticiaUpdate($idNoticia);

                    //$idNoticia
                    $titularNoticia = $arrayNoticias['titular_noticia'];
                    $textoNoticia = $arrayNoticias['texto_noticia'];
                    $idCategoriaNoticia = $arrayNoticias['id_categoria_noticia'];
                    $usuario = $arrayNoticias['usuario'];

                    $nRead->cerrarConexion();  
                }
            ?>

            <div id="contenido">
                <?php
                    echo('<div id="noticiaContenedor">');                  
                        echo('<form id="formEdicionNoticia" name="formEdicionNoticia" method="post" action="NoticiaUpdate.php" enctype="multipart/form-data">');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="idField">Id: </label><input readonly name="idNoticia" type="text" id="idNoticia" size="50" autocomplete="off" value="'.$idNoticia.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="nombreField">Titular: </label><input name="titular" type="text" id="titular" size="50" autocomplete="off" value="'.$titularNoticia.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="passwordField">Usuario: </label><input readonly name="usuario" type="text" id="usuario" size="50" autocomplete="off" value="'.$usuario.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="categoriaField">Categoria: </label>');
                            echo('<select name="categoria" id="categoriaField" form="formEdicionNoticia">');
                                   
                                //Conectamos al SGDB
                                $iden = ConexionDAO::conectarBD();

                                $query = 'SELECT id_categoria_noticia, categoria_noticia FROM t_categoria_noticia ORDER BY id_categoria_noticia';

                                $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

                                while($valor=mysqli_fetch_assoc($select))
                                {
                                    if($idCategoriaNoticia == $valor['id_categoria_noticia'])
                                        echo('<option selected value="'.$valor['id_categoria_noticia'].'">'.$valor['categoria_noticia'].'</option>');
                                    else
                                        echo('<option value="'.$valor['id_categoria_noticia'].'">'.$valor['categoria_noticia'].'</option>');
                                }
                            echo('</select>');

                            echo('</div>'); //Cerramos el div abierto en TipoUsuario, unas lineas más arriba
                            ?>
                            <div class="camposFormulario"><label class="lblFormulario" for="textoNoticia">Texto: </label><input name="textoNoticia" type="text" id="textoNoticia" size="50" autocomplete="off" value='<?php echo($textoNoticia)?>'/></div>
                            <?php
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
