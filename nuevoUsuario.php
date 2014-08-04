<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Comerciantes Segovianos Unidos</title>
         <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
        <?php
            session_start();
            if($_SESSION["id_tipo_usuario"] >1)
                header("location:index.php");
        ?>
        
        <link type="text/css" rel="stylesheet" href="css/principal.css"></link>
        <link type="text/css" rel="stylesheet" href="css/menu.css"></link>
        <link type="text/css" rel="stylesheet" href="css/subida.css"></link>

        <script type="text/javascript" src="javascript/funciones.js"></script>

         <script type="text/javascript">

              
            function objetoAjax()
            {
                var xmlhttp=  new XMLHttpRequest();
                return xmlhttp;
            }

            function enviarDatos()
            {
                var formElement = document.getElementById("formAltaUsuario");

                resultado = document.getElementById("resultadoCarga");
                ajax = objetoAjax();
                ajax.open("POST", "guardarUsuario.php", true);
                ajax.onreadystatechange = function()
                {
                    if(ajax.readyState == 4)
                    {
                        resultado.innerHTML = (ajax.responseText);
                        formElement.reset();
                        document.getElementById("usuarioField").focus();
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
                        <form id="formAltaUsuario" name="formAltaUsuario" method="post" action="" enctype="multipart/form-data" onSubmit="enviarDatos(); return false">
                            <div class="camposFormulario"><label class="lblFormulario" for="nombreField">Usuario: </label><input name="usuario" type="text" id="usuarioField" size="50" autocomplete="off"/></div>
                            <div class="camposFormulario"><label class="lblFormulario" for="passwordField">Password: </label><input name="password" type="password" id="passwordField" size="50" autocomplete="off"/></div>
                            <div id="botonera">
                            <div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>
                            <div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>
                            </div>
                            
                        </form>

                        <div id="contenedorResultado"><span id="resultadoCarga">Jejeje</span></div>
                    </div>
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