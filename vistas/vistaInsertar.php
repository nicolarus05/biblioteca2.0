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
        <?php } elseif ($tabla=='usuario') {?>
            <fieldset>
            <legend>Formulario de Registro</legend>
                <form action="" method="post" onsubmit="comprobarPass(this)">
                    <label for="nombre">Nombre</label><br>
                    <input type="text" name="nombre" id="nombre" required><br>
                    <label for="ape">Apellidos</label><br>
                    <input type="text" name="apellido" id="ape" required><br>
                    <label for="user">Usuario</label><br>
                    <input type="text" name="usuario" id="user" required><br>
                    <label for="pass">Contraseña</label><br>
                    <input type="password" name="contrasena" id="pass" required><br>
                    <label for="repass">Repite Contraseña</label><br>
                    <input type="password" name="contrasena" id="repass" required><br>
                    <label for="rol">Rol</label><br>
                    <select name="rol" id="rol">
                        <option value="admin">Admin</option>
                        <option value="bibliotecario">Bibliotecario</option>
                        <option value="registrado">Registrado</option>
                    </select>
                    <input type="submit" name="iUsuario" value="Insertar"><br>
                </form>
            </fieldset>
            <script>
                function comprobarPass(form){
                    if(this.pass.value!=this.repass.value){
                        alert("Las contraseñas no coinciden");
                        return false;
                    } else {
                        return true;
                    }
                }
            </script>
            <?php } ?>
</main>