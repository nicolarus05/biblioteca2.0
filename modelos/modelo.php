<?php

class Modelo
{
    //nombre de la tabla a la que se accede
    protected $tabla;

    //capa de abstracción de datos
    protected $conexion;

    //constructor
    public function __construct($nombreTabla)
    {
        $this->tabla = $nombreTabla;
        try{
            $this->conexion = Conexion::getConn();
        }catch(PDOException $e){
            echo "Conexion fallida" . $e->getMessage();
        }
    }

    //función de obtener todo de una tabla
    public function listar()
    {
        $consulta = $this->conexion->query('SELECT * FROM ' . $this->tabla);
        $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }

    //función para obtener algo concreto de una tabla
    public function get($columna, $valor)
    {
        $consulta = 'SELECT * FROM ' . $this->tabla . ' WHERE ' . $columna . ' = :valor';
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //función para eliminar algo de una tabla
    public function eliminar($columna, $valor)
    {
        try {
            $consulta = 'DELETE FROM ' . $this->tabla . ' WHERE ' . $columna . ' = :valor';
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bindParam(':valor', $valor);
            $stmt->execute();
    
            // Verifica si se eliminó alguna fila
            if ($stmt->rowCount() > 0) {
                echo "Recurso eliminado correctamente.";
            } else {
                echo "No se encontró el recurso para eliminar.";
            }
        } catch (PDOException $e) {
            echo "Error al recurso usuario: " . $e->getMessage();
        }
    }
}