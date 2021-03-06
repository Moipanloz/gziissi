<?php
/*
   * #===========================================================#
   * #	Este fichero contiene las funciones de gesti�n
   * #	de libros de la capa de acceso a datos
   * #==========================================================#
   */

function consultarTodosPases($conexion) {
    $consulta = "SELECT * FROM PASES"
        . " ORDER BY TIPOMEDIO";
    return $conexion->query($consulta);
}

function cantidadDeConsumiblesConTipoMedio ($conexion, $Tipo) {
    $stmt=$conexion->prepare("SELECT COUNT (*) AS TOTAL FROM PASES WHERE TIPOMEDIO = :Tipo" );
    $stmt->bindParam(':Tipo',$Tipo);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function nuevoPase ($conexion, $Tipo) {
    try {
        $stmt=$conexion->prepare('CALL NUEVO_PASE(:Tipo)');
        $stmt->bindParam(':Tipo',$Tipo);

        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}



function modificarPase($conexion,$PaseId,$TipoMedio) {
    try {
        $stmt=$conexion->prepare("UPDATE PASES SET TIPOMEDIO= :Tipo WHERE PASES_ID = :PaseId");
        $stmt->bindParam(':PaseId',$PaseId);
        $stmt->bindParam(':Tipo',$TipoMedio);

        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function cantidadDeBonosConPase ($conexion, $IdPase) {
    $stmt=$conexion->prepare("SELECT COUNT (*) AS TOTAL FROM LINEAPASES WHERE PASES_ID = :PaseId" );
    $stmt->bindParam(':PaseId',$IdPase);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function quitarPase($conexion,$IdPase) {
    try {
        $stmt=$conexion->prepare("DELETE FROM pases WHERE PASES_ID = :IdPase");
        $stmt->bindParam(':IdPase',$IdPase);
        $stmt->execute();

        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

