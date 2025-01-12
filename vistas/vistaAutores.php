<!-- Cuerpo de la vista de autores -->
<main>
    <h2>Listado de Autores</h2>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Nacionalidad</th>
        </tr>

        <?php 
            $autores = $datos;

            foreach($autores as $autor) {
                echo "<tr>";
                    echo "<td>$autor[Nombre]</td>";
                    echo "<td>$autor[Apellidos]</td>";
                    echo "<td>$autor[Pais]</td>";

                    if(Seguridad::secureRol(['bibliotecario'])){
                        echo "<td><a href='?vista=actualizarAutor&id=".$autor['id']."'>Actualizar</a></td>";
                        echo "<td><a href='?vista=borrarAutor&id=".$autor['id']."'>Borrar</a></td>";
                    }

                echo "</tr>";
            }
        ?>
    </table>
</main>