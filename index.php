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

//Recibir formulario de actualizacion de autores
if(isset($_POST['aAutor'])){
    $autores = new Autor('autores');
    $autores->actualizar($_POST['id'],$_POST['nombre'],$_POST['apellidos'],$_POST['pais']);
    header("Location:./?vista=vistaAutores");
}

//Recibir formulario de actualizacion de libros
if(isset($_POST['iLibro'])){
    $libros = new Libro('libros');
    $libros->insertar($_POST['titulo'],$_POST['genero'],$_POST['autor'],$_POST['numeroPaginas'],$_POST['numeroEjemplares']);
    header("Location:./?vista=vistaLibros");
}

//Recibir formulario de actualizacion de libros
if(isset($_POST['aLibro'])){
    $libros = new Libro('libros');
    $libros->actualizar($_POST['id'],$_POST['titulo'],$_POST['genero'],$_POST['autor'],$_POST['numeroPaginas'],$_POST['numeroEjemplares']);
    header("Location:./?vista=vistaLibros");
}

//Recibir formulario de insercion de usuarios
if(isset($_POST['iUsuario'])){
    $usuario = new Usuario('usuarios');
    $usuario->crear($_POST['nombre'],$_POST['apellido'],$_POST['usuario'],$_POST['contrasena'],$_POST['rol']);
    header("Location:./?vista=vistaUsuarios");
}

//Recibir formulario de actualizacion de usuarios
if(isset($_POST['aUsuario'])){
    $usuarios = new Usuario('usuarios');
    $usuarios->actualizar($_POST['nombre'],$_POST['apellidos'],$_POST['usuario'],$_POST['rol']);
    header("Location:./?vista=vistaUsuarios");
}

//Recibir vista por url sucia
if(isset($_GET['vista'])){
    $vista = $_GET['vista'];
}

//Recibir id por url sucia
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(!isset($vista)){
    $vista = null;
}

switch ($vista) {
    case 'vistaUsuarios':
        //qué hacer para mostrar los usuarios
        if(Seguridad::secureRol(['admin'])){
            $usuarios = new Usuario('usuarios');
            Vista::mostrar('vistaUsuarios',$usuarios->listar());
        }
        break;

    case 'miPerfil':
        //qué hacer para mostrar el perfil del usuario
        $usuarios = new Usuario('usuarios');
        Vista::mostrar('miPerfil',$usuarios->get('login',$_SESSION['usuario']));
        break;

    case 'insertarUsuario':
        //qué hacer para insertar los usuarios
        if(Seguridad::secureRol(['admin'])){
            $datos[0] = 'usuario';
            $usuarios = new Usuario('usuarios');
            array_push($datos,$usuarios->listar());
            Vista::mostrar('vistaInsertar',$datos);
        }
        break;

    case 'actualizarUsuario':
        //qué hacer para actualizar usuarios
        if($segura->isLogged()){
            $rol = $segura->getRol();
            $usuarios = new Usuario('usuarios');
            $datos[0] = 'usuario';
            array_push($datos,$usuarios->get('id',$id));
            Vista::mostrar('vistaActualizar',$datos);
        }
        break;

    case 'borrarUsuario':
        //qué hacer para eliminar usuarios
        if($segura->isLogged()){
            $datos = $segura->getRol();
            $usuarios = new Usuario('usuarios');
            $usuarios->eliminar('id',$id);
            header("Location:./?vista=vistaUsuarios");
        }
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
    case 'actualizarLibro':
        //qué hacer para actualizar libros
        if(Seguridad::secureRol(['bibliotecario'])){
            $libros = new Libro('libros');
            $autores = new Autor('autores');
            $datos[0] = 'libro';
            array_push($datos,$libros->get('id',$id));
            array_push($datos,$autores->listar());
            Vista::mostrar('vistaActualizar',$datos);
        }
        break;
    case 'borrarLibro':
        //qué hacer para borrar libros
        if(Seguridad::secureRol(['bibliotecario'])){
            $libros = new Libro('libros');
            $libros->eliminar('id',$id);
            header("Location:./?vista=vistaLibros");
        }
        break;

    case 'insertarAutor':
        //qué hacer para insertar autores
        if(Seguridad::secureRol(['bibliotecario'])){
            $datos[0] = 'autor';
            Vista::mostrar('vistaInsertar',$datos);
        }
        break;

    case 'borrarAutor':
        //qué hacer para borrar autores
        if(Seguridad::secureRol(['bibliotecario'])){
            $autores = new Autor('autores');
            $autores->eliminar('id',$id);
            header("Location:./?vista=vistaAutores");
        }
        break;

    case 'actualizarAutor':
        //qué hacer para actualizar autores
        if(Seguridad::secureRol(['bibliotecario'])){
            $autores = new Autor('autores');
            $datos[0] = 'autor';
            array_push($datos,$autores->get('id',$id));
            Vista::mostrar('vistaActualizar',$datos);
        }
        break;

    case 'vistaAutores':
        //qué hacer para mostrar los autores
        $autores = new Autor('autores');
        Vista::mostrar('vistaAutores',$autores->listar());
        break;

    case 'cerrarSesion':
        if($segura->isLogged()){
            $segura->logout();
            Vista::mostrar('vistaLogin');
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