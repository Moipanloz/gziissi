<?php
session_start();

if (isset($_SESSION["TORNEO"])) {
    $TORNEO = $_SESSION["TORNEO"];
    unset($_SESSION["TORNEO"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionTorneos.php");

    $conexion = crearConexionBD();


    $count = cantidadDeTorneosConNombre($conexion, $TORNEO["NOMBRETORNEO"]);

    if ($count == 0) {

        $excepcion = nuevoTorneo($conexion,$TORNEO ["NOMBRETORNEO"], $TORNEO ["NOMBRETORNEO"]);

        cerrarConexionBD($conexion);

        if ($excepcion <> "") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "torneos_admin.php";
            Header("Location: ../excepcion.php");
        } else
            Header("Location: ../torneos_admin.php");

    } else {

        $_SESSION["warning"] = "Ya existe un torneo con nombre \"" . $TORNEO ["NOMBRETORNEO"] . "\"";

        Header("Location: ../torneos_admin.php");

        cerrarConexionBD($conexion);


    }
} else Header("Location: ../torneos_admin.php"); // Se ha tratado de acceder directamente a este PHP
