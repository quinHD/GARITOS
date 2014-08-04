<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Calles de Malasaña</title>
        
        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />       
        <link type="text/css" rel="stylesheet" href="css/principal.css"></link>
        <link type="text/css" rel="stylesheet" href="css/menu.css"></link>

        <script type="text/javascript" src="javascript/funciones.js"></script>
    </head>

    <body>
        <div id="contenedor">
            
            <?php
                require("cabeceraHTML.php");
            ?>

            <div id="contenido">
                <div id="bienvenidaContenedor">
                    <img id="imagenTitulo" alt="imagen título" src="img/titulo.png"/>
                    <div class="barraDivisoria"></div>

                    <p id="textoBienvenida">
                        Duis dictum, ante non volutpat malesuada, ipsum nisl euismod urna, vel blandit purus lacus et neque. Aliquam tincidunt consectetur nisl, iaculis ultricies lectus lacinia a. Nullam vitae consequat risus. Nullam vitae nisl ac nunc gravida venenatis non et lectus. Nam ac pulvinar eros. Mauris nec urna enim, in egestas odio. Nunc urna urna, interdum at cursus aliquam, iaculis at neque. Maecenas gravida tempus magna, quis sodales orci bibendum quis. In hac habitasse platea dictumst. Cras faucibus facilisis tortor, et cursus dolor faucibus nec. Donec molestie auctor justo, posuere dapibus mauris auctor et. Aliquam egestas mollis viverra.
                    </p>
                    <div id="sliderContenedor"> 
                        <a id="enlaceComercio" target="_blank" href="comercios.html#comercio1">
                            <img id="imagenComercio" src="img/fotoCiencias.jpg" alt"imagenes de comercios"></img>
                        </a>  
                        
                        <h2 id="nombreComercio">Comercio 1</h2>

                    </div>
                </div>
                
                <div id="novedadesContenedor">
                     <h2 id="novedadesTitulo" class="tituloSeccion">Novedades</h2>
                    <div id="ultimasNoticiasContenedor" class="contenedorColumna">
                        <h2 id="ultimasNoticiasTitulo" class="contenedorColumnaTitulo">Últimas Noticias</h2>
                        

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
                                  ORDER BY t_noticia.fecha_creacion DESC
                                  LIMIT 5'
                                ;

                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());                        

                        for ($i = 0; $i < 5; $i++) 
                        {
                            $valor=mysqli_fetch_assoc($select);

                            if($valor != null)
                            {
                                $idnoticia = $valor['id_noticia']; 
                                $titularNoticia = $valor['titular_noticia'];
                                $textoNoticia = $valor['texto_noticia'];
                                $idCategoriaNoticia = $valor['categoria_noticia'];
                                $idUsuario = $valor['usuario'];
                                $timestamp = $valor['fecha_creacion'];

                                $fechaCreacion = strtotime($timestamp);
                            }

                            if($i==0)
                                echo('<div class="ultimasNoticias primero">');
                            else
                            {
                                if($i==4)
                                    echo('<div class="ultimasNoticias ultimo">');
                                else
                                    echo('<div class="ultimasNoticias">');
                            }

                                echo('<h3 class="entradaNoticiaTitulo"><a href="noticias.php#noticia'.$idnoticia.'">'.$titularNoticia.'</a></h3>');
                                echo('<span class="subtituloEntradaNoticia">');
                                    echo('<img alt="icono fecha" src="img/icono_fecha.gif"/ title="Fecha de Publicación"/>');
                                    echo('<span>'.date("d", $fechaCreacion).'-'.substr(date("F", $fechaCreacion),0,3).'-'.date("Y", $fechaCreacion).'</span>');

                                    echo('<img alt="icono autor"src="img/icono_autor.gif"/ title="Autor de la noticia"/>');
                                    echo('<span>'.$idUsuario.'</span>');

                                    echo('<img alt="icono categoría"src="img/icono_categoria.gif"/ title="Categoría"/>');
                                    echo('<span>'.$idCategoriaNoticia.'</span>');
                                echo('</span>');
                            echo('</div>');

                        }

                        if (isset($iden)) 
                        {
                            mysqli_free_result($iden);
                        }
                    
                    ?>


                        
                    </div><!--ultimasNoticiasContenedor-->

                    <div id="ultimosMensajesForoContenedor" class="contenedorColumna">
                        <h2 id="ultimosMensajesForoTitulo" class="contenedorColumnaTitulo">Últimos Mensajes del Foro</h2>

                        <table id="tablaUltimosMensajesForo" summary="Meeting Results">
                            <thead>
                                <tr>
                                    <th>Mensaje</th>
                                    <th>Autor</th>
                                    <th>Respuestas</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="3">Lorem ipsum dolor sit amet, consectetur cras faucibus facilisis tortor</td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td class="mensaje"><a class="mensajeEnlace" href="#arriba">Mensaje informativo en el foro</a></td>
                                    <td class="autor">Usuario A</td>
                                    <td class="respuestas">15</td>
                                </tr>
                                <tr>
                                    <td class="mensaje"><a class="mensajeEnlace" href="#arriba">Mensaje de recomendación en el foro</a></td>
                                    <td class="autor">Usuario B</td>
                                    <td class="respuestas">240</td>
                                </tr>
                                <tr>
                                    <td class="mensaje"><a class="mensajeEnlace" href="#arriba">Mensaje de crítica en el foro</a></td>
                                    <td class="autor">Usuario C</td>
                                    <td class="respuestas">42</td>
                                </tr>
                                <tr>
                                    <td class="mensaje"><a class="mensajeEnlace" href="#arriba">Hilo sobre una promoción</a></td>
                                    <td class="autor">Usuario D</td>
                                    <td class="respuestas">97</td>
                                </tr>
                                <tr>
                                    <td class="mensaje"><a class="mensajeEnlace" href="#arriba">Mensaje de sugerencia en el foro</a></td>
                                    <td class="autor">Usuario E</td>
                                    <td class="respuestas">81</td>
                                </tr>
                                <tr>
                                    <td class="mensaje"><a class="mensajeEnlace" href="#arriba">Hilo de dudas</a></td>
                                    <td class="autor">Administrador</td>
                                    <td class="respuestas">44</td>
                                </tr>
                                <tr>
                                    <td class="mensaje"><a class="mensajeEnlace" href="#arriba">Hilo de bienvenida</a></td>
                                    <td class="autor">Administrador</td>
                                    <td class="respuestas">585</td>
                                </tr>                            
                                

                            </tbody>
                        </table>

                        
                    
                    </div><!--ultimosMensajesForoContenedor-->
                </div>

                <div id="contenidoCentral">
                    <h2 id="tituloContenidoCentral" class="tituloSeccion">Contenido</h2>
                    <p id="textoContenidoCentral">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tempus cursus neque a bibendum. Duis dictum, ante non volutpat malesuada, ipsum nisl euismod urna, vel blandit purus lacus et neque. Aliquam tincidunt consectetur nisl, iaculis ultricies lectus lacinia a. Nullam vitae consequat risus. Nullam vitae nisl ac nunc gravida venenatis non et lectus. Nam ac pulvinar eros. Mauris nec urna enim, in egestas odio. Nunc urna urna, interdum at cursus aliquam, iaculis at neque. Maecenas gravida tempus magna, quis sodales orci bibendum quis. In hac habitasse platea dictumst. Cras faucibus facilisis tortor, et cursus dolor faucibus nec. Donec molestie auctor justo, posuere dapibus mauris auctor et. Aliquam egestas mollis viverra.
                    </p>
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