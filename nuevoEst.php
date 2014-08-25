<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
       
        <?php
            require("headHTML.php");
        ?>
        <?php            
            session_start();
            $categoria = 5;
            $validacion = validarCredencial($_SESSION["id_tipo_usuario"], $categoria);
            if(!$validacion)
                header("location:index.php");
        ?>


        <script type="text/javascript">
            function calculoNota(){
                var notaAux;
                notaAux = document.getElementById("notaField").value;
                notaAux = notaAux*2;
                notaAux = Math.round(notaAux);
                notaAux =  notaAux/2;
                document.getElementById("notaField").value = notaAux;

            }
    
            function objetoAjax()
            {
                var xmlhttp=  new XMLHttpRequest();
                return xmlhttp;
            }

            function enviarDatos()
            {
                var formElement = document.getElementById("formAltaEstablecimiento");

                resultado = document.getElementById("resultadoCarga");
                ajax = objetoAjax();
                ajax.open("POST", "EstablecimientoCreate.php", true);
                ajax.onreadystatechange = function()
                {
                    if(ajax.readyState == 4)
                    {
                        resultado.innerHTML = (ajax.responseText);
                        formElement.reset();
                        document.getElementById("nombreField").focus();
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
                        <form id="formAltaEstablecimiento" name="formAltaEstablecimiento" method="post" action="" enctype="multipart/form-data" onSubmit="enviarDatos(); return false">
                            <div class="camposFormulario"><label class="lblFormulario" for="nombreField">Nombre: </label><input name="nombre" type="text" id="nombreField" size="50" autocomplete="off"/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="direccionField">Dirección: </label><input name="direccion" type="text" id="direccionField" size="50" autocomplete="off"/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="horarioField">Horario: </label><input name="horario" type="text" id="horarioField" size="20" autocomplete="off"/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="telefonoField">Teléfono: </label><input name="telefono" type="text" id="telefonoField" size="9" autocomplete="off"/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="notaField">Nota: </label><input name="nota" type="text" id="notaField" size="5" autocomplete="off" onblur='calculoNota()'/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="categoriaField">Categoría: </label><input name="categoria" type="text" id="categoriaField" size="50" autocomplete="off" /></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="caractField">Características: </label><input name="caracteristicas" type="text" id="caractField" size="50" autocomplete="off"/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="comentarioField">Comentario: </label><textarea rows="5" cols="60" id ="comentarioField"  name ="comentario" form="formAltaEstablecimiento"></textarea></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="imgField">Imagen: </label><input class="botonImagen" name="imagen" type="file" id="imgField" /></div>
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