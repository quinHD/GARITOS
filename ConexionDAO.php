<?php
    class ConexionDAO
    {
        public $iden;

        public static function conectarBD()
        {
            if(!($iden = mysqli_connect("localhost","root","root", "garitos")))
                 die ("No se ha podido conectar");
            return $iden;
        }

        public static function desconectarBD()
        {
            if (isset($iden)) 
            {
                mysqli_free_result($iden);
            }
        }
    }
?>