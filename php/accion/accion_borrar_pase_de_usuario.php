<?php

session_start();

if (isset($_SESSION["DNI"])) {

    $ALMACENESCONSUMIBLES_ID = $_SESSION ["ALMACENESCONSUMIBLES_ID"];
    unset ($_SESSION["ALMACENESPASES_ID"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionAlmacenes.php");

    $conexion = crearConexionBD();
    $excepcion = borrarConsumibleDeUsuario($conexion, $ALMACENESCONSUMIBLES_ID);

    cerrarConexionBD($conexion);

    if ($excepcion <> "") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "almacenes_admin.php";
        Header("Location: ../excepcion.php");
    } else

        Header("Location: ../almacenes_admin.php");
} else {

    Header("Location: ../almacenes_admin.php"); // Se ha tratado de acceder directamente a este PHP

}