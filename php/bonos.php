<?php session_start();

require_once("gestion/gestionBD.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");
require_once("gestion/gestionPases.php");



$conexion = crearConexionBD();

$todosLosBonos = consultarTodosBonos ($conexion);


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Gamers Zone</title>
		<!--<link href="FUENTE" rel="font"> REVISAR FUENTE-->
		<link rel="stylesheet" type="text/css" href="css.css">
		<link rel="icon" type="image/x-icon" href="faviconURL">
	</head>
	<body>

    <?php include_once ("cabecera.php"); ?>

		<div class="grid-container-bonos">

            <?php

            if (empty($todosLosBonos)) { ?> <?php } else {

                $count = 0;

                foreach ($todosLosBonos as $b ) {

                    $count = $count +1;

                $bonoId = $b ["BONOS_ID"];
                $bonoAvailable = $b ["DISPONIBLE"];

                if (isset($bonoId))$todosLosConsumibles = consultarConsumiblesDeBono ($conexion, $bonoId);
                if (isset($bonoId))$todosLosPases = consultarPasesDeBono ($conexion, $bonoId);



             ?>
                    <?php if ($count%2 == 1) { ?>

				<div class="subgrid" id="c1">
					<img src="imagenes\Telegram.png">
					<div id="left">
						<h3><?php print ($b ["NOMBREBONO"]) ?></h3>
						<ul>

                            <h4> Consumibles:</h4>

                        <?php if (isset ($todosLosConsumibles)) foreach ($todosLosConsumibles as $c) { ?>
							<li><?php print ($c["NOMBRECONSUMIBLE"]) ?> </li>
                            <?php } ?>

                            <h4> Pases:</h4>

                            <?php if (isset ($todosLosPases)) foreach ($todosLosPases as $c) { ?>
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
                                <h3><?php print ($b ["NOMBREBONO"]) ?></h3>
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

			<?php } }

            cerrarConexionBD($conexion);

?>

		</div>
	</body>
</html>
