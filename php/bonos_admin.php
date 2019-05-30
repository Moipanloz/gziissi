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

require_once("gestion/gestionBD.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");
require_once("gestion/gestionPases.php");

$conexion = crearConexionBD();


if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");


$todosLosBonos = consultarTodosBonos($conexion);

if (isset ($_SESSION ["BONO"])) unset ($_SESSION ["BONO"]);


?>

<body>



<div>
    <h2 class="titulo">Administración Bonos</h2>
    <div class="admin_class">


        <?php foreach ($todosLosBonos

                       as $fila) { ?>

            <article class="bonos">

                <form method="post" action="modificar_bonos_admin.php" autocomplete="off">

                    <div class="fila_bonos">

                        <div class="datos_bonos">

                            <input id="BONOS_ID" name="BONOS_ID" type="hidden"
                                   value="<?php echo $fila["BONOS_ID"]; ?>"/>

                            <input id="NOMBREBONO" name="NOMBREBONO" type="hidden"
                                   value="<?php echo $fila["NOMBREBONO"]; ?>"/>

                            <input id="PRECIOBONO" name="PRECIOBONO" type="hidden"
                                   value="<?php echo $fila["PRECIOBONO"]; ?>"/>

                            <input id="DISPONIBLE" name="DISPONIBLE" type="hidden"
                                   value="<?php echo $fila["DISPONIBLE"]; ?>"/>

                            <div class="nombre">
                                <b><?php print ($fila["NOMBREBONO"] . " - " . $fila ["PRECIOBONO"] . " euros"); ?></b>
                            </div>

                            <div class="tipo">
                                <em><?php if ($fila["DISPONIBLE"] == "TRUE") print ("Disponible"); else print ("No disponible"); ?></em>
                            </div>


                        </div>

                        <div id="botones_fila">

                            <button id="editar" name="editar" type="submit" class="editar_fila">

                                <!--<img src="imagenes/pencil_menuito.bmp" class="editar_fila" alt="Editar consumible">
                                -->
                                Editar

                            </button>


                        </div>

                    </div>

                </form>

            </article>

        <?php } ?>


    </div>

</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>
