<?php
/*
   * #===========================================================#
   * #	Este fichero contiene las funciones de gestión
   * #	de libros de la capa de acceso a datos
   * #==========================================================#
   */

function consultarTodosTorneos($conexion) {
    $consulta = "SELECT * FROM TORNEOS"
        . " ORDER BY FECHATORNEO DESC";
    return $conexion->query($consulta);
}
/*
function inscripcionTorneo($conexion,$dni,$torneosID) {
    try {
        $stmt=$conexion->prepare('CALL INSCRIPCION(:dni,:torneosID)');
        $stmt->bindParam(':dni',$dni);
        $stmt->bindParam(':torneosID',$torneosID);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}*/

function estaParticipando($conexion, $dni, $tID){
    $stmt = $conexion->prepare("SELECT COUNT (*) FROM PARTICIPANTESTORNEOS WHERE (PARTICIPANTESTORNEOS.DNI = :dni"
        . " AND PARTICIPANTESTORNEOS.TORNEOS_ID = :tID)");
    $stmt->bindParam(':tID',$tID);
    $stmt->bindParam(':dni',$dni);
    $stmt->execute();
    return $stmt->fetchColumn();
}


/*

function quitar_bono($conexion,$OidBono) {
    try {

        //IDUNO ABOUT THIS YET
        $stmt=$conexion->prepare('CALL QUITAR_RETO(:OidBono)');
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