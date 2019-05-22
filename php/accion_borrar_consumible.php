<?php
session_start();

if (isset($_SESSION["consumible"])) {
    $consumible = $_SESSION["consumible"];
    unset($_SESSION["consumible"]);

    require_once("gestion/gestionBD.php");
    require_once("gestion/gestionConsumibles.php");

    $conexion = crearConexionBD();
    $excepcion = quitar_consumible($conexion,$consumible["CONSUMIBLE_ID"]);
    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "consumibles_admin.php";
        Header("Location: excepcion.php");
    }
    else Header("Location: consumibles_admin.php");
}
else Header("Location: consumibles_admin.php"); // Se ha tratado de acceder directamente a este PHP

