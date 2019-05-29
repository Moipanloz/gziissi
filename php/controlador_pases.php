<?php
session_start();

if (isset($_REQUEST["PASES_ID"])){
    $PASE["PASES_ID"] = $_REQUEST["PASES_ID"];
    $PASE["TIPOMEDIO"] = $_REQUEST["TIPOMEDIO"];

    $_SESSION["PASE"] = $PASE;

    if (isset($_REQUEST["cancelar"])) {
        unset($_SESSION ["PASE"]);
        Header("Location: pases_admin.php");
    }
    else if (isset($_REQUEST ["nuevo"])) Header("Location: accion/accion_crear_pase.php");
    else if (isset($_REQUEST["editar"])) Header("Location: pases_admin.php");
    else if (isset($_REQUEST["grabar"])) Header("Location: accion/accion_modificar_pase.php");
    else if (isset($_REQUEST["borrar"])) Header("Location: accion/accion_borrar_pase.php");
}
else Header("Location: pases_admin.php");


