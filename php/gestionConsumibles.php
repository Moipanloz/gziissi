<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de libros de la capa de acceso a datos 		
     * #==========================================================#
     */

function consultarTodosConsumibles($conexion) {
	$consulta = "SELECT * FROM CONSUMIBLES"
		. " ORDER BY NOMBRECONSUMIBLE";
    return $conexion->query($consulta);
}

function consultarConsumiblesDeBono($conexion, $OidBono) {
	$consulta = "SELECT * FROM CONSUMIBLES"
        . "WHERE BONO_ID = " .$OidBono
		. " ORDER BY NOMBRECONSUMIBLE";
    return $conexion->query($consulta);
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