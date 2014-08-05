<?php

	class EstablecimientoDAO
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

	    function selectEstablecimientos()
	    {
	    	//Variables
	    	$arrayEstablecimientos= array();

	    	//Query
			$query = 'SELECT * FROM t_establecimiento ORDER BY id_establecimiento';

	        $select = mysqli_query($this->iden,$query) or die('Error'.mysql_error());                        
                        $raizImagenes = "imgs/";

            while($valor=mysqli_fetch_assoc($select))
            {

                if($valor != null)
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

					$establecimiento = new Establecimiento($id, $nombre, $direccion, $horario, $telefono, $nota, $categoria, $caracteristicas, $imagen, $creado, $comentario);

					array_push($arrayEstablecimientos, $establecimiento);


                }
			}

			return $arrayEstablecimientos;
	    }
	}
?>