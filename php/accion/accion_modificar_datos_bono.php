<?php
session_start();

if (isset($_REQUEST ["NOMBREBONO"])) {
    $BONO = $_SESSION["BONO"];
    $ID = $BONO ["BONOS_ID"];
    $NOMBRE = $_REQUEST ["NOMBREBONO"];
    $PRECIO = $_REQUEST ["PRECIOBONO"];
    $DISPONIBLE = $_REQUEST ["DISPONIBLE"];


    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();
    $excepcion = modificarBono($conexion, $ID, $NOMBRE, $PRECIO, $DISPONIBLE);

    cerrarConexionBD($conexion);

    if ($excepcion <> "") {

        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "../modificar_bonos_admin.php";
        Header("Location: ../excepcion.php");
    } else {

        $BONO ["NOMBREBONO"] = $NOMBRE;
        $BONO ["PRECIOBONO"] = $PRECIO;
        $BONO ["DISPONIBLE"] = $DISPONIBLE;

        $_SESSION  ["BONO"] = $BONO;

        $_SESSION ["saved_succesfully"] = "El bono ".$BONO["NOMBREBONO"]."se guardó correctamente.";

        Header("Location: ../bonos_admin.php");
    }
} else Header("Location: ../bonos_admin.php"); // Se ha tratado de acceder directamente a este PHP
