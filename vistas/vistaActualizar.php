<main>
    <?php
        $tabla = array_shift($datos);
        $libro = $datos[0];
        $autores = $datos[1];
        if($tabla=='libro'){ ?>
            <form action="" method="post">
                <input type="hidden" name="id" value='<?php echo $libro['id'];?>'>
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" 
                value='<?php echo $libro['titulo'];?>'>
                <label for="autor">Autor</label>
                <select id="autor" name="autor" style="display: inline;">
                    <?php
                        foreach ($autores as $autor) {
                            if($autor['id']==$libro['idAutor']){
                                echo "<option value='".$autor['id']."' selected>".$autor['Nombre']." ".$autor['Apellidos']."</option>";
                            } else {
                                echo "<option value='".$autor['id']."'>".$autor['Nombre']." ".$autor['Apellidos']."</option>";
                            }
                        }
                    ?>
                </select>
                <label for="genero">Genero</label>
                <select id="genero" name="genero"
                value='<?php echo $libro['genero'];?>'>
                    <option value="Narrativa">Narrativa</option>
                    <option value="Lírica">Lírica</option>
                    <option value="Teatro">Teatro</option>
                    <option value="Científico-Técnico">Científico-Técnico</option>
                </select>
            
                <label for="nPaginas">Número de páginas</label>
                <input type="number" name="numeroPaginas" id="nPaginas"
                value='<?php echo $libro['numeroPaginas'];?>'>
                <label for="nEjemplares">Número de ejemplares</label>
                <input type="number" name="numeroEjemplares" id="nEjemplares"
                value='<?php echo $libro['numeroEjemplares']; ?>'>
                <input type="submit" name="aLibro" value="Actualizar">
            </form>
    <?php } //elseif tabla==usuario
        //elseif tabla==autor
    ?>
</main>