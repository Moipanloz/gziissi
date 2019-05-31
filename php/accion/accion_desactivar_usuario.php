<?php
session_start();

if (isset($_SESSION["USUARIO"]) ) {

    $USUARIO = $_SESSION ["USUARIO"];

    unset ($_SESSION ["USUARIO"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionUsuarios.php");

    $conexion = crearConexionBD();
    $excepcion = darseDeBaja ($conexion, $USUARIO ["DNI"]);

    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "usuarios_admin.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../usuarios_admin.php");
}

else {


    Header("Location: ../usuarios_admin.php"); // Se ha tratado de acceder directamente a este PHP

}