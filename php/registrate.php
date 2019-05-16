<?php

require_once ("gestion/gestionBD.php");
require_once ("gestion/gestionUsuarios.php");


session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <!--<link href="FUENTE" rel="font"> REVISAR FUENTE-->
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" type="image/x-icon" href="faviconURL">
</head>
<body>

<?php include_once ("cabecera.php")?>

<div>
    <h1 id="torneos">Regístrate</h1>
    <div class="login">
        <form>
            <div class="grid-container-registro">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">

                <label for="apellidos">Apellidos: </label>
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">

                <label for="fechaNacimiento">Fecha de Nacimiento: </label>
                <input type="date" name="fechaNacimiento" id="fechaNacimiento" placeholder="01/01/2000">

                <label for="nick">Nick: </label>
                <input type="text" name="nick" id="nick" placeholder="nick">

                <label for="email">Correo electrónico: </label>
                <input type="email" name="email" id="email" placeholder="ejemplo@dominio.com">

                <label for="pass">Contraseña: </label>
                <input type="password" name="pass" id="pass" placeholder="contraseña">

                <label for="passConfirm">Confirma tu contraseña: </label>
                <input type="password" name="passConfirm" id="passConfirm" placeholder="contraseña">
            </div>
            <div class="align">
                <input type="submit" value="Enviar" id="submit" name="submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>