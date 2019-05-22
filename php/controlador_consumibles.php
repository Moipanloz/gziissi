<?php
session_start();

if (isset($_REQUEST["CONSUMIBLES_ID"])){
    $consumible["CONSUMIBLES_ID"] = $_REQUEST["CONSUMIBLES_ID"];
    $consumible["NOMBRECONSUMIBLE"] = $_REQUEST["NOMBRECONSUMIBLE"];
    $consumible["TIPOCONSUMIBLE"] = $_REQUEST["TIPOCONSUMIBLE"];

    $_SESSION["consumible"] = $consumible;

    if (isset($_REQUEST["editar"])) Header("Location: consumibles_admin.php");
    else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_consumible.php");
    else  if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_consumible.php");
}
else
    Header("Location: consumibles_admin.php");


