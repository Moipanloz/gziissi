<?php

    function consumiblesDeUsuario($conexion, $Dni)
    {

        try {
            $stmt = $conexion->prepare("SELECT ALMACENESCONSUMIBLES.ALMACENESCONSUMIBLES_ID, CONSUMIBLES.NOMBRECONSUMIBLE, ALMACENESCONSUMIBLES.CANTIDADCONSUMIBLE FROM ALMACENESCONSUMIBLES INNER JOIN CONSUMIBLES ON CONSUMIBLES.CONSUMIBLES_ID = ALMACENESCONSUMIBLES.CONSUMIBLES_ID WHERE ALMACENESCONSUMIBLES.DNI = :Dni");
            $stmt->bindParam(':Dni', $Dni);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function pasesDeUsuario($conexion, $Dni)
    {

        try {
            $stmt = $conexion->prepare("SELECT ALMACENESPASES.ALMACENESPASES_ID, PASES.TIPOMEDIO, ALMACENESPASES.CANTIDADPASE FROM ALMACENESPASES INNER JOIN PASES ON PASES.PASES_ID = ALMACENESPASES.PASES_ID WHERE ALMACENESPASES.DNI = :Dni");
            $stmt->bindParam(':Dni', $Dni);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

function anadirPaseAUsuario($conexion, $IdPase, $Dni)
{

    try {

        $consulta = "CALL ANADIR_PASE_A_USUARIO(:IdPase, :Dni)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdPase', $IdPase);
        $stmt->bindParam(':Dni', $Dni);

        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function anadirConsumibleAUsuario($conexion, $IdConsumible, $Dni)
{

    try {

        $consulta = "CALL ANADIR_CONSUMIBLE_A_USUARIO(:IdCons, :Dni)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdCons', $IdConsumible);
        $stmt->bindParam(':Dni', $Dni);

        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function borrarPaseDeUsuario($conexion, $IdAlmacenP)
{

    try {

        $consulta = "CALL BORRAR_PASE_DE_USUARIO(:IdAlmacen)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdAlmacen', $IdAlmacenP);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function borrarConsumibleDeUsuario($conexion, $IdAlmacenC)
{

    try {

        $consulta = "CALL BORRAR_CONSUMIBLE_DE_USUARIO(:IdAlmacen)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdAlmacen', $IdAlmacenC);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

