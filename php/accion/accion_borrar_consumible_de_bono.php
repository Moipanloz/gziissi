<?php
session_start();


if (isset($_SESSION["LINEACONSUMIBLES_ID"])) {

    $LINEACONSUMIBLEID = $_SESSION ["LINEACONSUMIBLES_ID"];
    unset($_SESSION["LINEACONSUMIBLES_ID"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();
    $excepcion = borrarConsumibleDeBono($conexion,$LINEACONSUMIBLEID);

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