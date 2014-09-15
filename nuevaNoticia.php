<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <?php
            require("headHTML.php");

            session_start();
            if($_SESSION["id_tipo_usuario"] <2)
                header("location:index.php");
        ?>


         <script type="text/javascript">

              
            function objetoAjax()
            {
                var xmlhttp=  new XMLHttpRequest();
                return xmlhttp;
            }

            function enviarDatos()
            {
                var formElement = document.getElementById("formAltaNoticia");

                resultado = document.getElementById("resultadoCarga");
                ajax = objetoAjax();
                ajax.open("POST", "NoticiaCreate.php", true);
                ajax.onreadystatechange = function()
                {
                    if(ajax.readyState == 4)
                    {
                        resultado.innerHTML = (ajax.responseText);
                        formElement.reset();
                        document.getElementById("titularField").focus();
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
            ?>
            
            <div id="contenido">
                <div id="bienvenidaContenedor">
                    <div id="contenedorPrincipal">
                        <form id="formAltaNoticia" name="formAltaNoticia" method="post" action="" enctype="multipart/form-data" onSubmit="enviarDatos(); return false">
                            <div class="camposFormulario"><label class="lblFormulario" for="titularField">Titular: </label><input name="titular" type="text" id="titularField" size="50" autocomplete="off"/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="categoriaField">Categoría: </label>
                                <select name="categoria" id="categoriaField" form="formAltaNoticia">
                                    <?php
                                        //Conectamos al SGDB
                                        $iden = ConexionDAO::conectarBD();

                                        $query = 'SELECT id_categoria_noticia, categoria_noticia FROM t_categoria_noticia ORDER BY id_categoria_noticia';

                                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

                                        while($valor=mysqli_fetch_assoc($select))
                                        {
                                            echo('<option value="'.$valor['id_categoria_noticia'].'">'.$valor['categoria_noticia'].'</option>');
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="camposFormulario"><label class="lblFormulario" for="noticiaField">Noticia: </label><textarea rows="5" cols="60" id ="noticiaField"  name ="noticia" form="formAltaNoticia"></textarea></div>
                            <?php
                                echo('<input name="usuario" type="hidden" id="usuarioField" size="50" value="'.$_SESSION['id_usuario'].'" autocomplete="off"/>');
                            ?>
                            <div id="botonera">
                            <div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>
                            <div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>
                            </div>
                            
                        </form>

                        <div id="contenedorResultado"><span id="resultadoCarga">Jejeje</span></div>
                    </div>
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