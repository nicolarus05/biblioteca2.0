<!-- Cuerpo de la vista de autores -->

<h1>Listado de Autores</h1>

<table>

    <tr>
        <th>Nombre</th>

        <th>Apellido</th>

        <th>Nacionalidad</th>

        <th>Fecha de Nacimiento</th>
    </tr>

    <?php 
        $autores = $datos['autores'];

        foreach($autores as $autor) {
            echo "<tr>";
                echo "<td>$autor[nombre]</td>";
                echo "<td>$autor[apellido]</td>";
                echo "<td>$autor[nacionalidad]</td>";
                echo "<td>$autor[fechaNacimiento]</td>";

                if(isset($_SESSION['logged']) && $_SESSION['logged']!="registrado"){
                    echo "<td><a href='actualizarAutor.php?id=".$autor['id']."'>Actualizar</a></td>";
                    echo "<td><a href='borrarAutor.php?id=".$autor['id']."'>Borrar</a></td>";
                }

            echo "</tr>";
        }
    ?>
</table>