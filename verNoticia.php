
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <?php
            require("headHTML.php");
            $categoria_crear_comentario = 7;
        ?>
        <link type="text/css" rel="stylesheet" href="css/verNoticias.css"></link>

        <script type="text/javascript">

            function objetoAjax()
            {
                var xmlhttp=  new XMLHttpRequest();
                return xmlhttp;
            }

            function enviarDatos()
            {
                var formElement = document.getElementById("formAltaComentario");

                ajax = objetoAjax();
                ajax.open("POST", "guardarComentario.php", true);
                ajax.onreadystatechange = function()
                {
                    if(ajax.readyState == 4)
                    {
                        //resultado.innerHTML = (ajax.responseText);
                        location.reload();
                        //formElement.reset();
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
                require("cabeceraHTML.php");

				$idNoticia = $_GET['t'];

				if($idNoticia>0)
				{
                    //Conectamos al SGDB
                    $nRead = new NoticiaRead();
                    $arrayNoticias = $nRead->selectNoticia($idNoticia);

                    //$idNoticia echo('<span><a href="noticias.php?categoria='.$idCategoriaNoticia.'">'.$categoriaNoticia.'</a></span>');
                    $titularNoticia = $arrayNoticias['titular_noticia'];
                    $textoNoticia = $arrayNoticias['texto_noticia'];
                    $idCategoriaNoticia = $arrayNoticias['id_categoria_noticia'];
                    $categoriaNoticia = $arrayNoticias['categoria_noticia'];
                    $idUsuario = $arrayNoticias['usuario'];
                    $timestamp = $arrayNoticias['fecha_creacion'];

                    $fechaCreacion = $timestamp;
	                  
                    $nRead->cerrarConexion();  
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
                            echo('<h3 class="tituloArticulo" >'.$titularNoticia.'</h3>');
                            echo('<div class="cuerpoArticulo" style = "visibility:visible">');
                                echo('<div class="pintarBordesSup"></div>');
                                echo('<p class="contenidoArticulo">'.$textoNoticia.'</p>');
                                echo('<div class="pintarBordesInf"></div>');
                                echo('<div class="contInfoArticulo"');
                                        echo('<span class="autorArticulo">Creado por: '.$idUsuario.'</span>');
                                        echo('<span class="separador">|</span>');
                                        echo('<span class="categoriaNoticia">Categoria: <a href="noticias.php?categoria='.$idCategoriaNoticia.'">'.$categoriaNoticia.'</a></span>');
                                echo('</div>');
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
                                  WHERE t_comentario.id_noticia='."$idNoticia".'
                                  ORDER BY t_comentario.fecha_creacion DESC;';
                           

                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

                        while($valor=mysqli_fetch_assoc($select))
                        {
                            $idComentario = $valor['id_comentario'];
                            $comentario = $valor['comentario'];
                            $usuario = $valor['usuario'];
                            $timestamp = $valor['fecha_creacion'];

                            $fechaCreacion = strtotime($timestamp);

                            echo('<div id="comments" name="comments" class="comentario">');
                                echo('<span class="autorComentario">'.$usuario.' dice:</span>');
                                echo('<div class="contComentario"> ');
                                    echo('<p class="textoComentario">'.$comentario.'</p>');
                                    echo('<span class="horaComentario">'.$timestamp.'</span>');                                
                                    //Validamos credencial para ver si se trata de admin o si es el autor del comentario, ya que el mensaje solo se podrá borrar si es uno de ellos
                                    $cat = 1;
                                    if(($usuario == $_SESSION["usuario"])||validarCredencial($_SESSION["id_tipo_usuario"], $cat))
                                        echo('<span class="eliminarComentario"><a href="borrarComentario.php?id='.$idComentario.'">Eliminar</a></span>');

                                echo('</div>');

                            echo('</div>');
                        }   
                        if (isset($iden)) 
                        {
                            mysqli_free_result($iden);
                        }
                    ?>

                </div>

                <?php

                $validacion = validarCredencial($_SESSION["id_tipo_usuario"], $categoria_crear_comentario);
                if($validacion)
                {
                    echo('<div id="contenedorAltaComentario">');
                        echo('<form id="formAltaComentario" name="formAltaComentario" method="post" action="" enctype="multipart/form-data" onSubmit="enviarDatos(); return false">');
                            
                            echo('<input name="noticia" type="hidden" id="noticiaField" size="50" value="'.$idNoticia.'" autocomplete="off"/>');
                            echo('<input name="usuario" type="hidden" id="usuarioField" size="50" value="'.$_SESSION['id_usuario'].'" autocomplete="off"/>');
                         
                            echo('<div class="camposFormulario">');
                            echo('<label id="tituloFormComentario" class="lblFormulario" for="comentarioField">Añadir comentario</label>
                                    <textarea  rows="5" cols="50" id ="comentarioField"name="comentario" form="formAltaComentario"></textarea>');
                                echo('<div id="botonera">');
                                    echo('<div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>');
                                    echo('<div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>');
                                echo('</div>');
                            echo('</div>');
                        echo('</form>');
                    echo('</div>');
                }
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
