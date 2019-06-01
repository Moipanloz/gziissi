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
}

function cantidadDeUsuariosEnTorneo ($conexion, $IdTorneo) {
    $stmt=$conexion->prepare("SELECT COUNT (*) AS TOTAL FROM PARTICIPANTESTORNEOS WHERE TORNEOS_ID = :TorneoId" );
    $stmt->bindParam(':TorneoId',$IdTorneo);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function quitarTorneo ($conexion,$IdTorneo) {
    try {
        $stmt=$conexion->prepare("DELETE FROM TORNEOS WHERE TORNEOS_ID = :IdTorneo");
        $stmt->bindParam(':IdTorneo',$IdTorneo);
        $stmt->execute();

        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function modificarTorneo($conexion,$TorneoId,$Precio, $Videojuego, $MaxPart, $Nombre, $Fecha) {
    try {

        $fechaTorneo = date('d/M/Y', strtotime($Fecha));

        $stmt=$conexion->prepare("UPDATE TORNEOS SET PRECIOTORNEO= :Precio, VIDEOJUEGO= :Videojuego, MAXPARTICIPANTES= :Maxpart, NOMBRETORNEO= :Nombre, FECHATORNEO= :Fecha WHERE TORNEOS_ID = :TorneoId");
        $stmt->bindParam(':TorneoId',$TorneoId);
        $stmt->bindParam(':Precio',$Precio);
        $stmt->bindParam(':Videojuego',$Videojuego);
        $stmt->bindParam(':Maxpart',$MaxPart);
        $stmt->bindParam(':Nombre',$Nombre);
        $stmt->bindParam(':Fecha',$fechaTorneo);


        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function estaParticipando($conexion, $dni, $tID){
    $stmt = $conexion->prepare("SELECT COUNT (*) FROM PARTICIPANTESTORNEOS WHERE (PARTICIPANTESTORNEOS.DNI = :dni"
        . " AND PARTICIPANTESTORNEOS.TORNEOS_ID = :tID)");
    $stmt->bindParam(':tID',$tID);
    $stmt->bindParam(':dni',$dni);
    $stmt->execute();
    return $stmt->fetchColumn();
}


function cantidadDeTorneosConNombre ($conexion, $Nombre) {
    $stmt=$conexion->prepare("SELECT COUNT (*) AS TOTAL FROM TORNEOS WHERE NOMBRETORNEO = :Nombre" );
    $stmt->bindParam(':Nombre',$Nombre);
    $stmt->execute();
    return $stmt->fetchColumn();
}


function nuevoTorneo ($conexion, $PrecioTorneo, $Videojuego, $MaxParticipantes, $NombreTorneo, $FechaTorneo) {
    try {

    	$fecha = date('d/M/Y', strtotime($FechaTorneo));

        $stmt=$conexion->prepare('CALL NUEVO_TORNEO(:Precio, :Videojuego, :MaxParticipantes, :Nombre, :FechaTorneo)');
        $stmt->bindParam(':Nombre',$NombreTorneo);
        $stmt->bindParam(':Precio',$PrecioTorneo);
        $stmt->bindParam(':Videojuego',$Videojuego);
        $stmt->bindParam(':MaxParticipantes',$MaxParticipantes);
        $stmt->bindParam(':FechaTorneo',$fecha);


        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
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