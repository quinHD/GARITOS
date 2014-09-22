<?php
    require("ConexionDAO.php");
    require("ChromePhp.php");
    
    if(isset($_POST['idNoticia']))
    {
        ChromePhp::log("Heeey");
        updateNoticia();
        

    }

    function updateNoticia()
    {
        $idnoticia = $_POST['idNoticia'];
        $titularNoticia = $_POST['titular'];
        $idCategoriaNoticia = $_POST['categoria'];
        $textoNoticia = $_POST['textoNoticia'];

        $iden = ConexionDAO::conectarBD();
        $query = "UPDATE t_noticia
                  SET id_noticia='".$idnoticia."', titular_noticia='".$titularNoticia."', id_categoria_noticia='".$idCategoriaNoticia."', texto_noticia='".$textoNoticia."'
                  WHERE id_noticia='".$idnoticia."';"
                  ;

        ChromePhp::log($query);
        $select = mysqli_query($iden,$query) or die('Error'.mysql_error());                        
        ConexionDAO::desconectarBD();

        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    
?>