<?php
session_start();

if (isset($_SESSION["PASE"])) {
    $PASE = $_SESSION["PASE"];
    unset($_SESSION["PASE"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionPases.php");

    $conexion = crearConexionBD();
    $excepcion = modificarPase($conexion,$PASE["PASES_ID"],$PASE["TIPOMEDIO"]);


    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "pases_admin.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../pases_admin.php");
}
else Header("Location: ../pases_admin.php"); // Se ha tratado de acceder directamente a este PHP
