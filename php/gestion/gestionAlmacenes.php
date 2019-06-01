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

function anadirPaseAUsuario($conexion, $IdPase)
{

    try {

        $consulta = "CALL ANADIR_PASE_A_USUARIO(:IdPase)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdPase', $IdPase);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function borrarPaseDeUsuario($conexion, $IdAlmacen)
{

    try {

        $consulta = "CALL BORRAR_PASE_DE_USUARIO(:IdAlmacen)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdAlmacen', $IdAlmacen);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function borrarConsumibleDeUsuario($conexion, $IdAlmacen)
{

    try {

        $consulta = "CALL BORRAR_CONSUMIBLE_DE_USUARIO(:IdAlmacen)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':IdAlmacen', $IdAlmacen);
        $stmt->execute();
        return "";
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

