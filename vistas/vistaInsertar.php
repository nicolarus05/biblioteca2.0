<main>
    <?php
        $tabla = array_shift($datos);
        if ($tabla=='libro') { ?>
            <fieldset>
            <legend>Insertar Libro</legend>
                <form action="" method="post">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo">
                    <label for="autor">Autor</label>
                    <select id="autor" name="autor" style="display: inline;">
                    <?php
                        foreach ($datos as $index) {
                            foreach ($index as $autor) {
                                echo "<option value='".$autor['id']."'>".$autor['Nombre']." ".$autor['Apellidos']."</option>";
                            }
                        }
                    ?>
                    </select><button style="display:inline;"><a  href="?vista=insertarAutor">Insertar Autor</a></button>
                    <label for="genero">Genero</label>
                    <select id="genero" name="genero">
                        <option value="Narrativa">Narrativa</option>
                        <option value="Lírica">Lírica</option>
                        <option value="Teatro">Teatro</option>
                        <option value="Científico-Técnico">Científico-Técnico</option>
                    </select>
                
                    <label for="numeroPaginas">Número de páginas</label>
                    <input type="number" name="numeroPaginas" id="numeroPaginas">
                    <label for="numeroEjemplares">Número de ejemplares</label>
                    <input type="number" name="numeroEjemplares" id="numeroEjemplares">
                    <input type="submit" name="iLibro" value="Insertar">
                </form>
            </fieldset>
        <?php } elseif ($tabla == 'autor'){?>
            <fieldset>
            <legend>Insertar Autor</legend>
                <form action="" method="post">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" name="nacionalidad" id="nacionalidad">
                    <input type="submit" name="iAutor" value="Insertar">
                </form>
            </fieldset>
        <?php } ?>
</main>