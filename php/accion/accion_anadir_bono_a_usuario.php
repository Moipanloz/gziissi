<?php
session_start();

if (isset($_REQUEST["adquirirBono"]) && isset ($_SESSION["login_dni"])) {

    $BONOS_ID = $_REQUEST ["BONOS_ID"];

    $DNI = $_SESSION["login_dni"];

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionBonos.php");

    $conexion = crearConexionBD();
    $excepcion = anadirBonoAUsuario($conexion,$BONOS_ID,$DNI);

    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "bonos.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../bonos.php");

    print "ID BONO: ".$BONOS_ID.", DNI: ".$DNI;
}

else {

    Header("Location: ../bonos.php"); // Se ha tratado de acceder directamente a este PHP

}