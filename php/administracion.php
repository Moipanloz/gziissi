<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");

require_once("gestion/gestionBD.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");
require_once("gestion/gestionPases.php");
require_once("gestion/gestionTorneos.php");

$conexion = crearConexionBD();


if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");



?>


<body>

<div>
    <h2 class="titulo">Administración</h2>
    <div class="boton_admin">
        <span>
            <a href="bonos_admin.php">Bonos</a>
        </span>
        <span>
            <a href="torneos_admin.php">Torneos</a>
        </span>
        <span>
            <a href="pases_admin.php">Pases</a>
        </span>
        <span>
            <a href="consumibles_admin.php">Consumibles</a>
        </span>
    </div>
    <div class="boton_admin">
        <span>
            <a href="usuarios_admin.php">Usuarios</a>
        </span>
        <span>
            <a href="lineasventa_admin.php">LineasVenta</a>
        </span>
        <span>
            <a href="almacenes_admin.php">Almacenes de Usuarios</a>
        </span>
    </div>
</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>
