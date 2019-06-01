<?php
session_start();

if (isset($_SESSION["NOMBREBONO"])) {
    $NOMBREBONO = $_SESSION["NOMBREBONO"];
    unset($_SESSION["NOMBREBONO"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();

    $excepcion = crearNuevoBono($conexion, $NOMBREBONO);

    cerrarConexionBD($conexion);

    if ($excepcion <> "") {
        $_SESSION["name_taken"] = "Ya existe un bono con ese nombre.";
        Header("Location: ../bonos_admin.php");

    } else Header("Location: ../bonos_admin.php");

}// Se ha tratado de acceder directamente a este PHP
