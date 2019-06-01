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

<div>
    <h2 class="titulo">Administración Torneos</h2>
    <div class="admin_class">
        <!-- DE LA PRACTICA -->

        <?php

        foreach($todosLosTorneos as $fila) {

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

                                <h3><input maxlength="30" id="NOMBRETORNEO" required name="NOMBRETORNEO" type="text" value="<?php echo $fila["NOMBRETORNEO"]; ?>"/>	</h3>
                                <P><input maxlength="5" id="PRECIOTORNEO" required name="PRECIOTORNEO" pattern = "^[0-9]+(\.[0-9]{1,2})?$" type="text" value="<?php echo $fila["PRECIOTORNEO"]; ?>"/>	</P>
                                <P><input maxlength="20" id="VIDEOJUEGO" required name="VIDEOJUEGO" type="text" value="<?php echo $fila["VIDEOJUEGO"]; ?>"/>	</P>
                                <P><input maxlength="2" id="MAXPARTICIPANTES" required name="MAXPARTICIPANTES" pattern = "^[0-9]{1,2}+$" type="text" value="<?php echo $fila["MAXPARTICIPANTES"]; ?>"/>	</P>
                                <input id="FECHATORNEO" name="FECHATORNEO" type="date" required value="<?php echo date("Y-m-d", strtotime($fila["FECHATORNEO"])); ?>"/>


                            <?php }	else { ?>

                                <!-- mostrando título -->

                                <input id="NOMBRETORNEO" name="NOMBRETORNEO" type="hidden" value="<?php echo $fila["NOMBRETORNEO"]; ?>"/>
                                <input id="PRECIOTORNEO" name="PRECIOTORNEO" type="hidden" value="<?php echo $fila["PRECIOTORNEO"]; ?>"/>
                                <input id="VIDEOJUEGO" name="VIDEOJUEGO" type="hidden" value="<?php echo $fila["VIDEOJUEGO"]; ?>"/>
                                <input id="MAXPARTICIPANTES" name="MAXPARTICIPANTES" type="hidden" value="<?php echo $fila["MAXPARTICIPANTES"]; ?>"/>
                                <input id="FECHATORNEO" name="FECHATORNEO" type="hidden" value="<?php echo $fila["FECHATORNEO"]; ?>"/>

                                <div class="nombre"><?php echo "<strong>Nombre: </strong>" . $fila["NOMBRETORNEO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Precio: </strong>" . $fila["PRECIOTORNEO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Vidoejuego: </strong>" . $fila["VIDEOJUEGO"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Número máximo de participantes: </strong>" . $fila["MAXPARTICIPANTES"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Fecha: </strong>" . $fila["FECHATORNEO"]; ?></div>


                            <?php } ?>

                        </div>



                        <div id="botones_fila">

                            <?php if (isset($TORNEO) and ($TORNEO["TORNEOS_ID"] == $fila["TORNEOS_ID"])) { ?>

                                <button id="grabar" name="grabar" type="submit" class="editar_fila">

                                    <!--<img src="imagenes/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">
                                    -->

                                    Guardar

                                </button>

                                <button id="cancelar" name="cancelar" type="submit" class="cancelar">

                                    <!--<img src="imagenes/remove_menuito.bmp" class="editar_fila" alt="Borrar consumible">
-->
                                    Cancelar
                                </button>

                            <?php } else { ?>

                                <button id="editar" name="editar" type="submit" class="editar_fila">

                                    <!--<img src="imagenes/pencil_menuito.bmp" class="editar_fila" alt="Editar consumible">
                                    -->
                                    Editar

                                </button>

                                <button id="borrar" name="borrar" type="submit" class="editar_fila">

                                    <!--<img src="imagenes/remove_menuito.bmp" class="editar_fila" alt="Borrar consumible">
-->
                                    Borrar

                                </button>

                            <?php } ?>



                        </div>

                    </div>

                </form>

            </article>



        <?php } ?>

    </div>

    <?php if (!isset($TORNEO)) {?>

        <div>

            <article class="admin_class">

                <form autocomplete="off" method="post" action="controlador_torneos.php">

                    <input id="TORNEOS_ID" name="TORNEOS_ID" type="hidden" value="Fake id"/>
                    <p>Nombre: <input required pattern="^[a-zA-Z0-9 ]+$" maxlength="40" id="NOMBRETORNEO" name="NOMBRETORNEO" type="text" placeholder="Nombre"/></p>
                    <p>Precio: <input required pattern = "^[0-9]+(\.[0-9]{1,2})?$" maxlength="5" id="PRECIOTORNEO" name="PRECIOTORNEO" type="text" placeholder="0.0"/></p>
                    <p>Videojuego: <input required pattern="^[a-zA-Z ]+$" maxlength="20" id="VIDEOJUEGO" name="VIDEOJUEGO" type="text" placeholder="Videojuego"/></p>
                    <p>Número máximo de participantes: <input required pattern = "^[0-9]{1,2}+$" id="MAXPARTICIPANTES" name="MAXPARTICIPANTES" type="text" placeholder="10"/></p>
                    <p>Fecha: <input required id="FECHATORNEO" name="FECHATORNEO" type="date"/></p>

                    <button id="nuevo" name="nuevo" type="submit">

                        Crear un torneo nuevo

                    </button>

                </form>

            </article>

        </div>

    <?php }?>
</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>
