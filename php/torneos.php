<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Torneos</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>
<body>
<?php include_once("cabecera.php") ?>
<div>

    <?php
    require_once("gestion/gestionBD.php");
    require_once("gestion/gestionTorneos.php");

    $conexion = crearConexionBD();
    $todosLosTorneos = consultarTodosTorneos($conexion);
    ?>
    <h1 class="titulo">Torneos</h1>

    <p id="torneos">Aquí puedes ver cuáles son los torneos disponibles actualmente en los que
    te puedes registrar.</p>

    <div> <!--class="grid-container-torneos"--> <!-- Esto iría dentro de un carrusel-->

        <?php

        if (is_null($todosLosTorneos)) { ?>

            <p style="text-align: center;">No hay torneos actualmente.</p>

        <?php } else {

             foreach ($todosLosTorneos as $t) { ?>


        <div class="grid-torneo" id="c1">
            <div id="left">
                <h2><?php print $t ["NOMBRETORNEO"] ?></h2>
                <ul>
                    <li><strong>Juego: </strong><?php print $t["VIDEOJUEGO"] ?></li>
                    <li><strong>Precio: </strong><?php print $t["PRECIOTORNEO"] ?>€</li>
                    <li><strong>Fecha: </strong><?php print $t["FECHATORNEO"] ?></li>
                    <li><strong>Número máximo de participantes: </strong><?php print $t["MAXPARTICIPANTES"] ?></li>
                </ul>
            </div>
            <div>
                <?php

                if (isset($_SESSION["login_dni"])) {
                    $participando = estaParticipando($conexion, $_SESSION["login_dni"], $t ["TORNEOS_ID"]);
                }

                if (isset ($participando)) {

                if ($participando == 0)  /*Si no está participando*/ { ?>
                <form class="centro" method="post" action="accion/accion_alta_torneo.php">
                    <input type="hidden" name="TORNEOS_ID" id="TORNEOS_ID"
                           value="<?php echo $t["TORNEOS_ID"]; ?>">
                    <input class="boton" type="submit" id="joinTorneo" name="joinTorneo" value="Apúntate">
                </form>

                <?php } else {  /*Ya esta participando*/ ?>

                <!-- TODO Boton de quitarse de torneo -->
                <p>Ya estás participando en este torneo.</p>
                <?php }

                }?>
            </div>
        </div>



         <?php   }
        } ?>

    </div>

</div>
</body>
</html>
