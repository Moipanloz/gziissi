<?php
/*
   * #===========================================================#
   * #	Este fichero contiene las funciones de gestión
   * #	de libros de la capa de acceso a datos
   * #==========================================================#
   */

function consultarTodosBonos($conexion)
{
    $consulta = "SELECT * FROM BONOS"
        . " ORDER BY BONOS_ID";
    return $conexion->query($consulta);
}

function lineasConsumiblesDeBono($conexion, $BonoId)
{

    try {
        $stmt = $conexion->prepare("SELECT LINEACONSUMIBLES.LINEACONSUMIBLES_ID, CONSUMIBLES.NOMBRECONSUMIBLE, LINEACONSUMIBLES.CANTIDADLC FROM LINEACONSUMIBLES INNER JOIN CONSUMIBLES ON LINEACONSUMIBLES.CONSUMIBLES_ID = CONSUMIBLES.CONSUMIBLES_ID WHERE LINEACONSUMIBLES.BONOS_ID = :BonosId");
        $stmt->bindParam(':BonosId', $BonoId);
        $stmt->execute();

        return $stmt;

    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function lineasPasesDeBono($conexion, $ConsumibleId)
{


}

function anadirConsumibleABono($conexion, $IdConsumible, $IdBono)
{

    try {

        $consulta = "CALL INTRODUCIR_CONSUMIBLE_EN_BONO (:ConsumiblesId, :BonosId)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':ConsumiblesId', $IdConsumible);
        $stmt->bindParam(':BonosId', $IdBono);

        return $stmt -> execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function getBonoFromId($conexion, $IdBono)
{
    try {
        $stmt = $conexion->prepare('SELECT * FROM BONOS WHERE BONOS_ID = :IdBono ');
        $stmt->bindParam(':IdBono', $IdBono);

        return $stmt->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function modificarBono($conexion, $BONOS_ID, $NOMBRE, $PRECIO, $DISPONIBLE)
{


    try {
        $stmt=$conexion->prepare("UPDATE BONOS SET PRECIOBONO= :Precio, NOMBREBONO=:Nombre, DISPONIBLE=:Disponible  WHERE BONOS_ID = :Bonoid");
        $stmt->bindParam(':Nombre', $NOMBRE);
        $stmt->bindParam(':Precio', $PRECIO);

        if ($DISPONIBLE == "TRUE" || $DISPONIBLE == true) $bool = 'TRUE';
        else $bool = 'FALSE';

        $stmt->bindParam(':Disponible', $bool);
        $stmt->bindParam(':Bonoid', $BONOS_ID);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

;

