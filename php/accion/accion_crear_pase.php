<?php
session_start();

if (isset($_SESSION["PASE"])) {
    $PASE = $_SESSION["PASE"];
    unset($_SESSION["PASE"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionPases.php");

    $conexion = crearConexionBD();


    $count = cantidadDeConsumiblesConTipoMedio($conexion, $PASE["TIPOMEDIO"]);

    if ($count == 0) {

        $excepcion = nuevoPase($conexion,$PASE ["TIPOMEDIO"]);

        cerrarConexionBD($conexion);

        if ($excepcion <> "") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "pases_admin.php";
            Header("Location: ../excepcion.php");
        } else
            Header("Location: ../pases_admin.php");

    } else {

        $_SESSION["warning"] = "Ya existe un pase con nombre \"" . $PASE ["TIPOMEDIO"] . "\"";

        Header("Location: ../pases_admin.php");

        cerrarConexionBD($conexion);


    }
} else Header("Location: ../pases_admin.php"); // Se ha tratado de acceder directamente a este PHP
