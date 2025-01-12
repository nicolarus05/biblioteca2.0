<?php
session_start();

//Comprobar que existe una sesión
if (!isset($_SESSION['registrado']) || !isset($_SESSION['administrador']) || !isset($_SESSION['bibliotecaro'])) {
    header('Location: ./vistaLogin.php');
    exit();
}

//Comprobar que se quiere cambiar la contraseña
if (isset($_POST['Cambiar'])) {
    $hash = $_POST['antigua'] . $datos['salt'];
    $nueva = $_POST['pass'];

    //problemas
    if (password_verify($hash, $datos['password'])) {
        $datos->modificarPwd($nueva);
        $success = "Contraseña actualizada correctamente.";
    } else {
        $mensaje = "Error, la antigua contraseña no es correcta.";
    }
}

?>

<main>
        <!-- Actualizar los datos del usuario -->
        <h2>Modificar mis datos</h2>
        <form action="" method="post">
            <input type="hidden" name="login" value='<?php echo $datos['login']; ?>'>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value='<?php echo $datos['nombre']; ?>'>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" value='<?php echo $datos['apellidos']; ?>'>
            <input type="submit" name="Actualizar" value="Actualizar">
        </form>

        <!-- Modificar la contraseña -->
        <h2>Cambiar contraseña:</h2>
        <form action="" method="post" onsubmit="comprobarPass(this)">
            <label for="password">Contraseña actual:</label><br>
            <input type="password" name="antigua" id="antigua" required><br>
            <label for="pass">Contraseña nueva:</label><br>
            <input type="password" name="nueva" id="nueva" required><br>
            <label for="repass">Repite la nueva contraseña:</label><br>
            <input type="password" name="repe" id="repe" required><br>
            <input type="submit" name="Cambiar" value="Cambiar">
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