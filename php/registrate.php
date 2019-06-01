<?php

require_once("gestion/gestionBD.php");
require_once("gestion/gestionUsuarios.php");


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>
<body>

<?php include_once("cabecera.php");

if (isset ($_SESSION ["login_dni"])) Header('Location: index.php');


if (!isset($_SESSION["formulario"])) {
    $formulario['dni'] = "";
    $formulario['nombre'] = "";
    $formulario['fechaNacimiento'] = "";
    $formulario['email'] = "";
    $formulario['pass'] = "";
    $formulario['pago'] = "";

    $_SESSION["formulario"] = $formulario;
} // Si ya existían valores, los cogemos para inicializar el formulario
else
    $formulario = $_SESSION["formulario"];

// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
if (isset($_SESSION["errores"])) {
    $errores = $_SESSION["errores"];
    unset($_SESSION["errores"]);
}

// Creamos una conexión con la BD
$conexion = crearConexionBD();

?>


<script>
    // Inicialización de elementos y eventos cuando el documento se carga completamente
    $(document).ready(function () {
        $("#altaUsuario").on("submit", function () {
            return validateForm();
        });

        // EJERCICIO 3: Manejador de evento del color de la contraseña
        $("#pass").on("keyup", function () {
            // Calculo el color
            passwordColor();
        });
    });
</script>


<?php
// Mostrar los errores de validación (Si los hay)
if (isset($errores) && count($errores) > 0) { ?>

    <div id=\div_errores\ class=\error\>
        <h4> Errores en el formulario:</h4>
        <?php
        foreach ($errores as $error) {
            echo $error;
        }
        ?>
    </div>
    <?php
}
?>

<div>
    <h1 class="titulo">Regístrate</h1>
    <div class="login">
        <form id="altaUsuario" method="get" action="validacion_alta_usuario.php">
            <div class="grid-container-registro">

                <label for="dni"><strong>DNI:</strong></label>
                <input type="text" name="dni" id="dni" size="9" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]"
                       value="<?php echo $formulario['dni']; ?>" required>
                <label for="nombre"><strong>Nombre:</strong></label>
                <input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre']; ?>"
                       required/>

                <?php

                $minimalDate = strtotime ( '-18 year' , strtotime ( date("Y-m-d") ) ) ;

                $minimalDate = date ( 'Y-m-d' , $minimalDate );

                ?>

                <label for="fechaNacimiento"><strong>Fecha de Nacimiento:</strong></label>
                <input type="date" max="<?php print $minimalDate ?>" id="fechaNacimiento" name="fechaNacimiento"
                       required value="<?php echo $formulario['fechaNacimiento']; ?>"/>
                <label for="email"><strong>Correo electrónico:</strong></label>
                <input id="email" name="email" type="email" placeholder="usuario@dominio.com"
                       value="<?php echo $formulario['email']; ?>" required/>
                <label for="pass"><strong>Contraseña:</strong></label>
                <input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos"
                       required oninput="passwordValidation(); "/>
                <label for="passConfirm"><strong>Confirma tu contraseña:</strong></label>
                <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña"
                       oninput="passwordConfirmation();" required/>


                <div>
                    <p><strong>Método de pago</strong></p>
                    <label>
                        <input <?php if ($formulario ["pago"] == "Tarjeta") print ("checked") ?> type="radio"
                                                                                                 value="Tarjeta"
                                                                                                 name="pago"/>Tarjeta</label>
                    <label>
                        <input <?php if ($formulario ["pago"] == "Paypal") print ("checked") ?> type="radio"
                                                                                                value="Paypal"
                                                                                                name="pago"/>Paypal</label>
                </div>

            </div>
            <div class="align">
                <input type="submit" value="Enviar" id="submit" name="submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>