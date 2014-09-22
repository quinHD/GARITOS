<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <?php
  
            require("headHTML.php");
        ?>
        <script type="text/javascript">

            function objetoAjax()
            {
                var xmlhttp=  new XMLHttpRequest();
                return xmlhttp;
            }

            function enviarDatos()
            {
                var formElement = document.getElementById("formEnvioCorreo");

                resultado = document.getElementById("resultadoCarga");

                ajax = objetoAjax();
                ajax.open("POST", "enviarCorreo.php", true);
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
                require("cabeceraHTML.php");
            ?>

            <div id="contenido">
                <form name="formEnvioCorreo" id="formEnvioCorreo" method="post" action="" enctype="multipart/form-data" onSubmit="enviarDatos(); return false">
                    <input name="usuario" type="hidden" id="usuarioField" size="50" value="'.$_SESSION['usuario'].'" autocomplete="off"/>
                 
                    <div class="camposFormulario"><label class="lblFormulario" for="comentarioField">Mensaje: </label><textarea rows="5" cols="40" id ="mensajeField"  name ="mensaje" form="formEnvioCorreo"></textarea></div>
                    <div id="botonera">
                        <div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>
                        <div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>
                    </div>
                </form>

                <div id="contenedorResultado"><span id="resultadoCarga">Jejeje</span></div>

                </form>

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