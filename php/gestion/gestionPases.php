<?php
/*
   * #===========================================================#
   * #	Este fichero contiene las funciones de gesti�n
   * #	de libros de la capa de acceso a datos
   * #==========================================================#
   */

function consultarTodosPases($conexion) {
    $consulta = "SELECT * FROM CONSUMIBLES"
        . " ORDER BY NOMBRECONSUMIBLE";
    return $conexion->query($consulta);
}

function consultarPasesDeBono($conexion, $OidBono) {
    $consulta1 = "SELECT * FROM LINEAPASES WHERE BONOS_ID = " . $OidBono;
    $lineasConsumibles = $conexion -> query ($consulta1);


    foreach ($lineasConsumibles as $l) {

        $consulta = "SELECT * FROM PASES "
            . "WHERE PASES_ID = " . $l ["PASES_ID"];

        $pases = $conexion->query($consulta);

        foreach ($pases as $c) {
            $res [] = $c;
        }


    }




    if (empty($res)) {
        $empty ["NOMBREPASE"] = "No contiene ningún pase";
        $res [0] = $empty;
    }

    return $res;
}

function quitar_pase($conexion,$OidPase) {
    try {

        //IDUNO ABOUT THIS YET
        $stmt=$conexion->prepare('CALL QUITAR_PASE(:OidPase)');
        $stmt->bindParam(':OidPase',$OidPase);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

//THIS NEITHER
/*
function modificar_bono($conexion,$OidLibro,$TituloLibro) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_TITULO(:OidLibro,:TituloLibro)');
		$stmt->bindParam(':OidLibro',$OidLibro);
		$stmt->bindParam(':TituloLibro',$TituloLibro);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
*/

?>