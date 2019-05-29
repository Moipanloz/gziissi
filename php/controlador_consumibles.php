<?php
session_start();

if (isset ($_REQUEST ["nuevo"])) {
    $_SESSION ["nuevo"] = $_REQUEST ["nuevo"];
    Header("Location: accion_crear_consumible.php");
}
else if (isset($_REQUEST["CONSUMIBLES_ID"])){
    $CONSUMIBLE["CONSUMIBLES_ID"] = $_REQUEST["CONSUMIBLES_ID"];
    $CONSUMIBLE["NOMBRECONSUMIBLE"] = $_REQUEST["NOMBRECONSUMIBLE"];
    $CONSUMIBLE["TIPOCONSUMIBLE"] = $_REQUEST["TIPOCONSUMIBLE"];

    $_SESSION["CONSUMIBLE"] = $CONSUMIBLE;

    if (isset($_REQUEST["editar"])) Header("Location: consumibles_admin.php");
    else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_consumible.php");
    else  if (isset($_REQUEST["borrar"])) Header("Location: accion_borrar_consumible.php");
}
else Header("Location: consumibles_admin.php");


