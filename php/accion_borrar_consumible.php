<?php
session_start();

if (isset($_SESSION["CONSUMIBLE"])) {
    $CONSUMIBLE = $_SESSION["CONSUMIBLE"];
    unset($_SESSION["CONSUMIBLE"]);

    require_once("gestion/gestionBD.php");
    require_once("gestion/gestionConsumibles.php");

    $conexion = crearConexionBD();

    $count = cantidadDeBonosConConsumible ($conexion, $CONSUMIBLE["CONSUMIBLES_ID"]);

    if ($count == 0)  {

        $excepcion = quitarConsumible($conexion,$CONSUMIBLE["CONSUMIBLES_ID"]);
        cerrarConexionBD($conexion);



        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "consumibles_admin.php";
            Header("Location: excepcion.php");
        }
        else Header("Location: consumibles_admin.php");

    } else {

        $_SESSION["warning"] = "El consumible \"".$CONSUMIBLE ["NOMBRECONSUMIBLE"]."\" se utiliza en algun bono. Por favor eliminelo de cualquier bono antes de borrar el consumible.";

        Header("Location: consumibles_admin.php");

        cerrarConexionBD($conexion);


    }


}
else Header("Location: consumibles_admin.php"); // Se ha tratado de acceder directamente a este PHP

