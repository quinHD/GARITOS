<?php

	class EstablecimientoRead
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


        function selectEstablecimiento($idEstablecimiento)
        {
            //Variables
            $aEstablecimiento = array();

            //Query
            $query = 'SELECT * FROM t_establecimiento WHERE ID_ESTABLECIMIENTO = '."$idEstablecimiento".';';

            $select = mysqli_query($this->iden,$query) or die('Error'.mysql_error());                        
            $raizImagenes = "imgs/";

            while($valor=mysqli_fetch_assoc($select))
            {
                
                if($valor != null)
                {

                    $aEstablecimiento['id_establecimiento'] = $valor['id_establecimiento']; 
                    $aEstablecimiento['nombre'] = $valor['nombre'];
                    $aEstablecimiento['direccion'] = $valor['direccion'];
                    $aEstablecimiento['horario'] = $valor['horario'];
                    $aEstablecimiento['telefono'] = $valor['telefono'];
                    $aEstablecimiento['nota'] = $valor['nota'];
                    $aEstablecimiento['categoria'] = $valor['categoria'];
                    $aEstablecimiento['caracteristicas'] = $valor['caracteristicas'];
                    $aEstablecimiento['imagen'] = $raizImagenes.$valor['imagen'];
                    $aEstablecimiento['creado'] = $valor['creado'];
                    $aEstablecimiento['comentario'] = $valor['comentario'];

                }
            }

            return $aEstablecimiento;
        }

        function selectEstablecimientoUpdate($idEstablecimiento)
        {
            //Variables
            $aEstablecimiento = array();

            //Query
            $query = 'SELECT * FROM t_establecimiento WHERE ID_ESTABLECIMIENTO = '."$idEstablecimiento".';';

            $select = mysqli_query($this->iden,$query) or die('Error'.mysql_error());                        
            $raizImagenes = "imgs/";

            while($valor=mysqli_fetch_assoc($select))
            {
                
                if($valor != null)
                {

                    $aEstablecimiento['id_establecimiento'] = $valor['id_establecimiento']; 
                    $aEstablecimiento['nombre'] = $valor['nombre'];
                    $aEstablecimiento['direccion'] = $valor['direccion'];
                    $aEstablecimiento['horario'] = $valor['horario'];
                    $aEstablecimiento['telefono'] = $valor['telefono'];
                    $aEstablecimiento['nota'] = $valor['nota'];
                    $aEstablecimiento['categoria'] = $valor['categoria'];
                    $aEstablecimiento['caracteristicas'] = $valor['caracteristicas'];
                    $aEstablecimiento['imagen'] = $raizImagenes.$valor['imagen'];
                    $aEstablecimiento['creado'] = $valor['creado'];
                    $aEstablecimiento['comentario'] = $valor['comentario'];

                }
            }

            return $aEstablecimiento;
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
                $aEstablecimiento = array();
                if($valor != null)
                {

					$aEstablecimiento['id_establecimiento'] = $valor['id_establecimiento']; 
                    $aEstablecimiento['nombre'] = $valor['nombre'];
                    $aEstablecimiento['direccion'] = $valor['direccion'];
                    $aEstablecimiento['horario'] = $valor['horario'];
                    $aEstablecimiento['telefono'] = $valor['telefono'];
                    $aEstablecimiento['nota'] = $valor['nota'];
                    $aEstablecimiento['categoria'] = $valor['categoria'];
                    $aEstablecimiento['caracteristicas'] = $valor['caracteristicas'];
                    $aEstablecimiento['imagen'] = $raizImagenes.$valor['imagen'];
                    $aEstablecimiento['creado'] = $valor['creado'];
                    $aEstablecimiento['comentario'] = $valor['comentario'];

					array_push($arrayEstablecimientos, $aEstablecimiento);
                }
			}

			return $arrayEstablecimientos;
	    }
	}
?>