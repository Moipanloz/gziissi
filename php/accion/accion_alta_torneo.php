<?php
session_start();

require_once("../gestion/gestionBD.php");
require_once("../gestion/gestionTorneos.php");

$conexion = crearConexionBD();


// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_REQUEST["joinTorneo"])) {
    $dni = $_REQUEST["DNI"];
    $torneosID = $_REQUEST["TORNEOS_ID"];
    unset ($_SESSION["errores"]);

    /*Si no está logeado (dni es nulo)*/

    if($dni == null){
        cerrarConexionBD($conexion);

        Header("Location: iniciaSesion.php");
    }


    $res = inscripcionTorneo($conexion, $dni, $torneosID);
    return $res;
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

?>