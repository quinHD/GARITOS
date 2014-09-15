
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <?php
            require("headHTML.php");
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
        </script>

    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");

                $idEstablecimiento = $_GET['t'];

                if($idEstablecimiento>0)
                {
                    //Conectamos al SGDB
                    $eRead = new EstablecimientoRead();
                    $arrayEstablecimientos = $eRead->selectEstablecimientoUpdate($idEstablecimiento);

                    //$idEstablecimiento
                    //$id = $valor['id_establecimiento']; 
                    $nombre = $arrayEstablecimientos['nombre'];
                    $direccion = $arrayEstablecimientos['direccion'];
                    $horario = $arrayEstablecimientos['horario'];
                    $telefono = $arrayEstablecimientos['telefono'];
                    $nota = $arrayEstablecimientos['nota'];
                    $categoria = $arrayEstablecimientos['categoria'];
                    $caracteristicas = $arrayEstablecimientos['caracteristicas'];
                    $imagen = $arrayEstablecimientos['imagen'];
                    $creado = $arrayEstablecimientos['creado'];
                    $comentario = $arrayEstablecimientos['comentario'];

                    $eRead->cerrarConexion();  
                }
            ?>

            <div id="contenido">
                <?php
                    echo('<div id="noticiaContenedor">');                  
                        echo('<form id="formEdicionEstablecimiento" name="formEdicionEstablecimiento" method="post" action="EstablecimientoUpdate.php" enctype="multipart/form-data">');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="idField">Id: </label><input readonly name="idEstablecimiento" type="text" id="idEstablecimiento" size="50" autocomplete="off" value="'.$idEstablecimiento.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="nombreEstablecimiento">Nombre: </label><input name="nombre" type="text" id="nombreEstablecimiento" size="50" autocomplete="off" value="'.$nombre.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="">Dirección: </label><input name="direccion" type="text" id="direccion" size="50" autocomplete="off" value="'.$direccion.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="horario">Horario: </label><input name="horario" type="text" id="horario" size="50" autocomplete="off" value="'.$horario.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="telefonoEstablecimiento">Teléfono: </label><input name="telefono" type="text" id="telefonoEstablecimiento" size="50" autocomplete="off" value="'.$telefono.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="notaField">Nota: </label><input name="nota" type="text" id="notaField" size="50" autocomplete="off" onblur="calculoNota();" value="'.$nota.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="categoria">Categoria: </label><input name="categoria" type="text" id="categoria" size="50" autocomplete="off" value="'.$categoria.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="caracteristicas">Características: </label><input name="caracteristicas" type="text" id="caracteristicas" size="50" autocomplete="off" value="'.$caracteristicas.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="creado">Creado: </label><input name="creado" type="text" id="creado" size="50" autocomplete="off" value="'.$creado.'"/></div>');
                            echo('<div class="camposFormulario"><label class="lblFormulario" for="creado">Comentario: </label><textarea rows="5" cols="60" form="formEdicionEstablecimiento" name="comentario" type="text" id="creado" size="50" >'.$comentario.'</textarea></div>');

                            
                            echo('<div id="botonera">');
                            echo('<div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Enviar"/></div>');
                            echo('<div class="botonesFormulario"><input class="boton" type="reset" name="reestablecer" id="buttonReestablecer" value="Reset"/></div>');
                            echo('</div>');
                        echo('</form>');
                    echo('</div>');
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
