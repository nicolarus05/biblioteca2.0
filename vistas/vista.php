<?php
    /**
     * Clase Vista Generica.
     */
    class Vista {
        /**
         * Muestra la vista
         * @param string $nombreVista Nombre de la vista a mostrar. La vista solo contiene el main de la página.
         * @param array $datos Datos que se le pasan a la vista. Default: null.
         */
        public static function mostrar($nombreVista, $datos=null) {
            include("cabecera.php");
            include("$nombreVista.php");
            include("pie.php");
        }
    }
?>