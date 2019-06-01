<?php
session_start();

if (isset($_REQUEST["TORNEOS_ID"])) {
    $TORNEO["TORNEOS_ID"] = $_REQUEST["TORNEOS_ID"];
    $TORNEO["NOMBRETORNEO"] = $_REQUEST["NOMBRETORNEO"];
    $TORNEO["PRECIOTORNEO"] = $_REQUEST["PRECIOTORNEO"];
    $TORNEO["VIDEOJUEGO"] = $_REQUEST["VIDEOJUEGO"];
    $TORNEO["MAXPARTICIPANTES"] = $_REQUEST["MAXPARTICIPANTES"];
    $TORNEO["FECHATORNEO"] = $_REQUEST["FECHATORNEO"];


    $_SESSION["TORNEO"] = $TORNEO;

    if (isset($_REQUEST["cancelar"])) {
        unset($_SESSION ["TORNEO"]);
        Header("Location: torneos_admin.php");
    } else if (isset ($_REQUEST ["nuevo"])) Header("Location: accion/accion_crear_torneo.php");
    else if (isset($_REQUEST["editar"])) Header("Location: torneos_admin.php");
    else if (isset($_REQUEST["grabar"])) Header("Location: accion/accion_modificar_torneo.php");
    else if (isset($_REQUEST["borrar"])) Header("Location: accion/accion_borrar_torneo.php");
} else Header("Location: torneos_admin.php");


