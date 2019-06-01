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
require_once("gestion/gestionVentas.php");

$conexion = crearConexionBD();


if (isset($_SESSION["LINEAVENTA"])) {
    $LINEAVENTA = $_SESSION["LINEAVENTA"];
    unset($_SESSION["LINEAVENTA"]);
}

$conexion = crearConexionBD();

$todasLasLV = consultarTodasLineasVentas($conexion);

if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");



?>

<body>

<?php if (isset($_SESSION ["warning"])) {

    print ("<div>".($_SESSION ["warning"])."</div>");

    unset($_SESSION ["warning"]);

} ?>



<div>
    <h2 class="titulo">Administración Lineas de Venta</h2>
    <div class="admin_class">


        <!-- DE LA PRACTICA -->

        <?php

        foreach($todasLasLV as $fila) {

            ?>



            <article class="consumibles">

                <form method="post" action="controlador_lineasventa.php" autocomplete="off">

                    <div class="fila_consumibles">

                        <div class="datos_consumible">

                            <input id="LINEAVENTAS_ID" name="LINEAVENTAS_ID"

                                   type="hidden" value="<?php echo $fila["LINEAVENTAS_ID"]; ?>"/>

                            <?php

                            if (isset($LINEAVENTA) and ($LINEAVENTA["LINEAVENTAS_ID"] == $fila["LINEAVENTAS_ID"])) { ?>

                                <!-- Editando título -->

                                <P><input maxlength="40" id="CANTIDADLV" name="CANTIDADLV" type="text" value="<?php echo $fila["CANTIDADLV"]; ?>"/>	</P>
                                <P><input maxlength="40" id="PRECIOLV" name="PRECIOLV" type="text" value="<?php echo $fila["PRECIOLV"]; ?>"/>	</P>
                                <P><input maxlength="40" id="DESCUENTO" name="DESCUENTO" type="text" value="<?php echo $fila["DESCUENTO"]; ?>"/>	</P>


                            <?php }	else { ?>

                                <!-- mostrando título -->

                                <input id="CANTIDAD" name="CANTIDADLV" type="hidden" value="<?php echo $fila["CANTIDADLV"]; ?>"/>
                                <input id="PRECIO" name="PRECIOLV" type="hidden" value="<?php echo $fila["PRECIOLV"]; ?>"/>
                                <input id="DESCUENTO" name="DESCUENTO" type="hidden" value="<?php echo $fila["DESCUENTO"]; ?>"/>

                                <div class="nombre"><?php echo "<strong>Cantidad: </strong>".$fila["CANTIDADLV"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Precio: </strong>".$fila["PRECIOLV"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Descuento: </strong>".$fila["DESCUENTO"]; ?></div>

                            <?php } ?>

                        </div>



                        <div id="botones_fila">

                            <?php if (isset($LINEAVENTA) and ($LINEAVENTA["LINEAVENTAS_ID"] == $fila["LINEAVENTAS_ID"])) { ?>

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

    <?php if (!isset($LINEAVENTA)) {?>

        <div>

            <article class="admin_class">

                <form autocomplete="off" method="post" action="controlador_lineasventa.php">

                    <input id="LINEAVENTAS_ID" name="LINEAVENTAS_ID" type="hidden" value="Fake id"/>

                    <p>Cantidad: <input required pattern="^[a-zA-Z ]+$" maxlength="40" id="CANTIDADLV" name="CANTIDADLV" type="text" placeholder="Cantidad"/></p>
                    <p>Precio: <input required pattern="^[a-zA-Z ]+$" maxlength="40" id="PRECIOLV" name="PRECIOLV" type="text" placeholder="Precio"/></p>
                    <p>Descuento: <input required pattern="^[a-zA-Z ]+$" maxlength="40" id="DESCUENTO" name="DESCUENTO" type="text" placeholder="Descuento"/></p>



                    <button id="nuevo" name="nuevo" type="submit">

                        Crear una linea de venta nueva

                    </button>

                </form>

            </article>

        </div>

    <?php }?>

</div>

<?php cerrarConexionBD($conexion) ?>
</body>
