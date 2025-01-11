<?php
require_once 'modelo.php';
class Usuario extends Modelo
{

    //los atributos se heredan de la clase modelo

    //constructor
    public function __construct($nombreTabla)
    {
        parent::__construct($nombreTabla);
    }

    //función para crear los usuarios
    public function crear($datos)
    {
        $consulta = 'INSERT INTO ' . $this->tabla . ' (login, nombre, apellidos, avatar, salt, clave, rol) VALUES (:login, :nombre, :apellidos, :avatar, :salt, :clave, :rol)';
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bindParam(':login', $datos['login']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellidos', $datos['apellidos']);
        $stmt->bindParam(':avatar', $datos['avatar']);
        $stmt->bindParam(':salt', $datos['salt']);
        $stmt->bindParam(':clave', $datos['clave']);
        $stmt->bindParam(':rol', $datos['rol']);
        $stmt->execute();
    }

    //función para actualizar los usuarios
    public function actualizar($login, $datos)
    {
        $consulta = 'UPDATE ' . $this->tabla . ' SET login = :login, nombre = :nombre, apellidos = :apellidos, avatar = :avatar, clave = :clave WHERE login = :login';
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bindParam(':login', $datos['login']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellidos', $datos['apellidos']);
        $stmt->bindParam(':avatar', $datos['avatar']);
        $stmt->bindParam(':clave', $datos['clave']);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
    }
}
?>