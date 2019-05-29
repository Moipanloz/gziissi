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

$conexion = crearConexionBD();

if (isset ($_REQUEST["BONOS_ID"])) {

    $BONO ["BONOS_ID"] = $_REQUEST ["BONOS_ID"];
    $BONO ["PRECIOBONO"] = $_REQUEST ["PRECIOBONO"];
    $BONO ["NOMBREBONO"] = $_REQUEST ["NOMBREBONO"];
    $BONO ["DISPONIBLE"] = $_REQUEST ["DISPONIBLE"];

    $_SESSION ["BONO"] = $BONO;


    $lineasConsumiblesDelBono = lineasConsumiblesDeBono($conexion, $BONO ["BONOS_ID"]);

    $lineasPasesDelBono = lineasPasesDeBono($conexion, $BONO ["BONOS_ID"]);

    $allConsumibles = consultarTodosConsumibles($conexion);

    $allPases = consultarTodosPases($conexion);

    cerrarConexionBD($conexion);


    ?>

    <body>

    <div>
        <h2 class="titulo">Administración Bonos</h2>
        <div>
            <div class="admin_class">

                <form autocomplete="off" method="post" action="accion/accion_modificar_datos_bono.php">

                    <h3>Id del bono: <?php print $BONO ["BONOS_ID"] ?></h3>
                    <div>
                        <h3>Nombre:<input maxlength="20" id="NOMBREBONO" name="NOMBREBONO" type="text"
                                          value="<?php print ($BONO ["NOMBREBONO"]) ?>" placeholder="Nombre del Bono"/>
                        </h3>

                        <h4>Precio:<input maxlength="2" id="PRECIOBONO" name="PRECIOBONO" type="text"
                                          value="<?php print ($BONO ["PRECIOBONO"]) ?>" placeholder="Precio del Bono"/>
                            euros</h4>

                        <h4> Disponible:<input type="checkbox" name="DISPONIBLE"
                                               <?php if ($BONO ["DISPONIBLE"] == "TRUE") print " checked";?>></h4>


                    </div>

                    <div>


                    </div>

                    <button id="guardar" name="guardar" type="submit">

                        Guardar

                    </button>

                </form>


            </div>

            <div class="admin_class">

                <form autocomplete="off" method="post" action="accion/accion_anadir_consumible_a_bono.php">

                    <h4>El pase contiene:</h4>

                    <input id="BONOS_ID" name="BONOS_ID" type="hidden"
                           value="<?php echo $BONO["BONOS_ID"]; ?>"/>

                    <?php

                    if ($lineasConsumiblesDelBono == null || !isset($lineasConsumiblesDelBono)) { ?>

                        El bono no contiene ningun consumible.

                    <?php } else {

                        foreach ($lineasConsumiblesDelBono as $lc) { ?>

                            <h5><?php print ($lc ["NOMBRECONSUMIBLE"] . " - " . $lc ["CANTIDADLC"]) ?></h5>

                        <?php }
                    } ?>

                    <select>
                        <?php foreach ($allConsumibles as $c) { ?>
                            <option name="CONSUMIBLES_ID"
                                    value="<?php print $c ["CONSUMIBLES_ID"] ?>"><?php print $c ["NOMBRECONSUMIBLE"] ?></option>
                        <?php } ?>
                    </select>

                    <button id="anadir_c" name="anadir_c" type="submit" class="editar_fila">

                        <!--<img src="imagenes/remove_menuito.bmp" class="editar_fila" alt="Borrar consumible">
-->
                        Añadir

                    </button>

                </form>

            </div>

        </div>

    </div>

    </body>


    <?php
}
 else {

    Header("Location: bonos_admin.php");

}

?>


