<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Comerciantes Segovianos Unidos</title>
         <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
        <?php
            session_start();
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

            <div id="contenido">
                <div id="establecimientosContenedor">
                    <?php
                        //Conectamos al SGDB
                        
                        if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
                            die ("No se ha podido conectar");

                        $query = 'SELECT * FROM t_establecimiento ORDER BY id_establecimiento';

                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());
                        $raizImagenes = "imgs/";

                        while($valor=mysqli_fetch_assoc($select))
                        {

                            $id = $valor['id_establecimiento']; 
                            $nombre = $valor['nombre'];
                            $direccion = $valor['direccion'];
                            $horario = $valor['horario'];
                            $telefono = $valor['telefono'];
                            $nota = $valor['nota'];
                            $categoria = $valor['categoria'];
                            $caracteristicas = $valor['caracteristicas'];
                            $imagen = $raizImagenes.$valor['imagen'];
                            $creado = $valor['creado'];
                            $comentario = $valor['comentario'];

                            echo ('<div class="establecimiento">');
                            echo ('<div class="contApartado" id="aptdoImagen"><img src="'.$imagen.'" class="imagenCabecera"></img></div>');
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

                        if (isset($iden)) 
                        {
                            mysqli_free_result($iden);
                        }
                    
                    ?>
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