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
            ?>

            <div id="contenido">
                <h2 id="tituloContenedorEstablecimientos" class="tituloSeccion" >Noticias</h2>

                <?php
                    
                    session_start();
                    $categoria = 5;
                    $validacion = validarCredencial($_SESSION["id_tipo_usuario"], $categoria);
                    if($validacion)
                        echo('<span><a href="nuevaNoticia.php">Añadir noticia</a></span>');
                ?>

                <div id="noticiasContenedor">
                    <?php
                        //Conectamos al SGDB
                        $nRead = new NoticiaRead();
                        $arrayNoticias = $nRead->selectNoticias(0);

                        //while($noticia=mysqli_fetch_assoc($arrayNoticias))
                        foreach ($arrayNoticias as $noticia) 
                        {
                           $idnoticia = $noticia['id_noticia'];
                           $titularNoticia = $noticia['titular_noticia'];
                           $textoNoticia = $noticia['texto_noticia'];
                           $idCategoriaNoticia = $noticia['categoria_noticia'];
                           $idUsuario = $noticia['usuario'];
                           $fechaCreacion = $noticia['fecha_creacion'];
                            

                            echo('<div class="articulo">');
                                 echo('<div class="fecha">');
                                    echo('<div class="mes">'.substr(date("F", $fechaCreacion),0,3).'</div>');
                                    echo('<div class="dia">'.date("d", $fechaCreacion).'</div>');
                                    echo('<div class="anio">'.date("Y", $fechaCreacion).'</div>');
                                echo('</div>');
                                echo('<a id="noticia'.$idnoticia.'" href="verNoticia.php?t='.$idnoticia.'"><h3 class="tituloArticulo" >'.$titularNoticia.'</h3></a>');
                                echo('<div class="cuerpoArticulo" style = "visibility:visible">');
                                    echo('<p class="contenidoArticulo">'.$textoNoticia.'</p>');
                                    echo('<span class="autorArticulo">'.$idUsuario.'</span>');
                                    echo('<span class="categoriaNoticia">'.$idCategoriaNoticia.'</span>');
                                echo('</div>');
                            echo('</div>');
                        }

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