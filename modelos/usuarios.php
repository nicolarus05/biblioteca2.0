<?php
class Usuario
{

    //atributos de la clase
    private $bd;
    private $tabla = 'usuarios';

    //constructor
    public function __construct()
    {
        $this->bd = new PDO('mysql:host=host;dbname=base-datos', 'usuario', 'clave');
    }

    //obtener todos los usuarios
    public function obtenerTodos()
    {
        $consulta = 'SELECT * FROM ' . $this->tabla;
        $stmt = $this->bd->query($consulta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //función para crear los usuarios
    public function crear($datos)
    {
        $consulta = 'INSERT INTO ' . $this->tabla . ' (login, nombre, apellidos, avatar, salt, clave, rol) VALUES (:login, :nombre, :apellidos, :avatar, :salt, :clave, :rol)';
        $stmt = $this->bd->prepare($consulta);
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
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':login', $datos['login']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':apellidos', $datos['apellidos']);
        $stmt->bindParam(':avatar', $datos['avatar']);
        $stmt->bindParam(':clave', $datos['clave']);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
    }

    //función para eliminar usuarios
    public function eliminar($login)
    {
        $consulta = 'DELETE FROM ' . $this->tabla . ' WHERE login = :login';
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
    }
}
?>