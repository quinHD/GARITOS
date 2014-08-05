<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Comerciantes Segovianos Unidos</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
        <?php
            require("funcionesValidacion.php");
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
                require("apiAdminUsuarios.php");
            ?>

            <div id="contenido" >
                <div id="adminNoticiasContenedor" class="tituloSeccion">
                    <?php
                        //Conectamos al SGDB
                        
                        if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
                            die ("No se ha podido conectar");

                        $query = 'SELECT t_noticia.id_noticia, t_noticia.titular_noticia, t_noticia.texto_noticia,t_categoria_noticia.categoria_noticia, t_usuario.usuario, t_noticia.fecha_creacion
                                  FROM t_noticia 
                                  INNER JOIN t_categoria_noticia 
                                    ON t_noticia.id_categoria_noticia=t_categoria_noticia.id_categoria_noticia 
                                  INNER JOIN t_usuario 
                                    ON t_noticia.id_usuario = t_usuario.id_usuario 
                                  ORDER BY t_noticia.id_noticia'
                                ;

                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

                        echo('<table>');
                        echo('<tr>');
                            echo('<td>ID</td>');
                            echo('<td>TITULAR</td>');
                            echo('<td>CATEGORÍA</td>');
                            echo('<td>USUARIO</td>');
                            echo('<td>CREADO</td>');
                        echo('</tr>');
                        while($valor=mysqli_fetch_assoc($select))
                        {

                            $idnoticia = $valor['id_noticia']; 
                            $titularNoticia = $valor['titular_noticia'];
                            $idCategoriaNoticia = $valor['categoria_noticia'];
                            $idUsuario = $valor['usuario'];

                            echo('<tr>');
                                echo('<td><span>'.$idnoticia.'</span></td>');
                                echo('<td><span>'.$titularNoticia.'</span></td>');
                                echo('<td><span>'.$idCategoriaNoticia.'</span></td>');
                                echo('<td><span>'.$idUsuario.'</span></td>');
                                echo('<td><span><input type="checkbox" name="usuarioSeleccionado" value="'.$id.'"></span></td>');
                            echo('</tr>');

                        }
                        echo('<br/>');
                        echo('</table>');

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