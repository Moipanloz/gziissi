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




    if (empty($res)) $res = null;

    return $res;
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



