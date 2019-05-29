<?php
session_start();

if (isset($_SESSION["CONSUMIBLE"])) {
    $CONSUMIBLE = $_SESSION["CONSUMIBLE"];
    unset($_SESSION["CONSUMIBLE"]);

    require_once("gestion/gestionBD.php");
    require_once("gestion/gestionConsumibles.php");

    $conexion = crearConexionBD();
    $excepcion = modificarConsumible($conexion,$CONSUMIBLE["CONSUMIBLES_ID"],$CONSUMIBLE["NOMBRECONSUMIBLE"], $CONSUMIBLE ["TIPOCONSUMIBLE"]);


    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "consumibles_admin.php";
        Header("Location: excepcion.php");
    }
    else
        Header("Location: consumibles_admin.php");
}
else Header("Location: consumibles_admin.php"); // Se ha tratado de acceder directamente a este PHP
