<?php
session_start();

if (!isset($_SESSION['registrado']) || !isset($_SESSION['administrador']) || !isset($_SESSION['bibliotecaro'])) {
    header('Location: ./vistaLogin.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
</head>
<body>
    <h1>Bienvenido a tu perfil</h1>

    <nav>
        <section>
            <!-- imagen para el perfil -->
        </section>
    </nav>

    <main>
        <h2>Opciones</h2>

        <ul>
            <li>
                <!-- modificar usuario -->
            </li>
            <li>
                <!-- cerrar sesión -->
            </li>
        </ul>
    </main>
</body>
</html>