<?php
session_start();

if (file_exists("./config.php") && isset($_SESSION['instalacion'])) {
    $mostrarLogin = true;
} else {
    $mostrarLogin = false;
}

if (isset($_POST['Enviar'])) {
    if (is_null($_POST['host']) || is_null($_POST['Usuario']) || is_null($_POST['password']) || is_null($_POST['nombreDB']) || is_null($_POST['puertoDB'])) {
        echo "Error: alguna de las credenciales no es valida o no han sido introducidas";
    } else {

        $host = $_POST['host'];
        $user = $_POST['Usuario'];
        $password = $_POST['password'];
        $nombreDB = $_POST['nombreDB'];
        $puertoDB = $_POST['puertoDB'];

        try {
            $conexion = new mysqli($host, $user, $password, $nombreDB, $puertoDB);

            if ($conexion->connect_error) {
                throw new Exception("Ha habido un error en la conexion");
            }

            echo "Conexion iniciada correctamente";

            $ruta = substr($_SERVER['HTTP_REFERER'], 0, -12);

            $config = <<<CONFIG
            <?php
                define("HOST", "$host");
                define("USUARIO", "$user");
                define("PASSWORD", "$password");
                define("BASEDATOS", "$nombreDB");
                define("PUERTO", "$puertoDB");
            ?>
            CONFIG;

            file_put_contents("./config.php", $config);

            $sql = [];
            $sql['usuarios'] = <<<SQL
                CREATE TABLE IF NOT EXISTS usuarios (
                    nombre VARCHAR(50) NOT NULL,
                    apellidos VARCHAR(100) NOT NULL,
                    login VARCHAR(50) NOT NULL PRIMARY KEY,
                    password VARCHAR(255) NOT NULL,
                    salt VARCHAR(8) NOT NULL,
                    rol ENUM('admin','registrado', 'bibliotecario') NOT NULL DEFAULT 'registrado'
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            SQL;

            $sql['autores'] = <<<SQL
                CREATE TABLE IF NOT EXISTS autores (
                    idAutor INT UNSIGNED NOT NULL,
                    Nombre VARCHAR(100) NOT NULL,
                    Apellidos VARCHAR(250) NOT NULL,
                    Pais VARCHAR(50) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de autores';
            SQL;

            $sql['libros'] = <<<SQL
                CREATE TABLE IF NOT EXISTS libros (
                    idLibro INT UNSIGNED NOT NULL,
                    titulo VARCHAR(250) NOT NULL,
                    genero ENUM('Narrativa','Lírica','Teatro','Científico-Técnico') NOT NULL,
                    idAutor INT UNSIGNED DEFAULT NULL,
                    numeroPaginas INT UNSIGNED NOT NULL,
                    numeroEjemplares INT UNSIGNED NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de libros';
            SQL;

            foreach ($sql as $clave => $consulta) {
                if (!$conexion->query($consulta)) {
                    throw new Exception("Error al crear la tabla $clave: " . $conexion->error);
                }
            }

            $conexion->query("alter table `autores` add primary key(`idAutor`);");
            $conexion->query("alter table `autores` modify `idAutor`int UNSIGNED NOT NULL AUTO_INCREMENT;");

            $conexion->query("alter table `libros` add primary key(idLibro), add key `idAutor`(idAutor);");
            $conexion->query("alter table `libros` add constraint `librosAutor` foreign key (`idAutor`) references autores(`idAutor`) on delete set null on update cascade;");
            $conexion->query("alter table `libros` change `idLibro` `idLibro` int UNSIGNED NOT NULL AUTO_INCREMENT;");

            echo "<h1>Tablas creadas correctamente</h1>";
            $_SESSION['instalacion'] = true;
            $mostrarLogin = true;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (isset($_POST['crear']) && $mostrarLogin && isset($_SESSION['instalacion'])) {
    require_once './config.php';
    $conexion = new mysqli(HOST, USUARIO, PASSWORD, BASEDATOS, PUERTO);

    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellidos = $conexion->real_escape_string($_POST['apellidos']);
    $login = $conexion->real_escape_string($_POST['login']);
    $password = $conexion->real_escape_string($_POST['password']);
    $salt = random_int(10000000, 99999999);
    $hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT);

    $sqlInsert = <<<SQL
        insert INTO usuarios (nombre, apellidos, login, password, salt, rol)
        VALUES ('$nombre', '$apellidos', '$login', '$hashedPassword', '$salt', 'admin');
    SQL;

    if ($conexion->query($sqlInsert)) {
        header("Location: ./index.php");
        echo "Usuario administrador creado correctamente.";
        
    } else {
        echo "Error al crear el usuario administrador: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <header>
        <h1>Instalacion de aplicacion</h1>
    </header>

    <main>
        <?php if (!$mostrarLogin): ?>
            <form action="" method="post">
                <fieldset>
                    <legend>Configuración de Base de Datos</legend>

                    <label for="host">Host:
                        <input type="text" name="host" id="host" required>
                    </label><br>

                    <label for="Usuario">Usuario:
                        <input type="text" name="Usuario" id="Usuario" required>
                    </label><br>

                    <label for="password">Contraseña:
                        <input type="password" name="password" id="password" required>
                    </label><br>

                    <label for="nombreDB">Nombre de la Base de Datos:
                        <input type="text" name="nombreDB" id="nombreDB" required>
                    </label><br>

                    <label for="puertoDB">Puerto:
                        <input type="text" name="puertoDB" id="puertoDB" required>
                    </label><br>

                    <input type="submit" name="Enviar" value="Enviar">
                </fieldset>
            </form>

        <?php else: ?>

            <h2>Creación del Usuario Administrador</h2>
            <form action="" method="post">
                <fieldset>
                    <legend>Primer Usuario Administrador</legend>

                    <label for="nombre">Nombre:
                        <input type="text" name="nombre" id="nombre" required>
                    </label><br>

                    <label for="apellidos">Apellidos:
                        <input type="text" name="apellidos" id="apellidos" required>
                    </label><br>

                    <label for="login">Login:
                        <input type="text" name="login" id="login" required>
                    </label><br>

                    <label for="password">Contraseña:
                        <input type="password" name="password" id="password" required>
                    </label><br>

                    <input type="submit" name="crear" value="crear">
                </fieldset>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>
