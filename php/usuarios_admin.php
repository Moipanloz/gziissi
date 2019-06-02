<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Adm. Usuarios</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");
require_once("gestion/gestionUsuarios.php");
require_once("gestion/gestionBD.php");

$conexion = crearConexionBD();


if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A") {

    Header("Location: index.php");
}


$todosLosUsuarios = consultarTodosUsuarios($conexion);

if (isset($_SESSION["USUARIO"])) {
    $USUARIO = $_SESSION["USUARIO"];
    unset($_SESSION["USUARIO"]);
}

?>

<body>

<div>
    <h2 class="titulo">Administración Usuarios</h2>
    <div class="admin_class">

        <?php if (isset ($_SESSION ["USUARIO_BORRAR_MSG"])) {

            print ("<div>" . $_SESSION ["USUARIO_BORRAR_MSG"] . "</div>");

            unset ($_SESSION ["USUARIO_BORRAR_MSG"]);

        } ?>

        <?php foreach ($todosLosUsuarios

                       as $fila) {
            if ($fila ["DNI"] != "00000000A") { ?>

                <article class="consumibles">

                    <form method="post" action="controlador_usuarios.php" autocomplete="off">

                        <div class="fila_consumibles">

                            <div class="datos_consumible">

                                <input id="DNI" name="DNI" type="hidden" value="<?php echo $fila["DNI"]; ?>"/>

                                <!-- mostrando título -->

                                <input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
                                <input id="CORREO" name="CORREO" type="hidden" value="<?php echo $fila["CORREO"]; ?>"/>
                                <input id="FECHANACIMIENTO" name="FECHANACIMIENTO" type="hidden"
                                       value="<?php echo $fila["FECHANACIMIENTO"]; ?>"/>
                                <input id="FECHAINSCRIPCION" name="FECHAINSCRIPCION" type="hidden"
                                       value="<?php echo $fila["FECHAINSCRIPCION"]; ?>"/>
                                <input id="TIPOPAGO" name="TIPOPAGO" type="hidden"
                                       value="<?php echo $fila["TIPOPAGO"]; ?>"/>
                                <input id="ACTIVO" name="ACTIVO" type="hidden" value="<?php echo $fila["ACTIVO"]; ?>"/>


                                <div class="nombre"><?php echo "<strong>Nombre: </strong>" . $fila["NOMBRE"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Correo: </strong>" . $fila["CORREO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Fecha de nacimiento: </strong>" . $fila["FECHANACIMIENTO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Fecha de inscripción: </strong>" . $fila["FECHAINSCRIPCION"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Tipo de pago: </strong>" . $fila["TIPOPAGO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Activo: </strong>" . $fila["ACTIVO"]; ?></div>


                            </div>


                            <div id="botones_fila">

                                <button class="boton" id="borrar" name="borrar" type="submit" class="editar_fila">

                                    <!--<img src="imagenes/remove_menuito.bmp" class="editar_fila" alt="Borrar consumible">
    -->
                                    Borrar

                                </button>

                                <?php

                                $dni = $fila["DNI"];

                                if (esActivo($conexion, $dni) == "FALSE") { ?>


                                    <button class="boton" id="activar" name="activar" type="submit" class="editar_fila">Activar
                                    </button>

                                <?php } else { ?>

                                    <button class="boton" id="desactivar" name="desactivar" type="submit" class="editar_fila">
                                        Desactivar
                                    </button>
                                <?php } ?>

                            </div>

                        </div>

                    </form>

                </article>


            <?php }
        } ?>

    </div>

</div>

<?php cerrarConexionBD($conexion) ?>
</body>
