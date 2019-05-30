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
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");

if (isset($_SESSION["CONSUMIBLE"])) {
    $CONSUMIBLE = $_SESSION["CONSUMIBLE"];
    unset($_SESSION["CONSUMIBLE"]);
}

$conexion = crearConexionBD();

$todosLosConsumibles = consultarTodosConsumibles($conexion);

if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");



?>



<body>

<?php if (isset($_SESSION ["warning"])) {

     print ("<div>".($_SESSION ["warning"])."</div>");

    unset($_SESSION ["warning"]);

} ?>



<div>
    <h2 class="titulo">Administración Consumibles</h2>
    <div class="admin_class">


        <!-- DE LA PRACTICA -->

        <?php

        foreach($todosLosConsumibles as $fila) {

            ?>



            <article class="consumibles">

                <form method="post" action="controlador_consumibles.php" autocomplete="off">

                    <div class="fila_consumibles">

                        <div class="datos_consumible">

                            <input id="CONSUMIBLES_ID" name="CONSUMIBLES_ID"

                                   type="hidden" value="<?php echo $fila["CONSUMIBLES_ID"]; ?>"/>

                            <?php

                            if (isset($CONSUMIBLE) and ($CONSUMIBLE["CONSUMIBLES_ID"] == $fila["CONSUMIBLES_ID"])) { ?>

                                <!-- Editando título -->

                                <h3><input maxlength="40" id="NOMBRECONSUMIBLE" name="NOMBRECONSUMIBLE" type="text" value="<?php echo $fila["NOMBRECONSUMIBLE"]; ?>"/>	</h3>

                                <select name="TIPOCONSUMIBLE">
                                    <option value="Bebida generica">Bebida generica</option>
                                    <option value="Bebida alcoholica">Bebida alcoholica</option>
                                    <option value="Comida">Comida</option>
                                </select>

                            <?php }	else { ?>

                                <!-- mostrando título -->

                                <input id="NOMBRECONSUMIBLE" name="NOMBRECONSUMIBLE" type="hidden" value="<?php echo $fila["NOMBRECONSUMIBLE"]; ?>"/>

                                <input id="TIPOCONSUMIBLE" name="TIPOCONSUMIBLE" type="hidden" value="<?php echo $fila["TIPOCONSUMIBLE"]; ?>"/>

                                <div class="nombre"><b><?php echo $fila["NOMBRECONSUMIBLE"]; ?></b></div>

                                <div class="tipo"><em><?php echo $fila["TIPOCONSUMIBLE"]; ?></em></div>

                            <?php } ?>

                        </div>



                        <div id="botones_fila">

                            <?php if (isset($CONSUMIBLE) and ($CONSUMIBLE["CONSUMIBLES_ID"] == $fila["CONSUMIBLES_ID"])) { ?>

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

    <?php if (!isset($CONSUMIBLE)) {?>

    <div>

        <article class="admin_class">

            <form autocomplete="off" method="post" action="controlador_consumibles.php">

                <input id="CONSUMIBLES_ID" name="CONSUMIBLES_ID" type="hidden" value="Fake id"/>

                <h3><input maxlength="40" id="NOMBRECONSUMIBLE" name="NOMBRECONSUMIBLE" type="text" placeholder="Nuevo Consumible"/></h3>

                <select name="TIPOCONSUMIBLE">
                    <option value="Bebida generica">Bebida generica</option>
                    <option value="Bebida alcoholica">Bebida alcoholica</option>
                    <option value="Comida">Comida</option>
                </select>

                <button id="nuevo" name="nuevo" type="submit">

                    Crear un consumible nuevo

                    <img src="imagenes/create.png" class="editar_fila" alt="Borrar consumible">

                </button>

            </form>

        </article>

    </div>

    <?php }?>

</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>