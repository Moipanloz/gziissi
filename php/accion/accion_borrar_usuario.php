<?php
session_start();

if (isset($_SESSION["USUARIO"])) {
    $USUARIO = $_SESSION["USUARIO"];
    unset($_SESSION["USUARIO"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionUsuarios.php");

    $conexion = crearConexionBD();

    $excepcion = borrarUsuario($conexion, $USUARIO["DNI"]);
    cerrarConexionBD($conexion);


    if ($excepcion <> "")
        $_SESSION ["USUARIO_BORRAR_MSG"] = "No se puede borrar un usuario que aun contenga pases o consumibles en su almacén.";

    else
        $_SESSION ["USUARIO_BORRAR_MSG"] = "El usuario " . $USUARIO ["NOMBRE"] . " fue borrado satisfactoriamente.";


    Header("Location: ../usuarios_admin.php");

} else Header("Location: ../usuarios_admin.php"); // Se ha tratado de acceder directamente a este PHP

