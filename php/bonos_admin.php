<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");

require_once("gestion/gestionBD.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");
require_once("gestion/gestionPases.php");
require_once("gestion/gestionTorneos.php");

$conexion = crearConexionBD();


/*if (!isset($_SESSION ["ADMIN"]))

    Header("Location: index.php");

*/

?>


<body>

<div>
    <h2 class="titulo">Administración Bonos</h2>
    <div class="admin_class">
        <div class="grid-container-admin-class">




        </div>
    </div>
</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>
