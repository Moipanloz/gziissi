<?php
/*
   * #===========================================================#
   * #	Este fichero contiene las funciones de gestión
   * #	de libros de la capa de acceso a datos
   * #==========================================================#
   */

require_once ("gestionAlmacenes.php");

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

function lineasPasesDeBono($conexion, $BonoId)
{

    try {
        $stmt = $conexion->prepare("SELECT LINEAPASES.LINEAPASES_ID, PASES.TIPOMEDIO, LINEAPASES.CANTIDADLP FROM LINEAPASES INNER JOIN PASES ON LINEAPASES.PASES_ID = PASES.PASES_ID WHERE LINEAPASES.BONOS_ID = :BonosId");
        $stmt->bindParam(':BonosId', $BonoId);
        $stmt->execute();

        return $stmt;

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function anadirConsumibleABono($conexion, $IdConsumible, $IdBono)
{

    try {

        $consulta = "CALL INTRODUCIR_CONSUMIBLE_EN_BONO(:ConsumiblesId, :BonosId)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':ConsumiblesId', $IdConsumible);
        $stmt->bindParam(':BonosId', $IdBono);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function borrarConsumibleDeBono($conexion, $IdLineaConsumible)
{

    try {

        $consulta = "CALL BORRAR_CONSUMIBLE_DE_BONO(:IdLineaConsumible)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdLineaConsumible', $IdLineaConsumible);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function anadirPaseABono($conexion, $IdPase, $IdBono)
{

    try {

        $consulta = "CALL INTRODUCIR_PASE_EN_BONO(:PaseId, :BonosId)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':PaseId', $IdPase);
        $stmt->bindParam(':BonosId', $IdBono);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function borrarPaseDeBono($conexion, $IdLineaPase)
{

    try {

        $consulta = "CALL BORRAR_PASE_DE_BONO(:IdLineaPase)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdLineaPase', $IdLineaPase);
        $stmt->execute();
        return "";
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
        $stmt = $conexion->prepare("UPDATE BONOS SET PRECIOBONO= :Precio, NOMBREBONO=:Nombre, DISPONIBLE=:Disponible  WHERE BONOS_ID = :Bonoid");
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

function crearNuevoBono ($conexion, $Nombre) {

    try {

        $stmt = $conexion->prepare("CALL NUEVO_BONO (:Nombre, 10.00, 'TRUE') ");
        $stmt->bindParam (':Nombre', $Nombre);

        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}


function anadirBonoAUsuario($conexion,$BONO_ID,$DNI){
    try{

        $stmt1 = $conexion->prepare("SELECT * FROM LINEAPASES WHERE BONOS_ID = :BonosId");
        $stmt1->bindParam (':BonosId', $BONO_ID);
        $stmt1->execute();

        foreach ($stmt1 as $item) {
            $count = $item ["CANTIDADLP"];
            while ($count >0) {

                anadirPaseAUsuario($conexion, $item ["PASES_ID"], $DNI);

                $count = $count -1;
            }
        }


        $stmt2 = $conexion->prepare("SELECT * FROM LINEACONSUMIBLES WHERE BONOS_ID = :BonosId");
        $stmt2->bindParam (':BonosId', $BONO_ID);
        $stmt2->execute();

        foreach ($stmt2 as $item) {
            $count = $item ["CANTIDADLC"];
            while ($count >0) {

                anadirConsumibleAUsuario($conexion, $item ["CONSUMIBLES_ID"], $DNI);

                $count = $count -1;
            }
        }

        return "";

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}



