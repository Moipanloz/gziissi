<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>
<body>

<?php

include_once("cabecera.php");
require_once("gestion/gestionBD.php");
require_once("gestion/gestionUsuarios.php");

$conexion = crearConexionBD();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $conexion = crearConexionBD();
    $num_usuarios = consultarUsuario($conexion, $email, $pass);

    if ($num_usuarios == 0) {
        $login = "error";
        cerrarConexionBD($conexion);
    } else {
        $_SESSION['USUARIO'] = getNombreUsuario($conexion, $email, $pass);
        cerrarConexionBD($conexion);
        Header("Location: index.php");
    }

}

?>


<div>
    <h1 id="torneos">Inicia sesión</h1>
    <div class="login">
        <form>
            <div class="grid-container-login">
                <label for="email">Correo electrónico: </label>
                <input type="email" name="email" id="email" placeholder="correo@dominio.com">
                <label for="pass">Contraseña: </label>
                <input type="password" name="pass" id="pass" placeholder="contraseña">
            </div>
            <div class="align">
                <input type="submit" value="Enviar" id="submit" name="submit">
                <p>¿No tienes una cuenta? Regístrate <a href="registrate.php">aquí</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
