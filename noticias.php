<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <?php
            require("headHTML.php");  
        ?>
        <link type="text/css" rel="stylesheet" href="css/noticias.css"></link>

    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");
            ?>

            <div id="contenido">
                <h2 id="tituloContenedorNoticias" class="tituloSeccion" >Noticias</h2>
                <div id="noticiasCabecera">
                <?php
                    
                    session_start();

                    
                    echo('<div id="contFiltros">');
                    /*$filtroCatNoticia=0;
                    if(isset($_GET["categoria"]))
                    {
                        $filtroCatNoticia = $_GET["categoria"];*/
                        echo('<span class="filtrarCategoria" id="fltrTodas"><a href="noticias.php">Todas Noticias</a></span>');

                    //}

                    $nRead = new NoticiaRead();
                    $arrayCategorias = $nRead->selectCategorias(); 

                    foreach ($arrayCategorias as $cateNot) 
                    {
                       $idCat = $cateNot['id_categoria_noticia'];
                       $txtCat = $cateNot['categoria_noticia'];
                       echo('<span class="filtrarCategoria" id="fltr'.$idCat.'"><a href="noticias.php?categoria='.$idCat.'">'.$txtCat.'</a></span>');
                    }

                    $categoria = 5;
                    $validacion = validarCredencial($_SESSION["id_tipo_usuario"] , $categoria);
                    
                    if($validacion)
                        echo('<span class="addNoticia"><a href="nuevaNoticia.php">Añadir noticia</a></span>');

                    echo('</div">');

                    $nRead->cerrarConexion();                    
                ?>
                </div>

                <div id="noticiasContenedor">
                    <?php
                        //Conectamos al SGDB
                        $nRead = new NoticiaRead();
                        $arrayNoticias = $nRead->selectNoticias(0,1, $filtroCatNoticia); //0-> Límite, 1->Orden Desc, 0->Sin filtro de categoría

                        //while($noticia=mysqli_fetch_assoc($arrayNoticias))
                        foreach ($arrayNoticias as $noticia) 
                        {
                           $idnoticia = $noticia['id_noticia'];
                           $titularNoticia = $noticia['titular_noticia'];
                           $textoNoticia = $noticia['texto_noticia'];
                           $idCategoriaNoticia = $noticia['id_categoria_noticia'];
                           $categoriaNoticia = $noticia['categoria_noticia'];
                           $idUsuario = $noticia['usuario'];
                           $fechaCreacion = $noticia['fecha_creacion'];
                           $numComentarios = $noticia['num_comentarios'];
                            

                            echo('<div class="articulo">');
                                echo('<div class="cabeceraArticulo" style = "visibility:visible">');
                                     echo('<div class="fecha">');
                                        echo('<div class="mes">'.substr(date("F", $fechaCreacion),0,3).'</div>');
                                        echo('<div class="dia">'.date("d", $fechaCreacion).'</div>');
                                        echo('<div class="anio">'.date("Y", $fechaCreacion).'</div>');
                                    echo('</div>');
                                    echo('<a id="noticia'.$idnoticia.'" href="verNoticia.php?t='.$idnoticia.'"><h3 class="tituloArticulo" >'.$titularNoticia.'</h3></a>');
                                echo('</div>');
                                echo('<div class="cuerpoArticulo" style = "visibility:visible">');
                                    echo('<div class="pintarBordesSup"></div>');
                                    echo('<p class="contenidoArticulo">'.$textoNoticia.'</p>');
                                    echo('<div class="pintarBordesInf"></div>');
                                    echo('<div class="contInfoArticulo"');
                                        echo('<span class="autorArticulo">Creado por: '.$idUsuario.'</span>');
                                        echo('<span class="separador">|</span>');
                                        echo('<span class="categoriaNoticia">Categoria: <a href="noticias.php?categoria='.$idCategoriaNoticia.'">'.$categoriaNoticia.'</a></span>');
                                        echo('<span class="separador">|</span>');
                                        echo('<span class="numComentarios">Comentarios: '.$numComentarios.'</span>');
                                    echo('</div>');
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