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

    if (empty($res)) {
        $empty ["NOMBRECONSUMIBLE"] = "No contiene ningún consumible";
        $res [0] = $empty;
    }

    return $res;
}

function quitar_consumible($conexion,$OidConsumible) {
	try {

        //IDUNO ABOUT THIS YET
		$stmt=$conexion->prepare('CALL QUITAR_CONSUMIBLE(:OidConsumible)');
		$stmt->bindParam(':OidConsumible',$OidConsumible);
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