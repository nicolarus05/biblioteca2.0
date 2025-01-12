<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de usuarios</title>
</head>
<body>
    <h1>Listado de usuarios</h1>

    <!-- Apertura de tabla -->
    <table>
        <!-- cabeceras -->
        <tr>
            <th>Login</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Avatar</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <!-- Código php-->
         <?php 
            $usuarios = $datos['usuarios'];

            //bucle
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                //mostrar el nombre de usuario (login)
                echo "<td>$usuario[login]</td>";
                //mostrar el nombre del usuario
                echo "<td>$usuario[nombre]</td>";
                //mostrar los apellidos del usuario
                echo "<td>$usuario[apellidos]</td>";
                //mostrar el avatar del usuario
                echo "<td>$usuario[avatar]</td>";
                //mostrar el rol del usuario
                echo "<td>$usuario[rol]</td>";

                //mostrar las acciones (si es un usuario administrador)
                if(isset($_SESSION['logged']) && $_SESSION['logged']="administrador"){
                    echo "<td><a href='./modelos/usuarios.php?id=".$usuario['login']."'>Modificar</a></td>";
                    echo "<td><a href='./modelos/modelo.php?id=".$usuario['login']."'>Borrar</a></td>";
                }
                
                echo "<tr/>";
            }
         ?>
    </table>
</body>
</html>