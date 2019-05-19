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


/*if (!isset($_SESSION ["ADMIN"]))

    Header("Location: index.php");

*/

?>


<body>

<div>
    <h2 class="titulo">Administración Bonos</h2>
    <div class="admin_class">
        <div class="grid-container-admin-class">


        <div id="consumibles-div">
            <h2>Consumibles</h2>
            <span>

					<!--FOR EACH CONUSMIBLE-->
                            <h3>Nombre Consumible</h3>


                    <?php $todosLosConsumibles = consultarTodosConsumibles($conexion);

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


            <!--FOR EACH BONO HASTA MAXIMO DE 3 POR PAG-->
            <div>
                <!-- CUANDO ESTE EDITANDO -->
                <h3><input type="text" name="BONO" value="" id="BONO"/></h3>
                <ul>
                    <!-- FOR EACH ELEMENTO -->
                    <li>Elemento</li>
                    <!---->
                </ul>
                <!-- CUANDO SE MUESTRE -->
                <h3>NombreBono</h3>
                <ul>
                    <!-- FOR EACH ELEMENTO -->
                    <li>Elemento</li>
                    <!---->
                </ul>
                <!---->
                <!---->
                <div class="botones_administracion">
                    <!-- SI ESTA EDITANDO -->
                    <input id="guardar" name="guardar" type="submit" value="Guardar" class="boton_administracion">
                    <!-- SI NO -->
                    <input id="editar" name="editar" type="submit" value="Editar" class="boton_administracion">
                    <!---->
                    <input id="borrar" name="borrar" type="submit" value="Borrar" class="boton_administracion">
                </div>
            </div>

            <div>
                Pagniacion
            </div>
        </div>
    </div>
</div>

<?php cerrarConexionBD($conexion) ?>
</body>
</html>
