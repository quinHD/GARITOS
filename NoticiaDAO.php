<?php

	class NoticiaDAO
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

	    function selectNoticias($lim)
	    {
	    	//Variables
	    	$arrayNoticias = array();

	    	if($lim>0)
	          $cadLimite = "LIMIT ".$lim;
	      	else
	      	  $cadLimite = "";

	    	//Query
			$query = 
			 'SELECT t_noticia.id_noticia, t_noticia.titular_noticia, t_noticia.texto_noticia,t_categoria_noticia.categoria_noticia, t_usuario.usuario, t_noticia.fecha_creacion
	          FROM t_noticia 
	          INNER JOIN t_categoria_noticia 
	            ON t_noticia.id_categoria_noticia=t_categoria_noticia.id_categoria_noticia 
	          INNER JOIN t_usuario 
	            ON t_noticia.id_usuario = t_usuario.id_usuario 
	          ORDER BY t_noticia.fecha_creacion DESC '.$cadLimite
	        ;
	        $select = mysqli_query($this->iden,$query) or die('Error'.mysql_error());                        


            while($valor=mysqli_fetch_assoc($select))
            {

                if($valor != null)
                {
                    $idnoticia = $valor['id_noticia']; 
                    $titularNoticia = $valor['titular_noticia'];
                    $textoNoticia = $valor['texto_noticia'];
                    $idCategoriaNoticia = $valor['categoria_noticia'];
                    $idUsuario = $valor['usuario'];
                    $timestamp = $valor['fecha_creacion'];

                    $fechaCreacion = strtotime($timestamp);

					$noticia = new Noticia($idnoticia, $titularNoticia, $textoNoticia, $idCategoriaNoticia, $idUsuario, $fechaCreacion);

					array_push($arrayNoticias, $noticia);

                }
			}

			return $arrayNoticias;
	    }
	}
?>