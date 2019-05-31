<?php
session_start();

print ($_REQUEST["CONSUMIBLES_ID_b"]);


if (isset($_SESSION["BONO"])) {

    if (isset($_REQUEST["anadir_c"])) {

        $CONSUMIBLE_ID = $_REQUEST["CONSUMIBLES_ID"];

        $_SESSION["CONSUMIBLES_ID"] = $CONSUMIBLE_ID;

        Header("Location: accion/accion_anadir_consumible_a_bono.php");

    } else if (isset($_REQUEST["borrar_c"])) {

        $LINEACONSUMIBLESID = $_REQUEST["LINEACONSUMIBLES_ID"];

        $_SESSION["LINEACONSUMIBLES_ID"] = $LINEACONSUMIBLESID;

        Header("Location: accion/accion_borrar_consumible_de_bono.php");
    }

    else if (isset($_REQUEST["anadir_p"])) {

        $PASE_ID = $_REQUEST["PASES_ID"];

        $_SESSION["PASES_ID"] = $PASE_ID;

        Header("Location: accion/accion_anadir_pase_a_bono.php");

    } else if (isset($_REQUEST["borrar_P"])) {

        $LINEAPASESID = $_REQUEST["LINEAPASES_ID"];

        $_SESSION["LINEAPASES_ID"] = $LINEAPASESID;

        Header("Location: accion/accion_borrar_pase_de_bono.php");
    }

} else Header("Location: bonos_admin.php");

