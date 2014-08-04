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

        <script type="text/javascript">

            function objetoAjax()
            {
                var xmlhttp=  new XMLHttpRequest();
                return xmlhttp;
            }

            function enviarDatos()
            {
                var formElement = document.getElementById("formAltaComentario");

                resultado = document.getElementById("resultadoCarga");
                ajax = objetoAjax();
                ajax.open("POST", "guardarComentario.php", true);
                ajax.onreadystatechange = function()
                {
                    if(ajax.readyState == 4)
                    {
                        resultado.innerHTML = (ajax.responseText);
                        formElement.reset();
                    }
                }

                //ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                ajax.send(new FormData(formElement));
            }

        </script>
    </head>

    <body>
        <div id="contenedor">
           
            <?php
                include 'ChromePhp.php';
                require("cabeceraHTML.php");
                $idNoticiaGet = $_GET["idnoticia"];
                //Conectamos al SGDB     
                if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
                    die ("No se ha podido conectar");


                 $query = 'SELECT t_noticia.id_noticia, t_noticia.titular_noticia, t_noticia.texto_noticia,t_categoria_noticia.categoria_noticia, t_usuario.usuario, t_noticia.fecha_creacion
                          FROM t_noticia 
                          INNER JOIN t_categoria_noticia 
                            ON t_noticia.id_categoria_noticia=t_categoria_noticia.id_categoria_noticia 
                          INNER JOIN t_usuario 
                            ON t_noticia.id_usuario = t_usuario.id_usuario 
                          WHERE t_noticia.id_noticia='."$idNoticiaGet".'
                          ORDER BY t_noticia.fecha_creacion DESC;';
                   

                $select = mysqli_query($iden,$query) or die('Error'.mysql_error());


                while($valor=mysqli_fetch_assoc($select))
                {
                    $idNoticia = $idNoticiaGet;
                    $titularNoticia = $valor['titular_noticia'];
                    $textoNoticia = $valor['texto_noticia'];
                    $idCategoriaNoticia = $valor['categoria_noticia'];
                    $idUsuario = $valor['usuario'];
                    $timestamp = $valor['fecha_creacion'];

                    $fechaCreacion = strtotime($timestamp);


                }   
                if (isset($iden)) 
                {
                    mysqli_free_result($iden);
                }
            
        
            ?>

            <div id="contenido">
                <div id="noticiasContenedor">
                    <?php
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
                    ?>
                </div>

                <div id="comentariosContenedor">
                    <?php
                       
                        //Conectamos al SGDB     
                        if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
                            die ("No se ha podido conectar");


                         $query = 'SELECT t_comentario.id_comentario, t_comentario.comentario, t_comentario.fecha_creacion,t_usuario.usuario
                                  FROM t_comentario 
                                  INNER JOIN t_usuario 
                                    ON t_comentario.id_usuario=t_usuario.id_usuario
                                  WHERE t_comentario.id_noticia='."$idNoticiaGet".'
                                  ORDER BY t_comentario.fecha_creacion DESC;';
                           

                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

                        while($valor=mysqli_fetch_assoc($select))
                        {
                            $idComentario = $valor['id_comentario'];
                            $comentario = $valor['comentario'];
                            $idUsuario = $valor['usuario'];
                            $timestamp = $valor['fecha_creacion'];

                            $fechaCreacion = strtotime($timestamp);

                            echo('<div class="comentario">');
                                echo('<span class="autorComentario">Escrito por:'.$idUsuario.'</span>');
                                echo('<span class="autorComentario">Hora:'.$timestamp.'</span>');
                                echo('<p class="textoComentario">'.$comentario.'</p>');
                            echo('</div>');
                        }   
                        if (isset($iden)) 
                        {
                            mysqli_free_result($iden);
                        }
                    ?>

                </div>

                <div id="contenedorPrincipal">
                    <form id="formAltaComentario" name="formAltaComentario" method="post" action="" enctype="multipart/form-data" onSubmit="enviarDatos(); return false">
                        <?php
                        echo('<input name="noticia" type="hidden" id="noticiaField" size="50" value="'.$idNoticia.'" autocomplete="off"/>');
                        echo('<input name="usuario" type="hidden" id="usuarioField" size="50" value="'.$_SESSION['id_usuario'].'" autocomplete="off"/>');
                        ?>
                        <div class="camposFormulario"><label class="lblFormulario" for="comentarioField">Comentario: </label><textarea rows="5" cols="60" id ="comentarioField"  name ="comentario" form="formAltaComentario"></textarea></div>
                        <div id="botonera">
                            <div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>
                            <div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>
                        </div>   
                    </form>

                    <div id="contenedorResultado"><span id="resultadoCarga">Jejeje</span></div>
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