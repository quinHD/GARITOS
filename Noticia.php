<?php
    class Noticia
    {
        public $id;
        public $titular;
        public $texto;
        public $idCategoriaNoticia;
        public $idUsuario;
        public $fechaCreacion;
        
        public function __construct($_id, $_titular, $_texto, $_idCategoriaNoticia, $_idUsuario, $_fechaCreacion)
        {
            $this->id = $_id;
            $this->titular = $_titular;
            $this->texto = $_texto;
            $this->idCategoriaNoticia = $_idCategoriaNoticia;
            $this->idUsuario = $_idUsuario;
            $this->fechaCreacion = $_fechaCreacion;
        }
    }

?>
