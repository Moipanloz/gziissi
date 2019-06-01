<?php
session_start();

 if (isset($_REQUEST["LINEAVENTAS_ID"])){
    $LINEAVENTA["LINEAVENTAS_ID"] = $_REQUEST["LINEAVENTAS_ID"];
    $LINEAVENTA["CANTIDADLV"] = $_REQUEST["CANTIDADLV"];
    $LINEAVENTA["PRECIOLV"] = $_REQUEST["PRECIOLV"];
    $LINEAVENTA["DESCUENTO"] = $_REQUEST["DESCUENTO"];


     $_SESSION["LINEAVENTA"] = $LINEAVENTA;

    if (isset($_REQUEST["cancelar"])) {
        unset($_SESSION ["LINEAVENTA"]);
        Header("Location: lineasventa_admin.php");
    }
    else if (isset ($_REQUEST ["nuevo"]))     Header("Location: accion/accion_crear_lineaventa.php");
    else if (isset($_REQUEST["editar"])) Header("Location: lineasventa_admin.php");
    else if (isset($_REQUEST["grabar"])) Header("Location: accion/accion_modificar_lineaventa.php");
    else if (isset($_REQUEST["borrar"])) Header("Location: accion/accion_borrar_lineaventa.php");
}
else Header("Location: lineasventa_admin.php");


