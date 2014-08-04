<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Comerciantes Segovianos Unidos</title>
         <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
           <?php
                session_start();
                if(!isset($_SESSION["id_tipo_usuario"] )||$_SESSION["id_tipo_usuario"] <3)
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
                <div id="adminUsuarioContenedor" class="tituloSeccion">
                    <?php
                        //Conectamos al SGDB
                        
                        if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
                            die ("No se ha podido conectar");

                        $query = 'SELECT t_usuario.id_usuario, t_usuario.usuario, t_tipo_usuario.tipo_usuario
                                  FROM t_usuario 
                                  INNER JOIN t_tipo_usuario
                                    ON t_usuario.id_tipo_usuario = t_tipo_usuario.id_tipo_usuario
                                  ORDER BY id_usuario;';

                        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());

                        echo('<table>');
                        echo('<tr>');
                            echo('<td>ID</td>');
                            echo('<td>USUARIO</td>');
                            echo('<td>TIPO_USUARIO</td>');
                            echo('<td>SEL</td>');
                        echo('</tr>');
                        while($valor=mysqli_fetch_assoc($select))
                        {
                            $id = $valor['id_usuario']; 
                            $usuario = $valor['usuario'];
                            $tipo_usuario = $valor['tipo_usuario'];

                            echo('<tr>');
                                echo('<td><span>'.$id.'</span></td>');
                                echo('<td><span>'.$usuario.'</span></td>');
                                echo('<td><span>'.$tipo_usuario.'</span></td>');
                                echo('<td><span><input type="checkbox" name="usuarioSeleccionado" value'.$id.'></span></td>');
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