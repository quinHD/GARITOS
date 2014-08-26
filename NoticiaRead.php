<?php

	class NoticiaRead
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

	    function selectNoticias($lim, $ord)
	    {
	    	//Variables
	    	$arrayNoticias = array();
	    	$cadLimite = "";
	    	$cadOrden = "";

	    	if($lim>0)
	          $cadLimite = "LIMIT ".$lim;

	      	if($ord>0)
	      		$cadOrden = "ORDER BY t_noticia.fecha_creacion DESC";

	    	//Query
			$query = 
			 'SELECT t_noticia.id_noticia, t_noticia.titular_noticia, t_noticia.texto_noticia,t_categoria_noticia.categoria_noticia, t_usuario.usuario, t_noticia.fecha_creacion
	          FROM t_noticia 
	          INNER JOIN t_categoria_noticia 
	            ON t_noticia.id_categoria_noticia=t_categoria_noticia.id_categoria_noticia 
	          INNER JOIN t_usuario 
	            ON t_noticia.id_usuario = t_usuario.id_usuario ' 
	            .$cadOrden." ".$cadLimite
	        ;
	        $select = mysqli_query($this->iden,$query) or die('Error'.mysql_error());                        


            while($valor=mysqli_fetch_assoc($select))
            {
            	$aNoticia = array();
                if($valor != null)
                {
					$aNoticia['id_noticia'] = $valor['id_noticia'];
					$aNoticia['titular_noticia'] = $valor['titular_noticia'];
					$aNoticia['texto_noticia'] = $valor['texto_noticia'];
					$aNoticia['categoria_noticia'] = $valor['categoria_noticia'];
					$aNoticia['usuario'] = $valor['usuario'];

                    $fechaCreacion = strtotime($valor['fecha_creacion']);
					$aNoticia['fecha_creacion'] = $fechaCreacion;

					array_push($arrayNoticias, $aNoticia);
                }
			}

			return $arrayNoticias;
	    }
	}
?>