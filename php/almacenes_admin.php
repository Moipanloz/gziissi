<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Adm. Almacenes</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");

require_once("gestion/gestionBD.php");
require_once("gestion/gestionUsuarios.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");
require_once("gestion/gestionPases.php");
require_once("gestion/gestionAlmacenes.php");

if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");

$conexion = crearConexionBD();

$allUsers = consultarTodosUsuarios($conexion);


if (isset ($_REQUEST ["change_user"])) {

    $_SESSION ["DNI"] = $_REQUEST ["DNI"];

    unset($_SESSION ["PASES_ID"]);
    unset ($_SESSION ["CONSUMIBLES_ID"]);
} else if (!isset ($_SESSION["DNI"]))
    $_SESSION["DNI"] = $allUsers->fetch() ["DNI"];

$conexion = crearConexionBD();

$allUsers = consultarTodosUsuarios($conexion);

$allConsumibles = consultarTodosConsumibles($conexion);

$allPases = consultarTodosPases($conexion);

cerrarConexionBD($conexion);


?>

<body>


<div>
    <h2 class="titulo">Administración de Almacenes</h2>
    <div class="divCentro">

        <article>
        <form method="post" action="almacenes_admin.php">


            <select name="DNI">

                <?php

                foreach ($allUsers as $u) {

                    if ($u ["DNI"] != '00000000A') {

                        ?>

                        <option name="DNI" <?php if ((isset ($_SESSION ["DNI"])) && ($_SESSION ["DNI"] == $u["DNI"])) print "selected" ?>
                                value="<?php print $u["DNI"] ?>"><?php print $u ["NOMBRE"] ?>

                        </option>

                        <?php

                    }
                }

                ?>

            </select>

            <input class="boton" type="submit" name="change_user" value="Actualizar">

        </form>


            <p style="margin-top:3%;"><strong>El usuario contiene en su almacen los siguientes consumibles:</strong></p>

        <?php

        $consumiblesDeUsuario = consumiblesDeUsuario($conexion, $_SESSION["DNI"]);

        foreach ($consumiblesDeUsuario as $c) {

            ?>

            <form style="margin: 3% 0;" autocomplete="off" method="post" action="controlador_almacenes.php">


                <p style="width:auto;"><?php print ($c ["NOMBRECONSUMIBLE"] . " - " . $c ["CANTIDADCONSUMIBLE"]) ?></p>

                <input type="hidden" value="<?php print ($c["ALMACENESCONSUMIBLES_ID"]) ?>"
                       name="ALMACENESCONSUMIBLES_ID"/>

                <input style="margin-top:3%;" class="boton" type="submit" value="Borrar" name="borrar_c"/>

            </form>


            <?php

        }

        ?>

        <form autocomplete="off" method="post" action="controlador_almacenes.php">


            <select name="CONSUMIBLES_ID">
                <?php foreach ($allConsumibles as $c) { ?>
                    <option name="CONSUMIBLES_ID"

                        <?php if (isset ($_SESSION ["CONSUMIBLES_ID"]) && ($_SESSION ["CONSUMIBLES_ID"] == $c ["CONSUMIBLES_ID"])) print (" selected ") ?>

                            value="<?php print $c ["CONSUMIBLES_ID"] ?>"><?php print $c ["NOMBRECONSUMIBLE"] ?></option>
                <?php } ?>
            </select>

            <input class="boton" type="submit" value="Añadir" name="anadir_c"/>

        </form>


            <p style="margin: 3% 0;"><strong>El usuario contiene en su almacen los siguientes pases:</strong></p>

        <?php

        $pasesDeUsuario = pasesDeUsuario($conexion, $_SESSION["DNI"]);

        foreach ($pasesDeUsuario as $p) {

            ?>

            <form autocomplete="off" method="post" action="controlador_almacenes.php">


                <p><?php print ($p ["TIPOMEDIO"] . " - " . $p ["CANTIDADPASE"]) ?></p>

                <input type="hidden" value="<?php print ($p["ALMACENESPASES_ID"]) ?>" name="ALMACENESPASES_ID"/>

                <input style="margin: 3% 0;" class="boton"  type="submit" value="Borrar" name="borrar_p"/>

            </form>


            <?php

        }

        ?>

        <form autocomplete="off" method="post" action="controlador_almacenes.php">


            <select name="PASES_ID">
                <?php foreach ($allPases as $p) { ?>
                    <option name="PASES_ID"

                        <?php if (isset ($_SESSION ["PASES_ID"]) && ($_SESSION ["PASES_ID"] == $p ["PASES_ID"])) print (" selected ") ?>

                            value="<?php print $p ["PASES_ID"] ?>"><?php print $p ["TIPOMEDIO"] ?></option>
                <?php } ?>
            </select>

            <input class="boton" type="submit" value="Añadir" name="anadir_p"/>

        </form>
        </article>
    </div>

</div>

</body>
</html>
