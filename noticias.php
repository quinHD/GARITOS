<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Comerciantes Segovianos Unidos</title>
         <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
        
        <link type="text/css" rel="stylesheet" href="css/principal.css"></link>
        <link type="text/css" rel="stylesheet" href="css/menu.css"></link>
        <link type="text/css" rel="stylesheet" href="css/establecimientos.css"></link>
        <script type="text/javascript" src="javascript/funciones.js"></script>
    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");
            ?>

            <div id="contenido">
                <h2 id="tituloContenedorEstablecimientos" class="tituloSeccion" >Noticias</h2>
                <?php
                    if(($_SESSION["id_tipo_usuario"]>=3)&&(isset($_SESSION["id_tipo_usuario"])))
                    {
                        echo('<span><a href="nuevaNoticia.php">Añadir noticia</a></span>');
                    }
                ?>
                <div id="noticiasContenedor">
                    <?php
                        //Conectamos al SGDB
                        
                        if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
                            die ("No se ha podido conectar");

                        $query = 'SELECT t_noticia.id_noticia, t_noticia.titular_noticia, t_noticia.texto_noticia,t_categoria_noticia.categoria_noticia, t_usuario.usuario, t_noticia.fecha_creacion
                                  FROM t_noticia 
                                  INNER JOIN t_categoria_noticia 
                                    ON t_noticia.id_categoria_noticia=t_categoria_noticia.id_categoria_noticia 
                                  INNER JOIN t_usuario 
                                    ON t_noticia.id_usuario = t_usuario.id_usuario 
                                  ORDER BY t_noticia.fecha_creacion DESC'
                                ;

                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());
                        while($valor=mysqli_fetch_assoc($select))
                        {
                            $idnoticia = $valor['id_noticia']; 
                            $titularNoticia = $valor['titular_noticia'];
                            $textoNoticia = $valor['texto_noticia'];
                            $idCategoriaNoticia = $valor['categoria_noticia'];
                            $idUsuario = $valor['usuario'];
                            $timestamp = $valor['fecha_creacion'];

                            $fechaCreacion = strtotime($timestamp);

                            echo('<div class="articulo">');
                                 echo('<div class="fecha">');
                                    echo('<div class="mes">'.substr(date("F", $fechaCreacion),0,3).'</div>');
                                    echo('<div class="dia">'.date("d", $fechaCreacion).'</div>');
                                    echo('<div class="anio">'.date("Y", $fechaCreacion).'</div>');
                                echo('</div>');
                                echo('<a id="noticia'.$idnoticia.'" href="noticia'.$idnoticia.'.php?idnoticia='.$idnoticia.'"><h3 class="tituloArticulo" >'.$titularNoticia.'</h3></a>');
                                echo('<div class="cuerpoArticulo" style = "visibility:visible">');
                                    echo('<p class="contenidoArticulo">'.$textoNoticia.'</p>');
                                    echo('<span class="autorArticulo">'.$idUsuario.'</span>');
                                    echo('<span class="categoriaNoticia">'.$idCategoriaNoticia.'</span>');
                                echo('</div>');
                            echo('</div>');
                        }

                        if (isset($iden)) 
                        {
                            mysqli_free_result($iden);
                        }
                    
                    ?>
                </div>

                <div id="banners" class="tituloSeccion">
                    <h2 id="tituloBanners">Anunciantes</h2>
                    <div id="imagenesBanners">
                        <a href="http://www.google.es"><img src="img/banner1.jpg" title="banner1"></a>
                        <a href="http://www.google.es"><img src="img/banner2.jpg" title="banner2"></a>
                        <a href="http://www.google.es"><img src="img/banner3.jpg" title="banner3"></a>
                        <a href="http://www.google.es"><img src="img/banner1.jpg" title="banner5"></a>
                        <a href="http://www.google.es"><img src="img/banner2.jpg" title="banner4"></a>
                    </div>    
                </div>

               
            </div><!--Fin contenido -->

            <?php
                require("pieHTML.php");
            ?>
        </div><!--Fin Contenedor -->
    </body>

</html>