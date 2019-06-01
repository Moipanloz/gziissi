<?php
session_start();


if (isset($_SESSION["PARTICIPANTESTORNEOS_ID"])) {

    $PARTICIPANTESTORNEOS_ID = $_SESSION ["PARTICIPANTESTORNEOS_ID"];
    unset($_SESSION["PARTICIPANTESTORNEOS_ID"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionTorneos.php");

    $conexion = crearConexionBD();
    $excepcion = borrarParticipanteDeTorneo($conexion,$PARTICIPANTESTORNEOS_ID);

    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "torneos_admin.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../torneos_admin.php");
}

else {


    Header("Location: ../torneos_admin.php"); // Se ha tratado de acceder directamente a este PHP

}