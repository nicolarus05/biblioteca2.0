<?php
require_once 'config.php';
class conexion{
    protected static $conn;
    public function __construct(){
        self::getConn();
    }
       
    public static function getConn(){
        if(!isset(self::$conn)){
            try{
                self::$conn = new PDO("mysql:host=".HOST.";port=".PUERTO.";dbname=".BASEDATOS, USUARIO, PASSWORD);
            }catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$conn;
    }

    public function __destruct(){
        self::$conn = null;
    }

    public static function lastError(){
        return self::$conn->errorInfo();
    }
}
?>