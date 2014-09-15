<?php

	class UsuarioRead
    {
    	public $iden;

    	public function __construct()
        {
            $this->iden = ConexionDAO::conectarBD();
        }      

        function cerrarConexion()
        {
        	ConexionDAO::desconectarBD();
        }

        function selectUsuario($idUsuario)
        {
            $query = 'SELECT t_usuario.id_usuario, t_usuario.usuario,t_usuario.password, t_usuario.id_tipo_usuario
                      FROM t_usuario 
                      WHERE t_usuario.id_usuario ='."$idUsuario".';'
                      ;
            
            $select = mysqli_query($this->iden,$query) or die('Error'.mysql_error());                        

            while($valor=mysqli_fetch_assoc($select))
            {
                $aUsuario = array();
                if($valor != null)
                {
 
                    $aUsuario['id_usuario'] = $valor['id_usuario'];
                    $aUsuario['usuario'] = $valor['usuario'];
                    $aUsuario['password'] = $valor['password'];
                    $aUsuario['id_tipo_usuario'] = $valor['id_tipo_usuario'];
                }
            } 

            return $aUsuario;

        }

	    function selectUsuarios()
	    {
	    	//Variables
	    	$arrayUsuarios= array();

			$query = 'SELECT t_usuario.id_usuario, t_usuario.usuario, t_tipo_usuario.tipo_usuario
                      FROM t_usuario 
                      INNER JOIN t_tipo_usuario
                        ON t_usuario.id_tipo_usuario = t_tipo_usuario.id_tipo_usuario
                      ORDER BY id_usuario;';

            $select = mysqli_query($this->iden,$query) or die('Error'.mysql_error());                     


            while($valor=mysqli_fetch_assoc($select))
            {
            	$aUsuario = array();
                if($valor != null)
                {
 
					$aUsuario['id_usuario'] = $valor['id_usuario'];
					$aUsuario['usuario'] = $valor['usuario'];
					$aUsuario['tipo_usuario'] = $valor['tipo_usuario'];

					array_push($arrayUsuarios, $aUsuario);
                }
			}

			return $arrayUsuarios;
	    }
	}
?>