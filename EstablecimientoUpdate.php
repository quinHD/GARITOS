<?php
    require("ConexionDAO.php");
    
    if(isset($_POST['idEstablecimiento']))
    {
        updateEstablecimiento();
    }

    function updateEstablecimiento()
    {
        $idEstablecimiento = $_POST['idEstablecimiento'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $horario = $_POST['horario'];
        $telefono = $_POST['telefono'];
        $nota = $_POST['nota'];
        $categoria = $_POST['categoria'];
        $caracteristicas = $_POST['caracteristicas'];
        $imagen = $_POST['imagen'];
        $creado = $_POST['creado'];
        $comentario = $_POST['comentario'];


        $iden = ConexionDAO::conectarBD();
        $query = 'UPDATE t_establecimiento
                  SET id_establecimiento="'.$idEstablecimiento.'", nombre="'.$nombre.'", direccion="'.$direccion.'", horario="'.$horario.'", telefono="'.$telefono.'", nota="'.$nota.'", categoria="'.$categoria.'", caracteristicas="'.$caracteristicas.'", comentario="'.$comentario.'"
                  WHERE id_establecimiento="'.$idEstablecimiento.'";'
                  ;

        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());                        
        ConexionDAO::desconectarBD();

        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    
?>