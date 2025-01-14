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
    public function crear($nombre,$apellidos,$login,$password,$rol = "registrado")
    {
        $salt=random_int(10000000,99999999);
        $password = password_hash($password.$salt,PASSWORD_DEFAULT);
        
        try{
            $stmt = $this->conexion->prepare("INSERT INTO usuarios(nombre,apellidos,login,password,salt,rol)
                VALUES (?,?,?,?,?,?);");
            $stmt->execute([$nombre,$apellidos,$login,$password,$salt,$rol]);
        } catch (Exception $e){
            echo "<p class='error'>Error al insertar $login. $e</p>";
        }
    }

    //función para actualizar los usuarios
    public function actualizar($nombre,$apellidos,$login,$rol)
    {
        $sql = "UPDATE `usuarios` SET `nombre`=?, `apellidos`=?, `rol`=? WHERE `login` = ?;";
        $stmt = $this->conexion->prepare($sql);

        try{
            $stmt->execute([$nombre,$apellidos,$rol,$login]);
        }catch(PDOException $e){
            echo "Error al actualizar el usuario: " . $e->getMessage();
        }
    }
}
?>