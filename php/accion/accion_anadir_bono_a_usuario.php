<?php
session_start();

if (isset($_SESSION["BONOS_ID"]) && isset($_SESSION["BONO"]) && isset($_SESSION["DNI"])) {

    $BONOS_ID = $_SESSION ["BONOS_ID"];
    $BONO = $_SESSION ["BONO"];
    $BONO_ID = $BONO ["BONOS_ID"];

    $DNI = $_SESSION["DNI"];

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();
    $excepcion = anadirBonoAUsuario($conexion,$BONO_ID,$DNI);

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