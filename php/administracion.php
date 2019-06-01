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
    <p>Texto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cu
        exto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuexto para que no aparezca pegado, cambiar cuando este done</p>
    <div class="boton_admin">
        <span>
            <a href="usuarios_admin.php">Usuarios</a>
        </span>
        <span>
            <a href="ventas_admin.php">Ventas</a>
        </span>
        <span>
            <a href="almacenes_admin.php">Almacenes de Usuarios</a>
        </span>

    </div>
</div>

</body>
</html>
