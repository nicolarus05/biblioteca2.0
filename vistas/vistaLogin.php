<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>

    <!-- formulario -->
     <form action="" method="post">
        <!-- campo del login -->
        <label for="login">Login</label>
        <input type="text" name="login" placeholder="nombre de usuario" required />

        <br/><br/>

        <!-- campo de la contraseña -->
        <label for="password">Contraseña</label>
        <input type="password" name="clave" required />

        <br/><br/>

        <!-- botón de envío de datos -->
        <input type="submit" name="enviar" value="Iniciar sesión" />
     </form>

    <!-- código php -->
    <?php 

        //comprobar que se ha pulsado el botón de iniciar sesión
        if (isset($_POST['enviar'])) {
            //iniciar la sesión
            session_start();

            //conectar con la base de datos
            $bd = getConn(); //corregir esta línea
            
            //obtener los datos del formulario
            $login = $_POST['login'];
            $clave = $_POST['clave'];

            //buscar al usuario
            $sql = "SELECT * FROM usuarios WHERE login = :login";
            $stmt = $bd->prepare($sql);
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            //comprobar la contraseña
            $hashedPassword = hash('sha256', $clave . $usuario['salt']);

            if ($hashedPassword === $usuario['clave']) {
                //guardar la información del usuario en la sesión
                $_SESSION['login'] = $usuario['login'];
                $_SESSION['rol'] = $usuario['rol']; //guardar el rol

                //configurar variables de sesión específicas según el rol
                if ($_SESSION['rol'] === 'administrador') {
                    $_SESSION['administrador'] = true;
                } elseif ($_SESSION['rol'] === 'bibliotecario') {
                    $_SESSION['bibliotecario'] = true;
                } elseif ($_SESSION['rol'] === 'registrado') {
                    $_SESSION['registrado'] = true;
                }

                //redirigir al usuario según el rol
                switch ($_SESSION['rol']) {
                    case 'administrador':
                        header("Location: ./vistaUsuarios.php");
                        exit();
                    case 'bibliotecario':
                        header("Location: ./vistaLibros.php");
                        exit();
                    case 'registrado':
                        header("Location: ./vistaLibros.php");
                        exit();
                    default:
                        echo "<p>Error: Rol desconocido.</p>";
                        header("Location: ./vistaLogin.php");
                        exit();
                }
            } else {
                echo "<p>Error: Usuario o contraseña incorrectos.</p>";
            }

            //cerrar la conexión
            $stmt->close();
        }

    ?>

</body>
</html>