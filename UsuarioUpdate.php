<?php
    require("ConexionDAO.php");
    
    if(isset($_POST['idUsuario']))
    {
        updateUsuario();
    }

    function updateUsuario()
    {
        $idUsuario = $_POST['idUsuario'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $id_tipo_usuario = $_POST['tipoUsuarioCombo'];

        $iden = ConexionDAO::conectarBD();
        $query = 'UPDATE t_usuario
                  SET usuario="'.$usuario.'", password="'.$password.'", id_tipo_usuario="'.$id_tipo_usuario.'"
                  WHERE id_usuario="'.$idUsuario.'";'
                  ;
        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());                        
        ConexionDAO::desconectarBD();

        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    
?>