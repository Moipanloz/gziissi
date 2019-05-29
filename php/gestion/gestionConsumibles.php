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

function nuevoConsumible ($conexion, $NombreConsumible, $TipoConsumible) {
    try {
        $stmt=$conexion->prepare('CALL NUEVO_CONSUMIBLE(:Nombre, :Tipo)');
        $stmt->bindParam(':Nombre',$NombreConsumible);
        $stmt->bindParam(':Tipo',$TipoConsumible);

        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function consultarConsumiblesDeBono($conexion, $OidBono) {
    try {
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

    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function cantidad_de_bonos_con_consumible ($conexion, $OidConsumible) {
    $stmt=$conexion->prepare("SELECT COUNT (*) AS TOTAL FROM LINEACONSUMIBLES WHERE CONSUMIBLES_ID = :ConsumibleId" );
    $stmt->bindParam(':ConsumibleId',$OidConsumible);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function quitar_consumible($conexion,$OidConsumible) {
    try {
        $stmt=$conexion->prepare("DELETE FROM CONSUMIBLES WHERE CONSUMIBLES_ID = :OidConsumible");
        $stmt->bindParam(':OidConsumible',$OidConsumible);
        $stmt->execute();

        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

function modificar_consumible($conexion,$OidConsumible,$NombreConsumible, $TipoConsumible) {
    try {
        $stmt=$conexion->prepare("UPDATE CONSUMIBLES SET NOMBRECONSUMIBLE= :NombreConsumible, TIPOCONSUMIBLE=:TipoConsumible WHERE CONSUMIBLES_ID = :Consumible_ID");
        $stmt->bindParam(':NombreConsumible',$NombreConsumible);
        $stmt->bindParam(':TipoConsumible',$TipoConsumible);
        $stmt->bindParam(':Consumible_ID',$OidConsumible);

        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}
