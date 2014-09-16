<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <?php
            require("headHTML.php");
        ?>
        <link type="text/css" rel="stylesheet" href="css/establecimientos.css"></link>
    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");
            ?>

            <div id="contenido">
                <h2 id="tituloContenedorEstablecimientos" class="tituloSeccion" >Establecimientos</h2>
                <?php
                    session_start();
                    $categoria = 5;
                    $validacion = validarCredencial($_SESSION["id_tipo_usuario"], $categoria);
                    if($validacion)
                        echo('<span><a href="nuevoEst.php">Añadir nuevo</a></span>');
                ?>
                <div id="establecimientosContenedor">
                    <?php

                        $eRead = new EstablecimientoRead();
                        //Conectamos al SGDB
                        $arrayEstablecimientos= $eRead->selectEstablecimientos();

                        foreach ($arrayEstablecimientos as $establecimiento) 
                        {
                            $id = $establecimiento['id_establecimiento']; 
                            $nombre = $establecimiento['nombre']; 
                            $direccion = $establecimiento['direccion']; 
                            $horario = $establecimiento['horario']; 
                            $telefono = $establecimiento['telefono']; 
                            $nota = $establecimiento['nota'];
                            $categoria = $establecimiento['categoria'];
                            $caracteristicas = $establecimiento['caracteristicas']; 
                            $imagen = $establecimiento['imagen'];
                            $creado = $establecimiento['creado']; 
                            $comentario = $establecimiento['comentario']; 
              

                            echo ('<div class="establecimiento">');

                            if(@getimagesize($imagen))//Hay imagen: La mostramos
                                echo ('<div class="contApartado" id="aptdoImagen"><a href="verEstablecimiento.php?id='.$id.'"><img src="'.$imagen.'" class="imagenCabecera"></img></a></div>');
                            else
                                echo ('<div class="contApartado" id="aptdoImagen"><a href="verEstablecimiento.php?id='.$id.'"><img src="imgs/_NO_DISPONIBLE.jpg" class="imagenCabecera"></img></a></div>');
                            echo ('<div class="contApartado" id="aptdoNombre"><label class="lblApartado" for="nombre">Nombre: </label><span class="apartado name="nombre">'.$nombre.'</span></div>');
                            echo ('<div class="contApartado" id="aptdoDireccion"><label class="lblApartado" for="direccion">Dirección: </label><span class="apartado name="direccion">'.$direccion.'</span></div>');
                            echo ('<div class="contApartado" id="aptdoHorario"><label class="lblApartado" for="horario">Horario: </label><span class="apartado name="horario">'.$horario.'</span></div>');
                            echo ('<div class="contApartado" id="aptdoTelefono"><label class="lblApartado" for="telefono">Teléfono: </label><span class="apartado name="telefono">'.$telefono.'</span></div>');
                            echo ('<div class="contApartado" id="aptdoNota"><label class="lblApartado" for="nota">Nota: </label><span class="apartado name="nota">'.$nota.'</span></div>');
                            echo ('<div class="contHidden" id="contHidden">');
                            echo ('<div class="contApartado" id="aptdoCategoria"><label class="lblApartado" for="categoria">Categoría: </label>');
                            $listaCategorias = explode(",",$categoria);
                            foreach ($listaCategorias as $ctgr) 
                            {
                                echo ('<span class="apartado categoria" name="categoria">'.trim($ctgr).'</span>');  
                            }
                            echo('</div>');
                            echo ('<div class="contApartado" id="aptdoCaracteristicas"><label class="lblApartado" for="caracteristicas">Características: </label>');
                            $listaCaracteristicas = explode(",",$caracteristicas);
                            foreach ($listaCaracteristicas as $crtrstc) 
                            {
                                echo ('<span class="apartado caracteristica" name="caracteristicas">'.trim($crtrstc).'</span>');    
                            }
                            echo('</div>');
                            echo ('<div class="contApartado" id="aptdoApartado"><label class="lblApartado" for="comentario"></label><span class="apartado name="comentario">'.$comentario.'</span></div>');
                            echo ('</div>');
                            echo ('</div>');
                        }

                        $eRead->cerrarConexion();
                    
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