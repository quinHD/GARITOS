<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Comerciantes Segovianos Unidos</title>
         <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
           <?php
                require("headHTML.php");
                session_start();

                $categoria = 1;
                $validacion = validarCredencial($_SESSION["id_tipo_usuario"], $categoria);
                if(!$validacion)
                    header("location:index.php");

            ?>
        
        <link type="text/css" rel="stylesheet" href="css/principal.css"></link>
        <link type="text/css" rel="stylesheet" href="css/menu.css"></link>
        <link type="text/css" rel="stylesheet" href="css/establecimientos.css"></link>
        <script type="text/javascript" src="javascript/funciones.js"></script>
    </head>

    <body>
        <div id="contenedor">
           
            <?php
                require("cabeceraHTML.php");
            ?>

            <div id="contenido" >
                <div id="adminUsuarioContenedor" class="tituloSeccion">
                    <?php
                        //Conectamos al SGDB
                        
                        $eRead = new EstablecimientoRead();
                        //Conectamos al SGDB
                        $arrayEstablecimientos= $eRead->selectEstablecimientos();

                        echo('<table style="font-size:10px">');
                        echo('<tr>');
                            echo('<td>ID</td>');
                            echo('<td>NOMBRE</td>');
                            echo('<td>DIRECCION</td>');
                            echo('<td>HORARIO</td>');
                            echo('<td>TELEFONO</td>');
                            echo('<td>NOTA</td>');
                            echo('<td>CATEGORIA</td>');
                            echo('<td>CARACTERÍSTICAS</td>');
                            echo('<td>IMAGEN</td>');
                            echo('<td>CREADO</td>');
                            echo('<td>COMENTARIO</td>');
                            echo('<td>EDICIÓN</td>');
                            echo('<td>SEL</td>');
                        echo('</tr>');
                        

                        foreach ($arrayEstablecimientos as $valor) 
                        {

                            $id = $valor['id_establecimiento']; 
                            $nombre = $valor['nombre'];
                            $direccion = $valor['direccion'];
                            $horario = $valor['horario'];
                            $telefono = $valor['telefono'];
                            $nota = $valor['nota'];
                            $categoria = $valor['categoria'];
                            $caracteristicas = $valor['caracteristicas'];
                            $imagen = $valor['imagen'];
                            $creado = $valor['creado'];
                            $comentario = $valor['comentario'];


                                echo('<tr>');
                                echo('<td><span>'.$id.'</span></td>');
                                echo('<td><span>'.$nombre.'</span></td>');
                                echo('<td><span>'.$direccion.'</span></td>');
                                echo('<td><span>'.$horario.'</span></td>');
                                echo('<td><span>'.$telefono.'</span></td>');
                                echo('<td><span>'.$nota.'</span></td>');
                                echo('<td><span>'.$categoria.'</span></td>');
                                echo('<td><span>'.$caracteristicas.'</span></td>');
                                if(@getimagesize($imagen))
                                    echo('<td><span>SI</span></td>');
                                else
                                    echo('<td><span>NO</span></td>');
                                echo('<td><span>'.$creado.'</span></td>');
                                if(strlen($comentario)>0)
                                    echo('<td title="'.$comentario.'"><span>SI</span></td>');
                                else
                                    echo('<td><span>NO</span></td>');
                                echo('<td><span><a href="editarEstablecimiento.php?t='.$id.'">Editar</a></span></td>');
                                echo('<td><span><input type="checkbox"  form="formBajaEstablecimiento" name="establecimientoSeleccionado[]" value="'.$id.'"></span></td>');
                            echo('</tr>');
                        }

                        echo('<br/>');
                        echo('</table>');

                        echo('<form id="formBajaEstablecimiento" name="formBajaEstablecimiento" method="post" action="EstablecimientoDelete.php" >');
                            echo('<div class="botonesFormulario"><input class="boton" type="submit" name="button" id="buttonEnviar" value="Eliminar"/></div>');
                        echo('</form>');

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