<?php
session_start();

 if (isset($_REQUEST["DNI"])){
    $USUARIO["DNI"] = $_REQUEST["DNI"];
    $USUARIO["NOMBRE"] = $_REQUEST["NOMBRE"];
    $USUARIO["FECHANACIMIENTO"] = $_REQUEST["FECHANACIMIENTO"];
    $USUARIO["FECHAINSCRIPCION"] = $_REQUEST["FECHAINSCRIPCION"];
    $USUARIO["TIPOPAGO"] = $_REQUEST["TIPOPAGO"];
    $USUARIO["ACTIVO"] = $_REQUEST["ACTIVO"];


    $_SESSION["USUARIO"] = $USUARIO;


    if (isset($_REQUEST["borrar"])) Header("Location: accion/accion_borrar_usuario.php");
    else if (isset($_REQUEST["grabar"])) Header("Location: accion/accion_activar_usuario.php");
    else if (isset($_REQUEST["grabar"])) Header("Location: accion/accion_desactivar_usuario.php");
 }
else Header("Location: usuarios_admin.php");


