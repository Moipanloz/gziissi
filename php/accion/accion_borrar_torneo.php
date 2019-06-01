<?php
session_start();

if (isset($_SESSION["TORNEO"])) {
    $TORNEO = $_SESSION["TORNEO"];
    unset($_SESSION["TORNEO"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionTorneos.php");

    $conexion = crearConexionBD();

    $count = cantidadDeUsuariosEnTorneo ($conexion, $TORNEO["TORNEOS_ID"]);

    if ($count == 0)  {

        $excepcion = quitarTorneo($conexion,$TORNEO["TORNEOS_ID"]);
        cerrarConexionBD($conexion);

        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "torneos_admin.php";
            Header("Location: ../excepcion.php");
        }
        else Header("Location: ../torneos_admin.php");

    } else {

        $_SESSION["warning"] = "El torneo \"".$TORNEO ["NOMBRETORNEO"]."\" aun tiene usuarios apuntados. Por favor eliminelos antes de borrar el torneo.";

        Header("Location: ../torneos_admin.php");

        cerrarConexionBD($conexion);

    }


}
else Header("Location: ../pases_admin.php"); // Se ha tratado de acceder directamente a este PHP

