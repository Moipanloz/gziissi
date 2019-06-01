<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>
<body>

<?php

include_once("cabecera.php");
require_once("gestion/gestionBD.php");
require_once("gestion/gestionUsuarios.php");

$conexion = crearConexionBD();

if (isset($_REQUEST['submit'])) {
    $email = $_REQUEST['email'];
    $pass = $_REQUEST['pass'];

    $conexion = crearConexionBD();



    if (!consultarUsuario($conexion, $email, $pass )) {
        $login = "error";
        $pass = null;

        cerrarConexionBD($conexion);
    } else {
        $_SESSION ["login_dni"] = getDNIusuario ($conexion, $email);
        $_SESSION ["login_name"] = getNombreUsuario($conexion, $email);
        cerrarConexionBD($conexion);
        Header("Location: index.php");
    }

}

if (isset($login)) {
    echo "<div class=\"error\">";
    echo "Error en la contraseña o no existe el usuario.";
    echo "</div>";
}

?>


<div>
    <h1 class="titulo">Inicia sesión</h1>
    <div class="login">
        <form id="loginUsuario" method="post" action="iniciaSesion.php">
            <div class="grid-container-login">
                <label for="email"><strong>Correo electrónico: </strong></label>
                <input type="email" name="email" id="email" <?php if (isset($email)) print ("value = \"".$email."\"") ?> placeholder="correo@dominio.com">
                <label for="pass"><strong>Contraseña: </strong></label>
                <input type="password" name="pass" id="pass" placeholder="contraseña">
            </div>
            <div class="align">
                <input class="boton" type="submit" value="Enviar" id="submit" name="submit">
                <p>¿No tienes una cuenta? Regístrate <a href="registrate.php">aquí</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
