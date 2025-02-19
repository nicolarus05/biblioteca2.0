<main>
    <!-- Apertura de tabla -->
    <table>
        <!-- cabeceras -->
        <tr>
            <th>Login</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <!-- Código php-->
         <?php 
            $usuarios = $datos;

            //bucle
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                //mostrar el nombre de usuario (login)
                echo "<td>$usuario[login]</td>";
                //mostrar el nombre del usuario
                echo "<td>$usuario[nombre]</td>";
                //mostrar los apellidos del usuario
                echo "<td>$usuario[apellidos]</td>";
                //mostrar el rol del usuario
                echo "<td>$usuario[rol]</td>";

                //mostrar las acciones (si es un usuario administrador)
                if(Seguridad::secureRol(['admin'])){
                    echo "<td><a href='?vista=actualizarUsuario&id=".$usuario['login']."'>Modificar</a></td>";
                    echo "<td><a href='?vista=borrarUsuario&id=".$usuario['login']."'>Borrar</a></td>";
                }
                
                echo "<tr/>";
            }
         ?>
    </table>
</main>