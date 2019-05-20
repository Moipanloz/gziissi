<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");

require_once("gestion/gestionBD.php");
require_once("gestion/gestionBonos.php");
require_once("gestion/gestionConsumibles.php");
require_once("gestion/gestionPases.php");
require_once("gestion/gestionTorneos.php");

$conexion = crearConexionBD();

$todosLosConsumibles = consultarTodosConsumibles($conexion);

/*if (!isset($_SESSION ["ADMIN"]))

    Header("Location: index.php");

*/

?>


<body>

<div>
    <h2 class="titulo">Administración Consumibles</h2>
    <div class="admin_class">








        <!-- DE LA PRACTICA -->

        <?php

        foreach ($todosLosConsumibles as $fila) {

            ?>

            <article class="consumible">

                <form method="post" action="controlador_consumibles.php">

                    <div class="fila_consumible">

                        <div class="datos_consumible">

                            <input id="CONSUMIBLES_ID" name="CONSUMIBLES_ID"

                                   type="hidden" value="<?php echo $fila["CONSUMIBLES_ID"]; ?>"/>

                            <input id="NOMBRECONSUMIBLE" name="NOMBRECONSUMIBLE"

                                   type="hidden" value="<?php echo $fila["NOMBRECONSUMIBLE"]; ?>"/>

                            <input id="TIPOCONSUMIBLE" name="TIPOCONSUMIBLE"

                                   type="hidden" value="<?php echo $fila["TIPOCONSUMIBLE"]; ?>"/>


                            <?php

                            if (isset($consumible) and ($consumible["CONSUMIBLES_ID"] == $fila["CONSUMIBLES_ID"])) { ?>

                                <!-- Editando título -->

                                <h3><input id="NOMBRE" name="NOMBRE" type="text"
                                           value="<?php echo $fila["NOMBRECONSUMIBLE"]; ?>"/></h3>

                                <!-- Insertar aqui desplegable -->

                                <h4><?php echo $fila["NOMBRE"] . " " . $fila["APELLIDOS"]; ?></h4>

                            <?php } else { ?>

                                <!-- mostrando título -->

                                <input id="NOMBRE" name="NOMBRE" type="hidden"
                                       value="<?php echo $fila["NOMBRECONSUMIBLE"]; ?>"/>

                                <div class="nombre"><b><?php echo $fila["NOMBRECONSUMIBLE"]; ?></b></div>

                                <div class="tipo">By <em><?php echo $fila["TIPOCONSUMIBLE"]; ?></em></div>

                            <?php } ?>

                        </div>


                        <div id="botones_fila">

                            <?php if (isset($consumible) and ($consumible["CONSUMIBLES_ID"] == $fila["CONSUMIBLES_ID"])) { ?>

                                <button id="grabar" name="grabar" type="submit" class="editar_fila">

                                    <img src="imagenes/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">

                                </button>

                            <?php } else { ?>

                                <button id="editar" name="editar" type="submit" class="editar_fila">

                                    <img src="imagenes/pencil_menuito.bmp" class="editar_fila" alt="Editar libro">

                                </button>

                            <?php } ?>

                            <button id="borrar" name="borrar" type="submit" class="editar_fila">

                                <img src="imagenes/remove_menuito.bmp" class="editar_fila" alt="Borrar libro">

                            </button>

                        </div>

                    </div>

                </form>

            </article>

        <?php } ?>


    </div>
</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>

<?php /*
 
 dis was there before

 <div class="moishit">

            <form>

            <span>

                <label for="CONSUMIBLE_NAME">Nombre de Consumible</label>
                <input type="text" name="CONSUMIBLE_NAME" value="" id="CONSUMIBLE_NAME"/>

            </span>

                <span>
                    <label for="CONSUMIBLE_TYPE">Tipo de Consumible</label>
                    <select name="OS">

                        <option value="1">Windows Vista</option>
                        <option value="2">Windows 7</option>
                        <option value="3">Windows XP</option>
                        <option value="10">Fedora</option>
                        <option value="11">Debian</option>
                        <option value="12">Suse</option>

                    </select>
                </span>
            </form>

        </div>


        <div id="consumibles-div">
            <h2>Consumibles</h2>
            <span>

					<!--FOR EACH CONUSMIBLE-->
                            <h3>Nombre Consumible</h3>


                    <?php

                    foreach ($todosLosConsumibles as $c) {


                        if (isset($editandoConsumible) && ($editandoConsumible ["c"] == $c)) { ?>

                            <h3><input type="text" name="CONUSMIBLE" value="<?php print $c ["NOMBRECONSUMIBLE"] ?>"
                                       id="CONUSMIBLE"/></h3>


                            <input id="guardar" name="guardar" type="submit" value="Guardar"
                                   class="boton_administracion">


                        <?php } else { ?>


                            <ul>
							<!-- FOR EACH ELEMENTO -->
						<li><?php print ($c ["NOMBRECONSUMIBLE"] . " - " . $c["TIPOCONSUMIBLE"]) ?></li>
                                <!---->
					</ul>

                            <input id="editar" name="editar" type="submit" value="Editar" class="boton_administracion">
						<!---->
						<input id="borrar" name="borrar" type="submit" value="Borrar" class="boton_administracion">


                        <?php }


                    }

                    ?>

            </span>
        </div>

 */
