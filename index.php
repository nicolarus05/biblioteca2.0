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

//Recibir formulario de insercion de autores
if(isset($_POST['iAutor'])){
    $autores = new Autor('autores');
    $autores->insertar($_POST['nombre'],$_POST['apellidos'],$_POST['nacionalidad']);
    header("Location:./?vista=vistaAutores");
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
    case 'vistaLibros':
        //qué hacer para mostrar los libros
        $libros = new Libro('libros');
        Vista::mostrar('vistaLibros',$libros->listar());
        break;
    case 'insertarLibro':
        //qué hacer para insertar libros
        if(Seguridad::secureRol(['bibliotecario'])){
            $datos[0] = 'libro';
            $autores = new Autor('autores');
            array_push($datos,$autores->listar());
            Vista::mostrar('vistaInsertar',$datos);
        }
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