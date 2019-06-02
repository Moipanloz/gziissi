<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Adm. Pases</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");

require_once("gestion/gestionBD.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionPases.php");

if (isset($_SESSION["PASE"])) {
    $PASE = $_SESSION["PASE"];
    unset($_SESSION["PASE"]);
}

$conexion = crearConexionBD();

$todosLosPases = consultarTodosPases($conexion);

if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");



?>


<body>

<?php if (isset($_SESSION ["warning"])) {?>

    <div ><?php print ($_SESSION ["warning"])?></div>

    <?php

    unset($_SESSION ["warning"]);

} ?>



<div>
    <h2 class="titulo">Administración Pases</h2>
    <div class="admin_class">


        <!-- DE LA PRACTICA -->

        <?php

        foreach($todosLosPases as $fila) {

            ?>



            <article class="pases">

                <form method="post" action="controlador_pases.php" autocomplete="off">

                    <div class="fila_pases">

                        <div class="datos_pase">

                            <input id="PASES_ID" name="PASES_ID"

                                   type="hidden" value="<?php echo $fila["PASES_ID"]; ?>"/>

                            <?php

                            if (isset($PASE) and ($PASE["PASES_ID"] == $fila["PASES_ID"])) { ?>

                                <!-- Editando título -->

                                <h3><input maxlength="40" id="TIPOMEDIO" name="TIPOMEDIO" type="text" value="<?php echo $fila["TIPOMEDIO"]; ?>"/>	</h3>

                            <?php }	else { ?>

                                <!-- mostrando título -->

                                <input id="TIPOMEDIO" name="TIPOMEDIO" type="hidden" value="<?php echo $fila["TIPOMEDIO"]; ?>"/>

                                <div class="TIPOMEDIO"><b><?php echo $fila["TIPOMEDIO"]; ?></b></div>

                            <?php } ?>

                        </div>



                        <div id="botones_fila">

                            <?php if (isset($PASE) and ($PASE["PASES_ID"] == $fila["PASES_ID"])) { ?>

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

         if (!isset($PASE)) {?>

                <article>
                    <form autocomplete="off" method="post" action="controlador_pases.php">
                        <input id="PASES_ID" name="PASES_ID" type="hidden" value="Fake id"/>
                        <input maxlength="20" id="TIPOMEDIO" name="TIPOMEDIO" type="text" placeholder="Nuevo Pase"/>
                        <div style="margin-top: 5%;">
                            <button class="boton" id="nuevo" name="nuevo" type="submit">Crear un pase nuevo</button>
                        </div>
                    </form>
                </article>
        <?php }?>
    </div>
</div>
<?php cerrarConexionBD($conexion) ?>
</body>
</html>