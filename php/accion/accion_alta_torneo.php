<?php
session_start();

require_once("../gestion/gestionBD.php");
require_once("../gestion/gestionTorneos.php");

$conexion = crearConexionBD();

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_REQUEST["joinTorneo"])) {

    $torneosID = $_REQUEST["TORNEOS_ID"];

    /*Si no está logeado (dni es nulo)*/

    if(!isset ($_SESSION ["login_dni"])){
        cerrarConexionBD($conexion);

        Header("Location: iniciaSesion.php");
    }

    $excepcion = inscripcionTorneo($conexion, $_SESSION["login_dni"], $torneosID);
    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "torneos.php";
        Header("Location: ../excepcion.php");
    }
    else
        Header("Location: ../torneos.php");
    /*mensaje*/
/*
    $popup = "<script language="javascript">
            $(document).ready(function(){
            alert("Registro en el torneo realizado.");
        });
    </script>"  */

    cerrarConexionBD($conexion);


}else {
    /*mensaje*/
    cerrarConexionBD($conexion);


    Header("Location: torneos.php");
}
