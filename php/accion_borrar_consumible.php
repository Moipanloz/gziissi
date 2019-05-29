<?php
session_start();

if (isset($_SESSION["CONSUMIBLE"])) {
    $CONSUMIBLE = $_SESSION["CONSUMIBLE"];
    unset($_SESSION["CONSUMIBLE"]);

    require_once("gestion/gestionBD.php");
    require_once("gestion/gestionConsumibles.php");

    $conexion = crearConexionBD();

    $count = cantidad_de_bonos_con_consumible ($conexion, $CONSUMIBLE["CONSUMIBLES_ID"]);

    if ($count == 0)  {

        $excepcion = quitar_consumible($conexion,$CONSUMIBLE["CONSUMIBLES_ID"]);
        cerrarConexionBD($conexion);



        if ($excepcion<>"") {
            $_SESSION["excepcion"] = $excepcion;
            $_SESSION["destino"] = "consumibles_admin.php";
            Header("Location: excepcion.php");
        }
        else Header("Location: consumibles_admin.php");

    } else {

        $_SESSION["consumible_en_uso"] = "El consumible \"".$CONSUMIBLE ["NOMBRECONSUMIBLE"]."\" se utiliza en algun bono. Por favor eliminelo de cualquier bono antes de borrar el consumible.";

        Header("Location: consumibles_admin.php");

        cerrarConexionBD($conexion);


    }


}
else Header("Location: consumibles_admin.php"); // Se ha tratado de acceder directamente a este PHP

