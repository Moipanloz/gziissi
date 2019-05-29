<?php
session_start();

if (isset($_REQUEST["CONSUMIBLES_ID"]) && isset($_REQUEST["BONOS_ID"])) {

    $CONSUMIBLES_ID = $_REQUEST ["CONSUMIBLES_ID"];
    $BONO_ID = $_REQUEST ["BONOS_ID"];

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();
    $excepcion = anadirConsumibleABono($conexion,$CONSUMIBLES_ID,$BONO_ID);

    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "bonos_admin.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../modificar_bonos_admin.php");
}
else Header("Location: ../bonos_admin.php"); // Se ha tratado de acceder directamente a este PHP
