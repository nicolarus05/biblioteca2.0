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
        $libros = $datos;
        foreach($libros as $libro) {
            echo "<tr>";
                echo "<td>$libro[titulo]</td>";
                echo "<td>$libro[genero]</td>";
                echo "<td>$libro[idAutor]</td>";
                echo "<td>$libro[numeroPaginas]</td>";
                echo "<td>$libro[numeroEjemplares]</td>";

                if(Seguridad::secureRol(['bibliotecario'])){
                    echo "<td><a href='?vista=actualizarLibro&id=".$libro['idLibro']."'>Actualizar</a></td>";
                    echo "<td><a href='?vista=borrarLibro&id=".$libro['idLibro']."'>Borrar</a></td>";
                } 
            echo "</tr>";
            
            
        }
    ?>
</table>