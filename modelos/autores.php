<?php
// Archivo: modelos/autores.php

require_once "modelo.php";

class Autores extends Modelo {

    //atributos de la clase
    private $conexion;

    //constructor de la clase
    public function __construct() {
        parent::__construct('autores');
    }

    //metodo para insertar un autor
    public function insertar($nombre, $nacionalidad) {
        $sql = "INSERT INTO $this->tabla (nombre, nacionalidad) VALUES (:nombre, :nacionalidad)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':nacionalidad', $nacionalidad, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar el autor: " . $e->getMessage();
        }
        return $this->conexion->lastInsertId();
    }

    //metodo para actualizar un autor
    public function actualizar($id, $nombre, $nacionalidad) {
        $sql = "UPDATE $this->tabla SET nombre = :nombre, nacionalidad = :nacionalidad WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':nacionalidad', $nacionalidad, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el autor: " . $e->getMessage();
        }
    }

    //metodo para eliminar un autor
    public function eliminar($id, $cascade = false) {
        $sql = "DELETE FROM $this->tabla WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar el autor: " . $e->getMessage();
        }
    }
}

?>
