<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Modificar bonos</title>
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

if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");


$conexion = crearConexionBD();

if (isset ($_REQUEST["BONOS_ID"]) || isset ($_SESSION ["BONO"])) {

//Se llega por primera vez desde bonos_admin
//Se construye el objeto Bono y se pasa a $_SESSION
if (isset ($_REQUEST["BONOS_ID"])) {

    $BONO ["BONOS_ID"] = $_REQUEST ["BONOS_ID"];
    $BONO ["PRECIOBONO"] = $_REQUEST ["PRECIOBONO"];
    $BONO ["NOMBREBONO"] = $_REQUEST ["NOMBREBONO"];
    $BONO ["DISPONIBLE"] = $_REQUEST ["DISPONIBLE"];

    $_SESSION ["BONO"] = $BONO;

    //Se llega tras añadir un consumible o pase
} else if (isset ($_SESSION ["BONO"]))
    $BONO = $_SESSION ["BONO"];


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

        <?php

        if (isset ($_SESSION ["saved_succesfully"])) {


            print ("<div>" . $_SESSION ["saved_succesfully"] . "</div>");


            unset($_SESSION["saved_succesfully"]);

        }

        ?>

        <div class="admin_class">

            <?php if (isset ($_REQUEST ["modificando_datos"])) { ?>

                <form autocomplete="off" method="post" action="accion/accion_modificar_datos_bono.php">

                    <h3>Id del bono: <?php print $BONO ["BONOS_ID"] ?></h3>
                    <div>
                        <h3>Nombre:<input maxlength="20" id="NOMBREBONO" name="NOMBREBONO" type="text"
                                          value="<?php print ($BONO ["NOMBREBONO"]) ?>"/>
                        </h3>

                        <h4>Precio:<input maxlength="5" id="PRECIOBONO" name="PRECIOBONO" type="text"
                                          value="<?php print ($BONO ["PRECIOBONO"]) ?>"/>
                            euros</h4>

                        <h4> Disponible:</h4>
                        <input type="checkbox" name="DISPONIBLE" value="TRUE"
                            <?php if ($BONO ["DISPONIBLE"] == "TRUE") print " checked"; ?>></h4>

                    </div>

                    <button id="guardar" name="guardar" type="submit">

                        Guardar

                    </button>

                </form>

            <?php } else { ?>

                <h3>Id del bono: <?php print $BONO ["BONOS_ID"] ?></h3>
                <div>

                    <h3>Nombre: <?php print ($BONO ["NOMBREBONO"]) ?></h3>

                    <h4>Precio: <?php print ($BONO ["PRECIOBONO"]) ?> euros</h4>

                    <h4> Disponible: <?php (isset($BONO ["DISPONIBLE"])&&$BONO["DISPONIBLE"]!="FALSE") ? print "True" : print "False"; ?></h4>

                </div>

                <form method="post" action="modificar_bonos_admin.php">

                    <button id="modificando_datos" name="modificando_datos" type="submit">

                        Modificar datos

                    </button>

                </form>

            <?php } ?>


        </div>

        <?php if (!$BONO ["DISPONIBLE"] != "TRUE") { ?>
        <div>Para modificar el contenido del bono, por favor desactívelo antes.</div>
        <?php }?>


        <div class="admin_class">

            <?php if ($BONO ["DISPONIBLE"] != "TRUE") { ?>


                    <h4>Consumibles:</h4>

                    <?php

                    if (!isset($lineasConsumiblesDelBono) || $lineasConsumiblesDelBono == null ) { ?>

                        El bono no contiene ningun consumible.

                    <?php } else {

                        foreach ($lineasConsumiblesDelBono as $lc) { ?>

                            <form autocomplete="off" method="post" action="controlador_bonos.php">


                            <h5><?php print ($lc ["NOMBRECONSUMIBLE"] . " - " . $lc ["CANTIDADLC"]) ?></h5>

                            <input type="hidden" value = "<?php print ($lc["LINEACONSUMIBLES_ID"]) ?>" name="LINEACONSUMIBLES_ID"/>

                            <input type="submit" value="Borrar" name="borrar_c"/>

                            </form>


                        <?php }
                    } ?>



                <form autocomplete="off" method="post" action="controlador_bonos.php">


                <select name="CONSUMIBLES_ID">
                        <?php foreach ($allConsumibles as $c) { ?>
                            <option name="CONSUMIBLES_ID"

                                    <?php if (isset ($_SESSION ["CONSUMIBLES_ID"])&&($_SESSION ["CONSUMIBLES_ID"] == $c ["CONSUMIBLES_ID"])) print (" selected ") ?>

                                    value="<?php print $c ["CONSUMIBLES_ID"] ?>"><?php print $c ["NOMBRECONSUMIBLE"] ?></option>
                        <?php } ?>
                    </select>

                    <input type="submit" value="Añadir" name="anadir_c"/>

                </form>

            <?php } else {

                ?>

                <h4>Consumibles:</h4>

                <?php

                if ($lineasConsumiblesDelBono == null || !isset($lineasConsumiblesDelBono)) { ?>

                    El bono no contiene ningun consumible.

                <?php } else {

                    foreach ($lineasConsumiblesDelBono as $lc) { ?>

                        <h5><?php print ($lc ["NOMBRECONSUMIBLE"] . " - " . $lc ["CANTIDADLC"]) ?></h5>

                    <?php }
                }

            } ?>

        </div>






        <div class="admin_class">

            <?php if ($BONO ["DISPONIBLE"] != "TRUE") { ?>

                <h4>Pases:</h4>

                <?php

                if ($lineasPasesDelBono == null || !isset($lineasPasesDelBono)) { ?>

                    El bono no contiene ningun pase.

                <?php } else {

                    foreach ($lineasPasesDelBono as $lp) { ?>

                        <form autocomplete="off" method="post" action="controlador_bonos.php">

                            <h5><?php print ($lp ["TIPOMEDIO"] . " - " . $lp ["CANTIDADLP"]) ?></h5>

                            <input type="hidden" value = "<?php print ($lp["LINEAPASES_ID"]) ?>" name="LINEAPASES_ID"/>

                            <input type="submit" value="Borrar" name="borrar_P"/>

                        </form>

                    <?php }
                } ?>



                <form autocomplete="off" method="post" action="controlador_bonos.php">


                    <select name="PASES_ID">
                        <?php foreach ($allPases as $p) { ?>
                            <option name="PASES_ID"

                                <?php if (isset ($_SESSION ["PASES_ID"])&&($_SESSION ["PASES_ID"] == $p ["PASES_ID"])) print (" selected ") ?>

                                    value="<?php print $p ["PASES_ID"] ?>"><?php print $p ["TIPOMEDIO"] ?></option>
                        <?php } ?>
                    </select>

                    <input type="submit" value="Añadir" name="anadir_p"/>

                </form>

            <?php } else {

                ?>

                <h4>Pases:</h4>

                <?php

                if ($lineasPasesDelBono == null || !isset($lineasPasesDelBono)) { ?>

                    El bono no contiene ningun pase.

                <?php } else {

                    foreach ($lineasPasesDelBono as $lp) { ?>

                        <h5><?php print ($lp ["TIPOMEDIO"] . " - " . $lp ["CANTIDADLP"]) ?></h5>

                    <?php }
                }

            } ?>

        </div>



    </div>

</div>

</body>
</html>

<?php } else {

    Header("Location: bonos_admin.php");

}
