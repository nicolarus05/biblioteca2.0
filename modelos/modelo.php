<?php 
    class Modelo{
        //nombre de la tabla a la que se accede
        protected $tabla;

        //capa de abstracción de datos
        private $bd;

        //constructor
        public function __construct($nombreTabla){
            $this->tabla= $nombreTabla;
            $this->bd = new Bd(); //corregir esta línea
            $this->bd->crearConexion('host'. 'usuario', 'clave', 'base-datos');
        }

        //función de obtener todo de una tabla
        public function obtenerTodo(){
            $lista = $this->bd->dataQuery('SELECT * FROM ' . $this->tabla);
            $this->bd->cerrarConexion(); //corregir esta línea
            return $lista;
        }
    }