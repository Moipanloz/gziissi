<?php
require_once("gestion/gestionBD.php");
require_once("gestion/gestionTorneos.php");

$conexion = crearConexionBD();

$todosLosTorneos = consultarTodosTorneos($conexion);

$usuario = $_SESSION["login_name"];

$dni = $usuario["login_dni"];
/*
$participando =  estaParticipando($conexion, $dni);*/

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Torneos</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png"  href="imagenes/favicon-32x32.png">
</head>
<body>
<?php include_once("cabecera.php") ?>
<div>
    <h1 class="titulo">Torneos</h1>

    <p id="torneos">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
        in culpa qui officia deserunt mollit anim id est laborum</p>

    <div class="grid-container-torneos"> <!-- Esto iría dentro de un carrusel-->

        <?php

        if (is_null($todosLosTorneos)) { ?>

            <p style="text-align: center;">No hay torneos actualmente.</p>

        <?php } else {
            foreach ($todosLosTorneos as $t) { ?>

                <h3><?php print $t ["NOMBRETORNEO"] ?></h3>
                <?php if(!isset($participando))  /*Si no está participando*/ {?>
                    <form method="post" action="accion/accion_alta_torneo.php">
                        <input type="hidden" name="DNI" id="DNI" value="<?php echo $dni?>"
                        <input type="hidden" name="TORNEOS_ID" id="TORNEOS_ID" value="<?php echo $t["TORNEOS_ID"];?>">
                        <input type="submit" id="joinTorneo" name="joinTorneo" value="Apúntate">
                    </form>

                <?php }else{  /*Ya esta participando*/ ?>
                    <p>Ya estás participando en este torneo.</p>
                <?php }   ?>



            <?php }
        } ?>

    </div>

</div>
</body>
</html>
