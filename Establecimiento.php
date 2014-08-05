<?php
    class Establecimiento
    {
        public $id;
        public $nombre;
        public $direccion;
        public $horario;
        public $telefono;
        public $nota;
        public $categoria;
        public $caracteristicas;
        public $imagen;
        public $creado;
        public $comentario;
        
        public function __construct($_id, $_nombre, $_direccion, $_horario, $_telefono, $_nota, $_categoria, $_caracteristicas, $_imagen, $_creado, $_comentario )
        {
            $this->id = $_id;
            $this->nombre = $_nombre;
            $this->direccion = $_direccion;
            $this->horario = $_horario;
            $this->telefono = $_telefono;
            $this->nota = $_nota;
            $this->categoria = $_categoria;
            $this->caracteristicas = $_caracteristicas;
            $this->imagen = $_imagen;
            $this->creado = $_creado;
            $this->comentario = $_comentario;
        }
    }
?>