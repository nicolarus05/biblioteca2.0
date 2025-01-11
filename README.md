# Biblioteca 2.0

## Miembros del Proyecto
+ Nicolás García Hernández (Autores)
+ Alonso Sánchez Jerez (Usuarios, Modelo  genérico)
+ Salvador Ortega Murcia (Libros, Vista)


## Estructura de Ficheros de la Aplicación
+ modelo/
    + modelo.php: clase genérica de los modelos, una clase padre para todos los modelo. Ver apuntes MVC, apartado quinta mejora.
    + autores.php
    + libros.php
    + usuarios.php
+ vistas/
    + vista.php: clase con un método mostrar vista, Ver apuntes MVC, apartado cuarta mejora -> clase vista.
    + vistaAutores.php
    + vistaLibros.php
    + vistaUsuarios.php
    + vistaLogin.php
    + miPerfil.php
    + vistaGeneral.php
    + header.php
    + footer.php
    + vistaInsertar.php
    + vistaBorrar.php
    + vistaActualizar.php
+ seguridad/
    + install.php
    + config.php *.gitignore*
    + config.sample.php
    + seguridad.php
    + conexion.php
    + cerrarSesion.php
+ index.php

## Instrucciones de uso.
1. Requisitos mínimos: LAMP. Recomendable: php-myadmin
2. Descargar la aplicación y descomprimir en la ruta de nuestro servidor web.
3. Dar permisos de lectura y escritura a nuestro servidor web.
4. Dar permisos de ejecución al archivo install.php
5. Desde el navegador acceder a nuestro servidor web, a la ruta de la aplicación.
6. Seguir la instalación. Se pedirá la siguiente información: 
    + IP del SGBD.
    + Nombre de la base de datos.
    + Login del usuario con privilegios sobre esa base de datos.
    + Contraseña del usuario.
    + Puerto.
