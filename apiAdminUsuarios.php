
<?php

function elimina_usuarios($usuarios)
{
    //Conectamos al SGDB
    
    if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
        die ("No se ha podido conectar");
    

    $query = 'DELETE FROM t_usuario
    		  WHERE id_usuario = 
              ;';

    if (isset($iden)) 
    {
        mysqli_free_result($iden);
    }
                    
}

?>