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
    <h2 class="titulo">Administración Pases</h2>
    <div class="admin_class">
        <div class="grid-container-admin-class">
            <!--FOR EACH BONO HASTA MAXIMO DE 3 POR PAG-->
            <div>
                <!-- CUANDO ESTE EDITANDO -->
                <h3><input type="text" name="PASE" value="" id="PASE"/></h3>
                <ul>
                    <!-- FOR EACH ELEMENTO -->
                    <li>Elemento</li>
                    <!---->
                </ul>
                <!-- CUANDO SE MUESTRE -->
                <h3>NombreBono</h3>
                <ul>
                    <!-- FOR EACH ELEMENTO -->
                    <li>Elemento</li>
                    <!---->
                </ul>
                <!---->
                <!---->
                <div class="botones_administracion">
                    <!-- SI ESTA EDITANDO -->
                    <input id="guardar" name="guardar" type="submit" value="Guardar" class="boton_administracion">
                    <!-- SI NO -->
                    <input id="editar" name="editar" type="submit" value="Editar" class="boton_administracion">
                    <!---->
                    <input id="borrar" name="borrar" type="submit" value="Borrar" class="boton_administracion">
                </div>
            </div>

            <div>
                Pagniacion
            </div>
        </div>
    </div>
</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>
