<?php
session_start();

if (isset($_SESSION["DNI"])) {

    $CONSUMIBLES_ID = $_SESSION ["CONSUMIBLES_ID"];

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionAlmacenes.php");

    $conexion = crearConexionBD();
    $excepcion = anadirConsumibleAUsuario($conexion,$CONSUMIBLES_ID,$_SESSION ["DNI"]);

    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "almacenes_admin.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../almacenes_admin.php");
}

else {

    Header("Location: ../almacenes_admin.php"); // Se ha tratado de acceder directamente a este PHP

}