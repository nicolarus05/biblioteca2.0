# Biblioteca 2.0

## Miembros del Proyecto
+ Nicolás García Hernández (Autores)
+ Alonso Sánchez Jerez (Usuarios, Modelo)
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
+ seguridad/
    + install.php
    + config.php *.gitignore*
    + config.sample.php
    + seguridad.php
    + conexion.php
    + cerrarSesion.php
+ index.php

##Las base de datos se hará en PDO
