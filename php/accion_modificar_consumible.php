<?php
session_start();

if (isset($_SESSION["consumible"])) {
    $consumible = $_SESSION["consumible"];
    unset($_SESSION["consumible"]);

    require_once("gestion/gestionBD.php");
    require_once("gestion/gestionConsumibles.php");

    $conexion = crearConexionBD();
    $excepcion = modificar_bono($conexion,$consumible["OID_CONSUMIBLE"],$consumible["NOMBRECONSUMIBLE"], $consumible ["TIPOCONSUMIBLE"]);
    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "administracion.php";
        Header("Location: excepcion.php");
    }
    else
        Header("Location: administracion.php");
}
else Header("Location: administracion.php"); // Se ha tratado de acceder directamente a este PHP
?>
