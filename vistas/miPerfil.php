<main>
        <!-- Actualizar los datos del usuario-->
        <h2>Modificar mis datos</h2>
        <form action="" method="post">
            <input type="hidden" name="login" value='<?php echo $datos['login']; ?>'>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value='<?php echo $datos['nombre']; ?>'>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" value='<?php echo $datos['apellidos']; ?>'>
            <input type="submit" name="aPerfil" value="Actualizar Perfil">
        </form>

        <!-- Modificar la contraseña -->
        <h2>Cambiar contraseña:</h2>
        <form action="" method="post" onsubmit="comprobarPass(this)">
            <input type="hidden" name="login" value='<?php echo $datos['login']; ?>'>
            <label for="password">Contraseña actual:</label><br>
            <input type="password" name="antigua" id="antigua" required><br>
            <label for="pass">Contraseña nueva:</label><br>
            <input type="password" name="nueva" id="nueva" required><br>
            <label for="repass">Repite la nueva contraseña:</label><br>
            <input type="password" name="repe" id="repe" required><br>
            <input type="submit" name="aContrasena" value="Cambiar">
        </form>
        <!-- Script para comprobar que la nueva contraseña coincide en los 2 campos -->
        <script>
            function comprobarPass(form) {
                if (this.nueva.value != this.repe.value) {
                    alert("Las contraseñas no coinciden");
                    return false;
                } else {
                    return true;
                }
            }
        </script>
</main>