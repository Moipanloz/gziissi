<?php
session_start();

if (isset($_SESSION["PASES_ID"]) && isset($_SESSION["BONO"])) {

    $PASES_ID = $_SESSION ["PASES_ID"];
    $BONO = $_SESSION ["BONO"];
    $BONO_ID = $BONO ["BONOS_ID"];

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();
    $excepcion = anadirPaseABono($conexion,$PASES_ID,$BONO_ID);

    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "bonos_admin.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../modificar_bonos_admin.php");
}

else {


    Header("Location: ../modificar_bonos_admin.php"); // Se ha tratado de acceder directamente a este PHP

}