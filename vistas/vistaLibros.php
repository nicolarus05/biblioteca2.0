<!-- Cuerpo de la vista de libros -->
<h1>Listado de Libros</h1>
<table>
    <tr>
        <th>Titulo</th>
        <th>Genero</th>
        <th>Autor</th>
        <th>Número de páginas</th>
        <th>Número de ejemplares</th>
    </tr>
    <?php 
        $libros = $datos['libros'];
        foreach($libros as $libro) {
            echo "<tr>";
                echo "<td>$libro[titulo]</td>";
                echo "<td>$libro[genero]</td>";
                echo "<td>$libro[autor]</td>"; //Mostrar el nombre del autor y su apellido + adelante.
                echo "<td>$libro[nPaginas]</td>";
                echo "<td>$libro[nEjemplares]</td>";

                //Falta cambiar llamada a editar y borrar.
                if(isset($_SESSION['logged']) && $_SESSION['logged']!="registrado"){
                    echo "<td><a href='actualizarLibro.php?id=".$libro['id']."'>Actualizar</a></td>";
                    echo "<td><a href='borrarLibro.php?id=".$libro['id']."'>Borrar</a></td>";
                }
            echo "</tr>";
            
            
        }
    ?>
</table>