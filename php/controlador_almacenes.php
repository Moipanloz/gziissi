<?php
session_start();


if (isset($_SESSION["anadir_c"])) {

    $_SESSION ["CONSUMIBLES_ID"] = $_REQUEST ["CONSUMIBLES_ID"];

    Header("Location: accion/accion_anadir_consumible_a_usuario.php");

} else if (isset($_SESSION["anadir_p"])) {

    $_SESSION ["PASES_ID"] = $_REQUEST ["PASES_ID"];

    Header("Location: accion/accion_anadir_pase_a_usuario.php");


} else if (isset($_REQUEST["borrar_c"])) {

    $ALMACENESPASES_ID = $_REQUEST["ALMACENESPASES_ID"];

    $_SESSION["ALMACENESPASES_ID"] = $ALMACENESPASES_ID;

    Header("Location: accion/accion_borrar_consumible_de_usuario.php");

} else if (isset($_REQUEST["borrar_p"])) {

    $LINEAPASES_ID = $_REQUEST["LINEAPASES_ID"];

    $_SESSION["LINEAPASES_ID"] = $LINEAPASES_ID;

    Header("Location: accion/accion_borrar_pase_de_usuario.php");

} else Header("Location: almacenes_admin.php");

