<?php
session_start();

if (isset($_SESSION["PASE"])) {
    $PASE = $_SESSION["PASE"];
    unset($_SESSION["PASE"]);

    require_once("../gestion/gestionBD.php");
    require_once("../gestion/gestionPases.php");

    $conexion = crearConexionBD();

    $count = cantidadDeBonosConPase ($conexion, $PASE["PASES_ID"]);

    if ($count == 0)  {

        $excepcion = quitarPase($conexion,$PASE["PASES_ID"]);
        cerrarConexionBD($conexion);



        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "pases_admin.php";
            Header("Location: ../excepcion.php");
        }
        else Header("Location: ../pases_admin.php");

    } else {

        $_SESSION["warning"] = "El pase \"".$PASE ["TIPOMEDIO"]."\" se utiliza en algun bono. Por favor eliminelo de cualquier bono antes de borrarlo.";

        Header("Location: ../pases_admin.php");

        cerrarConexionBD($conexion);


    }


}
else Header("Location: ../pases_admin.php"); // Se ha tratado de acceder directamente a este PHP

