<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamers Zone - Adm. Ventas</title>
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="icon" type="image/png" href="imagenes/favicon-32x32.png">
</head>

<?php include_once("cabecera.php");

require_once("gestion/gestionBD.php");
require_once("gestion/gestionVentas.php");
require_once("gestion/paginacion_consulta.php");

$conexion = crearConexionBD();

if (!isset($_SESSION ["login_dni"]) || $_SESSION ["login_dni"] != "00000000A")

    Header("Location: index.php");

else {

    // ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
    // ¿Hay una sesión activa?
    if (isset($_SESSION["paginacion"]))
        $paginacion = $_SESSION["paginacion"];

    $pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
    $pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

    if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
    if ($pag_tam < 1) 		$pag_tam = 5;

    // Antes de seguir, borramos las variables de sección para no confundirnos más adelante
    unset($_SESSION["paginacion"]);

    $conexion = crearConexionBD();

    // La consulta que ha de paginarse
    $query = 'SELECT VENTAS.*, USUARIOS.NOMBRE FROM VENTAS INNER JOIN USUARIOS ON VENTAS.DNI = USUARIOS.DNI '
        . 'ORDER BY FECHAVENTA ASC';

    // Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
    // En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
    $total_registros = total_consulta($conexion, $query);
    $total_paginas = (int)($total_registros / $pag_tam);

    if ($total_registros % $pag_tam > 0)		$total_paginas++;

    if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

    // Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
    $paginacion["PAG_NUM"] = $pagina_seleccionada;
    $paginacion["PAG_TAM"] = $pag_tam;
    $_SESSION["paginacion"] = $paginacion;

    $filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);

    cerrarConexionBD($conexion);
}

?>

<body>

<div>
    <h2 class="titulo">Administración Lineas de Venta</h2>

    <div style="background-color: rgb(89, 163, 255);width:30%;margin:auto;">

        <div style="width: 10%;margin:0;display:inline;" >
            <?php

            for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

                if ( $pagina == $pagina_seleccionada) { 	?>

                    <p class="current"><?php echo $pagina; ?></p>

                <?php }	else { ?>

                    <a href="ventas_admin.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

                <?php } ?>
        </div>
        <div style="width:30%;margin:0;display:inline;">
            <form  method="get" action="ventas_admin.php">
                <input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
                Mostrando
                <input id="PAG_TAM" name="PAG_TAM" type="number"
                       min="1" max="<?php echo $total_registros; ?>"
                       value="<?php echo $pag_tam?>" autofocus="autofocus" />
                entradas de <?php echo $total_registros?>
                <input class="boton" type="submit" value="Cambiar">
            </form>
        </div>
    </div>

    <div class="admin_class">




        <!-- DE LA PRACTICA -->

        <?php

        foreach($filas as $fila) {

            ?>



            <article class="consumibles">


                    <div class="fila_consumibles">

                        <div class="datos_consumible">

                                <div class="nombre"><?php echo "<strong>Nombre del usuario: </strong>".$fila["NOMBRE"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Fecha: </strong>".$fila["FECHAVENTA"]; ?></div>

                            <?php

                            $lineasVenta = consultarLineasDeVenta($conexion, $fila ["VENTAS_ID"]);

                            foreach ($lineasVenta as $lv) { ?>

                                <div class="nombre"><?php echo "<strong>Bono: </strong>".$lv["NOMBREBONO"]." - ".$lv["CANTIDADLV"]; ?></div>
                                <div class="nombre"><?php echo "<strong>Precio: </strong>".$lv["PRECIOLV"]; ?></div>

                                <?php
                            }

                            ?>

                            <div class="nombre"><?php echo "<strong>Total: </strong>".precioTotalVenta($conexion, $fila["VENTAS_ID"]); ?></div>

                        </div>

                    </div>


            </article>



        <?php } ?>

    </div>

</div>

<?php cerrarConexionBD($conexion) ?>
</body>
