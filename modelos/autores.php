<?php

require_once 'modelo.php';
class Autor extends Modelo {

    // Constructor de la clase
    public function __construct() {
        parent::__construct('autores');
    }

    // Método para insertar un autor
    public function insertar($nombre, $apellidos ,$nacionalidad) {
        $sql = "insert INTO $this->tabla (Nombre, Apellidos , Pais) VALUES (:nombre, :apellidos, :nacionalidad)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':Nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':Apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':nacionalidad', $nacionalidad, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al insertar el autor: " . $e->getMessage();
        }
        return $this->conexion->lastInsertId();
    }

    // Método para actualizar un autor
    public function actualizar($apellidos, $nombre, $nacionalidad) {
        $sql = "update $this->tabla SET nombre = :nombre, nacionalidad = :nacionalidad WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':Nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':Apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':nacionalidad', $nacionalidad, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el autor: " . $e->getMessage();
        }
    }
}
?>