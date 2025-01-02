<?php

include './modelos/usuarios.php';
include './vistas/vista.php';
include './modelos/modelo.php';

//lógica para determinar qué mostrar
$accion = $_GET['accion'] ?? 'usuarios';

switch ($accion) {
    case 'usuarios':
        //qué hacer para mostrar los usuarios
        break;
    default:
        echo "Acción no válida";
}

?>