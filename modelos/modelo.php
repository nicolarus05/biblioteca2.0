<?php

class Modelo
{
    //nombre de la tabla a la que se accede
    protected $tabla;

    //capa de abstracción de datos
    protected $bd;

    //constructor
    public function __construct($nombreTabla)
    {
        $this->tabla = $nombreTabla;
        $datosConexion = 'mysql:host=host;dbname=base-datos;charset=utf8';
        $usuario = 'root';
        $clave = 'root';
        try {
            $this->bd = new PDO($datosConexion, $usuario, $clave);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Coexión fallida: ' . $e->getMessage();
        }
    }

    //función de obtener todo de una tabla
    public function obtenerTodo()
    {
        $consulta = $this->bd->query('SELECT * FROM ' . $this->tabla);
        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    //función para obtener algo concreto de una tabla
    public function obtenerConcreto($columna, $valor)
    {
        $consulta = 'SELECT * FROM ' . $this->tabla . ' WHERE ' . $columna . ' = :valor';
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //función para eliminar algo de una tabla
    public function eliminar($columna, $valor)
    {
        $consulta = 'DELETE FROM ' . $this->tabla . ' WHERE ' . $columna . ' = :valor';
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();
    }
}