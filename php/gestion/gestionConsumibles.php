<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gesti�n     			 
     * #	de libros de la capa de acceso a datos 		
     * #==========================================================#
     */

function consultarTodosConsumibles($conexion) {
	$consulta = "SELECT * FROM CONSUMIBLES"
		. " ORDER BY NOMBRECONSUMIBLE";
    return $conexion->query($consulta);
}

function consultarConsumiblesDeBono($conexion, $OidBono) {
    $consulta1 = "SELECT * FROM LINEACONSUMIBLES WHERE BONOS_ID = " . $OidBono;
    $lineasConsumibles = $conexion -> query ($consulta1);


    foreach ($lineasConsumibles as $l) {

        $consulta = "SELECT * FROM CONSUMIBLES "
            . "WHERE CONSUMIBLES_ID = " . $l ["CONSUMIBLES_ID"];

            $consumibles = $conexion->query($consulta);

            foreach ($consumibles as $c) {
                $res [] = $c;
            }


    }

    if (empty($res)) $res = null;

    return $res;
}

function quitar_consumible($conexion,$OidConsumible) {
    try {

        $consulta = "DELETE * FROM CONSUMIBLES WHERE CONSUMIBLES_ID = " . $OidConsumible;

        return $conexion -> query ($consulta);
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}


function modificar_consumible($conexion,$OidConsumible,$NombreConsumible, $TipoConsumible) {
	try {

	    $consulta = "UPDATE CONSUMIBLES SET NOMBRECONSUMIBLE=" . $NombreConsumible . ", TIPOCONSUMIBLE=" . $TipoConsumible . " WHERE CONSUMIBLES_ID = " . $OidConsumible;

        return $conexion -> query ($consulta);
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
    
?>