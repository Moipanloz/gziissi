<?php
require_once("gestion/gestionBD.php");
require_once("gestion/gestionTorneos.php");

$conexion = crearConexionBD();

$todosLosTorneos = consultarTodosTorneos($conexion);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <!--<link href="FUENTE" rel="font"> REVISAR FUENTE-->
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" type="image/x-icon" href="faviconURL">
</head>
<body>
<?php include_once("cabecera.php") ?>
<div>
    <h1 id="torneos">Torneos</h1>
    <p id="torneos">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
        in culpa qui officia deserunt mollit anim id est laborum</p>

    <div class="grid-container-torneos"> <!-- Esto iría dentro de un carrusel-->

        <?php

        if (!is_null($todosLosTorneos)) { ?>

            <p id="torneos">No tournaments are currently open.</p>

        <?php } else {
            foreach ($todosLosTorneos as $t) { ?>

                <!-- TODO Hay que modificar tablas para meter url a imagenes para torneos y bonos y descripcion a torneos -->
                <img src="imagenes\Telegram.png">
                <div>
                    <h3><?php print $t ["NOMBRETORNEO"] ?></h3>
                    <p>Moi inutil que los torneos no tienen descripcion ni imagen y nos vas a hacer modificar las tablas
                        en sql pa ponerselas. Los bonos tampoco tienen imagen reputo.</p>
                    <form>
                        <input type="submit" value="Apúntate">
                    </form>
                </div>

            <?php }
        } ?>

    </div>

</div>
</body>
</html>
