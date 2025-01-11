<?php
session_start();

if(!file_exists("seguridad/config.php")){
    header("Location:./seguridad/install.php");
}

require_once 'seguridad/conexion.php';
require_once 'seguridad/seguridad.php';
$segura = new Seguridad(new Conexion());

require_once './modelos/usuarios.php';
require_once './vistas/vista.php';
require_once './modelos/autores.php';
require_once './modelos/libros.php';

if(isset($_POST['login'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if($segura->login($usuario,$password)){
        $_GET['vista'] = 'vistaGeneral';
    } else {
        $_GET['vista'] = 'vistaLogin';
    }
}

if(isset($_GET['vista'])){
    $vista = $_GET['vista'];
}

if(!isset($vista)){
    $vista = null;
}

switch ($accion) {
    case 'usuarios':
        //qué hacer para mostrar los usuarios
        break;
    default:
        if($segura->isLogged()){
            $datos = $segura->getRol(); 
            Vista::mostrar('vistaGeneral',$datos);
        } else {
            Vista::mostrar('vistaLogin');
        }
        break;
}

?>