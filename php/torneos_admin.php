<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");

require_once("gestion/gestionBD.php");
require_once("gestion/gestionTorneos.php");

if (isset($_SESSION["TORNEO"])) {
    $TORNEO = $_SESSION["TORNEO"];
    unset($_SESSION["TORNEO"]);
}

$conexion = crearConexionBD();

$todosLosTorneos = consultarTodosTorneos($conexion);

if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");
?>


<body>

<?php if (isset($_SESSION ["warning"])) { ?>

    <div><?php print ($_SESSION ["warning"]) ?></div>

    <?php

    unset($_SESSION ["warning"]);

} ?>

<div>
    <h2 class="titulo">Administración Torneos</h2>
    <div class="admin_class">
        <!-- DE LA PRACTICA -->

        <?php

        foreach ($todosLosTorneos as $fila) {

            ?>


            <article class="consumibles">

                <form method="post" action="controlador_torneos.php" autocomplete="off">

                    <div class="fila_consumibles">

                        <div class="datos_consumible">

                            <input id="TORNEOS_ID" name="TORNEOS_ID"

                                   type="hidden" value="<?php echo $fila["TORNEOS_ID"]; ?>"/>

                            <?php

                            if (isset($TORNEO) and ($TORNEO["TORNEOS_ID"] == $fila["TORNEOS_ID"])) { ?>

                                <!-- Editando título -->

                                <h3><input maxlength="30" id="NOMBRETORNEO" required name="NOMBRETORNEO" type="text"
                                           value="<?php echo $fila["NOMBRETORNEO"]; ?>"/></h3>
                                <P><input maxlength="5" id="PRECIOTORNEO" required name="PRECIOTORNEO"
                                          pattern="[0-9]?[0-9]?(\.[0-9][0-9]?)?" type="text"
                                          value="<?php echo $fila["PRECIOTORNEO"]; ?>"/></P>
                                <P><input maxlength="20" id="VIDEOJUEGO" required name="VIDEOJUEGO" type="text"
                                          value="<?php echo $fila["VIDEOJUEGO"]; ?>"/></P>
                                <P><input maxlength="2" id="MAXPARTICIPANTES" required name="MAXPARTICIPANTES"
                                          pattern="^[0-9]{1,2}+$" type="text"
                                          value="<?php echo $fila["MAXPARTICIPANTES"]; ?>"/></P>
                                <input id="FECHATORNEO" name="FECHATORNEO" type="date" required
                                       value="<?php echo date("Y-m-d", strtotime($fila["FECHATORNEO"])); ?>"/>


                            <?php } else { ?>

                                <!-- mostrando título -->

                                <input id="NOMBRETORNEO" name="NOMBRETORNEO" type="hidden"
                                       value="<?php echo $fila["NOMBRETORNEO"]; ?>"/>
                                <input id="PRECIOTORNEO" name="PRECIOTORNEO" type="hidden"
                                       value="<?php echo $fila["PRECIOTORNEO"]; ?>"/>
                                <input id="VIDEOJUEGO" name="VIDEOJUEGO" type="hidden"
                                       value="<?php echo $fila["VIDEOJUEGO"]; ?>"/>
                                <input id="MAXPARTICIPANTES" name="MAXPARTICIPANTES" type="hidden"
                                       value="<?php echo $fila["MAXPARTICIPANTES"]; ?>"/>
                                <input id="FECHATORNEO" name="FECHATORNEO" type="hidden"
                                       value="<?php echo $fila["FECHATORNEO"]; ?>"/>

                                <div class="nombre"><?php echo "<strong>Nombre: </strong>" . $fila["NOMBRETORNEO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Precio: </strong>" . $fila["PRECIOTORNEO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Vidoejuego: </strong>" . $fila["VIDEOJUEGO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Número máximo de participantes: </strong>" . $fila["MAXPARTICIPANTES"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Fecha: </strong>" . $fila["FECHATORNEO"]; ?></div>

                                <div class="participantes">

                                    <?php if (isset($TORNEO) and ($TORNEO["TORNEOS_ID"] == $fila["TORNEOS_ID"])) {?>

                                        <p><strong>Usuarios registrados:</strong></p>

                                        <?php $usuariosRegistrados = usuariosRegistradosEnTorneo($conexion, $TORNEO ["TORNEOS_ID"]);

                                        foreach ($usuariosRegistrados as $u) {?>

                                            <form method="post" action="controlador_torneos.php">

                                                <input type="hidden" id="PARTICIPANTESTORNEOS_ID" name="PARTICIPANTESTORNEOS_ID"
                                                       value="<?php print $u ["PARTICIPANTESTORNEOS_ID"] ?>">
                                                <p><?php print $u["NOMBRE"] ?> <input type="submit" name="borrar_u" value="Eliminar"></p>
                                            </form>
                                        <?php }
                                    } else { ?>

                                        <p><strong>Usuarios registrados:</strong></p>

                                        <?php $usuariosRegistrados = usuariosRegistradosEnTorneo($conexion, $fila ["TORNEOS_ID"]);

                                        foreach ($usuariosRegistrados as $u) {?>

                                            <p><?php print $u["NOMBRE"] ?></p>

                                        <?php }
                                    } ?>
                                </div>


                            <?php } ?>

                        </div>


                        <div id="botones_fila">

                            <?php if (isset($TORNEO) and ($TORNEO["TORNEOS_ID"] == $fila["TORNEOS_ID"])) { ?>

                                <button class="boton" id="grabar" name="grabar" type="submit" class="editar_fila">

                                    <!--<img src="imagenes/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">
                                    -->

                                    Guardar

                                </button>

                                <button class="boton" id="cancelar" name="cancelar" type="submit" class="cancelar">

                                    <!--<img src="imagenes/remove_menuito.bmp" class="editar_fila" alt="Borrar consumible">
-->
                                    Cancelar
                                </button>

                            <?php } else { ?>

                                <button class="boton" id="editar" name="editar" type="submit" class="editar_fila">

                                    <!--<img src="imagenes/pencil_menuito.bmp" class="editar_fila" alt="Editar consumible">
                                    -->
                                    Editar

                                </button>

                                <button class="boton" id="borrar" name="borrar" type="submit" class="editar_fila">

                                    <!--<img src="imagenes/remove_menuito.bmp" class="editar_fila" alt="Borrar consumible">
-->
                                    Borrar

                                </button>

                            <?php } ?>


                        </div>

                    </div>

                </form>

            </article>



        <?php }

         if (!isset($TORNEO)) {
             
             $minimalDate = date ( 'Y-m-d' );?>

            <article>
                    <form class="nuevo" autocomplete="off" method="post" action="controlador_torneos.php">



                        <input id="TORNEOS_ID" name="TORNEOS_ID" type="hidden" value="Fake id"/>
                        <p><strong>Nombre: </strong><input required pattern="^[a-zA-Z0-9 ]+$" maxlength="40" id="NOMBRETORNEO"
                                          name="NOMBRETORNEO" type="text" placeholder="Nombre"/></p>
                        <p><strong>Precio: </strong><input required pattern="[0-9]?[0-9]?(\.[0-9][0-9]?)?" maxlength="5" id="PRECIOTORNEO"
                                          name="PRECIOTORNEO" type="text" placeholder="0.0"/></p>
                        <p><strong>Videojuego: </strong><input required pattern="^[a-zA-Z ]+$" maxlength="20" id="VIDEOJUEGO"
                                              name="VIDEOJUEGO" type="text" placeholder="Videojuego"/></p>
                        <p><strong>Máx. de participantes: </strong><input required pattern="^[0-9]{1,2}+$" id="MAXPARTICIPANTES"
                                                                  name="MAXPARTICIPANTES" type="text" placeholder="10"/></p>
                        <p><strong>Fecha: </strong><input min="<?php print $minimalDate ?>" required id="FECHATORNEO" name="FECHATORNEO" type="date" /></p>
                        <div style="margin-top: 5%;">
                            <button class="boton" id="nuevo" name="nuevo" type="submit">Crear un torneo nuevo</button>
                        </div>
                    </form>
            </article>
        <?php } ?>
    </div>
</div>
<?php cerrarConexionBD($conexion) ?>
</body>
</html>
