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
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
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

            if ($b ["DISPONIBLE"] == "TRUE") {

            $count = $count + 1;

            $bonoId = $b ["BONOS_ID"];
            $bonoAvailable = $b ["DISPONIBLE"];

            if (!is_null($bonoId)) $todosLosConsumibles = lineasConsumiblesDeBono($conexion, $bonoId);
            if (!is_null($bonoId)) $todosLosPases = lineasPasesDeBono($conexion, $bonoId);


            if ($count % 2 == 1) { ?>

                <div class="subgrid" id="c1">
                    <img src="imagenes\Telegram.png">
                    <div id="left">
                        <h3><?php print ($b ["NOMBREBONO"] . " - " . $b ["PRECIOBONO"] . " euros") ?></h3>
                        <ul>

                            <h4> Consumibles:</h4>

                            <?php if ($todosLosConsumibles != null) foreach ($todosLosConsumibles as $c) { ?>
                                <li><?php print ($c["NOMBRECONSUMIBLE"] . " - " . $c["CANTIDADLC"]) ?> </li>
                            <?php } else { ?>

                                <li>Este bono no contiene consumibles</li>

                            <?php } ?>

                            <h4> Pases:</h4>

                            <?php if ($todosLosPases != null) foreach ($todosLosPases as $p) { ?>
                                <li><?php print ($p["TIPOMEDIO"] . " - " . $p["CANTIDADLP"]) ?> </li>
                            <?php } else { ?>

                                <li>Este pase no contiene consumibles</li>

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

                            <?php if ($todosLosConsumibles != null) foreach ($todosLosConsumibles as $c) { ?>
                                <li><?php print ($c["NOMBRECONSUMIBLE"]) ?> </li>
                            <?php } else { ?>

                                <li>Este bono no contiene consumibles</li>

                            <?php } ?>

                            <h4> Pases:</h4>

                            <?php if ($todosLosPases != null) foreach ($todosLosPases as $p) { ?>
                                <li><?php print ($p["TIPOMEDIO"]) ?> </li>
                            <?php } else { ?>

                                <li>Este bono no contiene pases</li>

                            <?php } ?>

                        </ul>
                    </div>
                    <img src="imagenes\Telegram.png">
                </div>

            <?php } ?>

        <?php } }
    }

    cerrarConexionBD($conexion);

    ?>

</div>
</body>
</html>
