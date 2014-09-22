
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <?php
            require("headHTML.php");
            $categoria_crear_comentario = 5;
        ?>

    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");

				$idEstablecimiento= $_GET['id'];

                if($idEstablecimiento>0)
                {
                    //Conectamos al SGDB
                    $eRead = new EstablecimientoRead();
                    $arrayEstablecimientos = $eRead->selectEstablecimientoUpdate($idEstablecimiento);

                    //$idEstablecimiento
                    //$id = $valor['id_establecimiento']; 
                    if(sizeof($arrayEstablecimientos) > 0)
                    {
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
                    }

                    $eRead->cerrarConexion();  
                }
            ?>

            <div id="contenido">
                <?php
                    echo ('<div class="establecimiento">');
                    if(sizeof($arrayEstablecimientos)>0)
                    {
                        if(@getimagesize($imagen))//Hay imagen: La mostramos
                            echo ('<div class="contApartado" id="aptdoImagen"><a href="verEstablecimiento.php?id='.$id.'"><img src="'.$imagen.'" class="imagenCabecera"></img></a></div>');
                        else
                            echo ('<div class="contApartado" id="aptdoImagen"><a href="verEstablecimiento.php?id='.$id.'"><img src="imgs/_NO_DISPONIBLE.jpg" class="imagenCabecera"></img></a></div>');
                        echo ('<div class="contApartado" id="aptdoNombre"><label class="lblApartado" for="nombre">Nombre: </label><span class="apartado name="nombre">'.$nombre.'</span></div>');
                        echo ('<div class="contApartado" id="aptdoDireccion"><label class="lblApartado" for="direccion">Dirección: </label><span class="apartado name="direccion">'.$direccion.'</span></div>');
                        echo ('<div class="contApartado" id="aptdoHorario"><label class="lblApartado" for="horario">Horario: </label><span class="apartado name="horario">'.$horario.'</span></div>');
                        echo ('<div class="contApartado" id="aptdoTelefono"><label class="lblApartado" for="telefono">Teléfono: </label><span class="apartado name="telefono">'.$telefono.'</span></div>');
                        echo ('<div class="contApartado" id="aptdoNota"><label class="lblApartado" for="nota">Nota: </label><span class="apartado name="nota">'.$nota.'</span></div>');
                        echo ('<div class="contApartado" id="aptdoCreado"><label class="lblCreado" for="creado">Añadido el: </label><span class="apartado name="creado">'.date($creado).'</span></div>');

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
                        echo ('<div class="contApartado" id="aptdoApartado"><label class="lblApartado" for="comentario">Comentario: </label><span class="apartado name="comentario">'.$comentario.'</span></div>');
                    }
                    else
                    {
                        echo ('<div class="contApartado" id="aptdoImagen">Establecimiento no encontrado</div>');    
                    }
                    echo ('</div>');
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
