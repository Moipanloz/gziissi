<?php

session_start();

if (isset($_REQUEST["anadir_c"])) {

    $_SESSION ["CONSUMIBLES_ID"] = $_REQUEST ["CONSUMIBLES_ID"];

    Header("Location: accion/accion_anadir_consumible_a_usuario.php");

} else if (isset($_REQUEST["anadir_p"])) {

    $_SESSION ["PASES_ID"] = $_REQUEST ["PASES_ID"];

    Header("Location: accion/accion_anadir_pase_a_usuario.php");


} else if (isset($_REQUEST["borrar_c"])) {

    $ALMACENESCONSUMIBLES_ID = $_REQUEST["ALMACENESCONSUMIBLES_ID"];

    $_SESSION["ALMACENESCONSUMIBLES_ID"] = $ALMACENESCONSUMIBLES_ID;

    Header("Location: accion/accion_borrar_consumible_de_usuario.php");

} else if (isset($_REQUEST["borrar_p"])) {

    $ALMACENESPASES_ID = $_REQUEST["ALMACENESPASES_ID"];

    $_SESSION["ALMACENESPASES_ID"] = $ALMACENESPASES_ID;

    Header("Location: accion/accion_borrar_pase_de_usuario.php");

} else Header("Location: ../test.php");

