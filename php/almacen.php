<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Mi almacén</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>
<body>

<?php include_once("cabecera.php");

if (!isset ($_SESSION["login_dni"])) {
    Header:
    "Location: index.php";
} else {

require_once("gestion/gestionBD.php");
require_once("gestion/gestionAlmacenes.php");

$conexion = crearConexionBD();

$consumiblesUsuario = consumiblesDeUsuario($conexion, $_SESSION ["login_dni"]);

$pasesUsuario = pasesDeUsuario($conexion, $_SESSION ["login_dni"]);

cerrarConexionBD($conexion);


?>

<h2 class="titulo">Mi almacén</h2>


<div class="divCentro">

    <h4 style="margin-top:0;"> Consumibles:</h4>

    <?php if ($consumiblesUsuario != null) foreach ($consumiblesUsuario as $c) { ?>
        <p><?php print ($c["NOMBRECONSUMIBLE"] . " - " . $c["CANTIDADCONSUMIBLE"]) ?> </p>
    <?php } else { ?>

        <p>No tienes consumibles</p>

    <?php } ?>

    <h4> Pases:</h4>

    <?php if ($pasesUsuario != null) foreach ($pasesUsuario as $p) { ?>
        <p><?php print ($p["TIPOMEDIO"] . " - " . $p["CANTIDADPASE"]) ?> </p>
    <?php } else { ?>

        <p>No tienes pases.</p>

    <?php }
    } ?>

</div>
</body>
</html>
