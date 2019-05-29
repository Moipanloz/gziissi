<?php
session_start();

if (isset($_SESSION["nuevo"])) {
    unset($_SESSION["nuevo"]);

    require_once("gestion/gestionBD.php");
    require_once("gestion/gestionConsumibles.php");

    $conexion = crearConexionBD();
    $excepcion = nuevoConsumible($conexion,"Nuevo ".rand(0,100), "Comida");


    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "consumibles_admin.php";
        Header("Location: excepcion.php");
    }
    else
        Header("Location: consumibles_admin.php");
}
else Header("Location: consumibles_admin.php"); // Se ha tratado de acceder directamente a este PHP
