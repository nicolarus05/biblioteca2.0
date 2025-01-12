<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
</head>
<body>
    <header>
        <h1>Bienvenido a la Biblioteca</h1>
        <nav id='menu'>
            <ul>
            <?php 
                if(isset($_SESSION['rol'])){
                    if($_SESSION['rol']=='bibliotecario'){
                        echo "<li><a href='?vista=vistaLibros'>Listado de libros</a></li>";
                        echo "<li><a href='?vista=vistaAutores'>Listado de autores</a></li>";
                        echo "<li><a href='?vista=insertarLibro'>Insertar libro</a></li>";
                    } elseif ($_SESSION['rol']=='admin'){
                        echo "<li><a href='?vista=vistaUsuarios'>Listado de usuarios</a></li>";
                        echo "<li><a href='?vista=insertarUsuario'>Insertar usuario</a></li>";
                        echo "<li><a href='?vista=vistaLibros'>Listado de libros</a></li>";
                        echo "<li><a href='?vista=vistaAutores'>Listado de autores</a></li>";
                    } elseif ($_SESSION['rol']=='registrado'){
                        echo "<li><a href='?vista=vistaLibros'>Listado de libros</a></li>";
                        echo "<li><a href='?vista=vistaAutores'>Listado de autores</a></li>";
                    }
                    echo "<li><a href='?vista=miPerfil'>Mi Perfil</a></li>"; 
                    echo "<li><a href='?vista=cerrarSesion'>Cerrar sesion</a></li>";
                    echo "</ul>"; 
                } else {
                    echo "<h2>Log In</h2>";
                }
            ?>
        </nav>

    </header>
