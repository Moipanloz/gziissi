<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de libros de la capa de acceso a datos 		
     * #==========================================================#
     */

function consultarTodosBonos($conexion) {
	$consulta = "SELECT * FROM BONOS"
		. " ORDER BY NOMBREBONO";
    return $conexion->query($consulta);
}

function quitar_bono($conexion,$OidBono) {
	try {

        //IDUNO ABOUT THIS YET
		$stmt=$conexion->prepare('CALL QUITAR_BONO(:OidBono)');
		$stmt->bindParam(':OidBono',$OidBono);
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