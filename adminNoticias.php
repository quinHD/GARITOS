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
                <div id="adminNoticiasContenedor" class="tituloSeccion">
                    <?php
                        //Conectamos al SGDB
                        $nRead = new NoticiaRead();
                        $arrayNoticias = $nRead->selectNoticias(0,0,0); //0-> Límite, 0->Sin orden, orden por ID, 0->si filtro
                       
                        echo('<table>');
                        echo('<tr>');
                            echo('<td>ID</td>');
                            echo('<td>TITULAR</td>');
                            echo('<td>CATEGORÍA</td>');
                            echo('<td>USUARIO</td>');
                            echo('<td>CREADO</td>');
                            echo('<td>SEL</td>');
                        echo('</tr>');
                        foreach ($arrayNoticias as $valor) 
                        {
                            $idnoticia = $valor['id_noticia']; 
                            $titularNoticia = $valor['titular_noticia'];
                            $idCategoriaNoticia = $valor['categoria_noticia'];
                            $idUsuario = $valor['usuario'];
                            $fechaCreacion = $valor['fecha_creacion'];

                            echo('<tr>');
                                echo('<td><span>'.$idnoticia.'</span></td>');
                                echo('<td><span>'.$titularNoticia.'</span></td>');
                                echo('<td><span>'.$idCategoriaNoticia.'</span></td>');
                                echo('<td><span>'.$idUsuario.'</span></td>');
                                echo('<td><span>'.$fechaCreacion.'</span></td>');
                                echo('<td><span><a href="editarNoticia.php?t='.$idnoticia.'">Editar</a></span></td>');
                                echo('<td><span><input type="checkbox"  form="formBajaNoticia" name="noticiaSeleccionada[]" value="'.$idnoticia.'"></span></td>');
                            echo('</tr>');

                        }
                        echo('<br/>');
                        echo('</table>');

                        echo('<form id="formBajaNoticia" name="formBajaNoticia" method="post" action="NoticiaDelete.php" >');
                            echo('<div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Eliminar"/></div>');
                        echo('</form>');                        

                        $nRead->cerrarConexion();   
                    
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