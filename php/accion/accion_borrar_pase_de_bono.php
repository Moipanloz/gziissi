<?php
session_start();


if (isset($_SESSION["LINEAPASES_ID"])) {

    $LINEAPASEID = $_SESSION ["LINEAPASES_ID"];
    unset($_SESSION["LINEAPASES_ID"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();
    $excepcion = borrarPaseDeBono($conexion,$LINEAPASEID);

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