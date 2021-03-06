<?php
session_start();

if (isset($_SESSION["TORNEO"])) {
    $TORNEO = $_SESSION["TORNEO"];
    unset($_SESSION["TORNEO"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionTorneos.php");

    $conexion = crearConexionBD();
    $excepcion = modificarTorneo($conexion,$TORNEO["TORNEOS_ID"],$TORNEO["PRECIOTORNEO"],$TORNEO["VIDEOJUEGO"],$TORNEO["MAXPARTICIPANTES"],$TORNEO["NOMBRETORNEO"],$TORNEO["FECHATORNEO"]);


    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "pases_admin.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../torneos_admin.php");
}
else Header("Location: ../torneos_admin.php"); // Se ha tratado de acceder directamente a este PHP
