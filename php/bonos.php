<?php

require_once("gestion/gestionBD.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");
require_once("gestion/gestionPases.php");


$conexion = crearConexionBD();

$todosLosBonos = consultarTodosBonos($conexion);


?>

<!DOCTYPE html>
<html lang="es">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gamers Zone</title>
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css.css">
        <link rel="icon" type="image/png"  href="imagenes/favicon-32x32.png">
	</head>
	<body>

<?php include_once("cabecera.php"); ?>

<div class="grid-container-bonos">

    <?php

    if (is_null($todosLosBonos)) { ?>

        <h4>No hay ningún bono disponible.</h4>

    <?php } else {

        $count = 0;

        foreach ($todosLosBonos as $b) {

            $count = $count + 1;

            $bonoId = $b ["BONOS_ID"];
            $bonoAvailable = $b ["DISPONIBLE"];

            if (!is_null($bonoId)) $todosLosConsumibles = consultarConsumiblesDeBono($conexion, $bonoId);
            if (!is_null($bonoId)) $todosLosPases = consultarPasesDeBono($conexion, $bonoId);


            if ($count % 2 == 1) { ?>

                <div class="subgrid" id="c1">
                    <img src="imagenes\Telegram.png">
                    <div id="left">
                        <h3><?php print ($b ["NOMBREBONO"] . " - " . $b ["PRECIOBONO"] . " euros") ?></h3>
                        <ul>

                            <h4> Consumibles:</h4>

                            <?php foreach ($todosLosConsumibles as $c) { ?>
                                <li><?php print ($c["NOMBRECONSUMIBLE"]) ?> </li>
                            <?php } ?>

                            <h4> Pases:</h4>

                            <?php foreach ($todosLosPases as $c) { ?>
                                <li><?php print ($c["TIPOMEDIO"]) ?> </li>
                            <?php } ?>

                        </ul>
                    </div>
                    <form>
                        <input type="submit" value="Adquirir">
                    </form>
                </div>

            <?php } else { ?>

                <div class="subgrid" id="c2">
                    <form>
                        <input type="submit" value="Adquirir">
                    </form>
                    <div id="right">
                        <h3><?php print ($b ["NOMBREBONO"] . " - " . $b ["PRECIOBONO"] . " euros") ?></h3>
                        <ul>

                            <h4> Consumibles:</h4>

                            <?php foreach ($todosLosConsumibles as $c) { ?>
                                <li><?php print ($c["NOMBRECONSUMIBLE"]) ?> </li>
                            <?php } ?>

                            <h4> Pases:</h4>

                            <?php foreach ($todosLosPases as $c) { ?>
                                <li><?php print ($c["TIPOMEDIO"]) ?> </li>
                            <?php } ?>

                        </ul>
                    </div>
                    <img src="imagenes\Telegram.png">
                </div>

            <?php } ?>

        <?php }
    }

    cerrarConexionBD($conexion);

    ?>

</div>
</body>
</html>
