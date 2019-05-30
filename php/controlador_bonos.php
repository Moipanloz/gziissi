<?php
session_start();

if (isset($_REQUEST["CONSUMIBLES_ID"])){
    $CONSUMIBLE_ID = $_REQUEST["CONSUMIBLES_ID"];

    $_SESSION["CONSUMIBLES_ID"] = $CONSUMIBLE_ID;

    if (isset($_REQUEST["anadir_c"])) Header("Location: accion/accion_anadir_consumible_a_bono.php");
    else if (isset($_REQUEST["borrar_c"])) Header("Location: accion/accion_borrar_consumible_de_bono.php");
}
else Header("Location: bonos_admin.php");

