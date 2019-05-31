<?php
require_once("../gestion/gestionBD.php");
require_once("../gestion/gestionUsuarios.php");


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>GamersZone: Alta de Usuario realizada con éxito</title>

    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<body>
<?php
include_once("../cabecera.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
    $nuevoUsuario = $_SESSION["formulario"];
    unset ($_SESSION["formulario"]);
    unset($_SESSION["errores"]);
} else
    Header("Location: ../registrate.php");

$conexion = crearConexionBD();
?>

<main>


    <?php

    $nuevoUsuario ["pass"] = password_hash($nuevoUsuario["pass"], PASSWORD_BCRYPT);

    if (alta_usuario($conexion, $nuevoUsuario)) {
        $_SESSION['login_dni'] = $nuevoUsuario['dni'];
        $_SESSION['login_name'] = $nuevoUsuario['nombre'];
        ?>
        <h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
        <div>
            Pulsa <a href="../index.php">aquí</a> para acceder a la página principal.
        </div>
    <?php } else { ?>
        <h1>El usuario ya existe en la base de datos.</h1>
        <div>
            Pulsa <a href="../registrate.php">aquí</a> para volver al formulario.
        </div>
    <?php } ?>

</main>

</body>
</html>
<?php
cerrarConexionBD($conexion);
?>

