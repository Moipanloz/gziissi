<?php
/*
   * #===========================================================#
   * #	Este fichero contiene las funciones de gestión
   * #	de libros de la capa de acceso a datos
   * #==========================================================#
   */

function consultarTodasLineasVentas($conexion)
{
    $consulta = "SELECT * FROM LINEAVENTAS";
    return $conexion->query($consulta);
}

function precioTotalVenta($conexion, $IdVenta)
{

    try {
    $stmt = $conexion->prepare("SELECT SUM (PRECIOLV) FROM LINEAVENTAS WHERE VENTAS_ID = :VentasId");
        $stmt->bindParam(':VentasId', $IdVenta);
        $stmt->execute();

        return $stmt->fetchColumn();

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function consultarLineasDeVenta($conexion, $IdVenta)
{

    try {
        $stmt = $conexion->prepare("SELECT LINEAVENTAS.*, BONOS.NOMBREBONO FROM LINEAVENTAS INNER JOIN BONOS ON LINEAVENTAS.BONOS_ID = BONOS.BONOS_ID WHERE LINEAVENTAS.VENTAS_ID = :VentasId");
        $stmt->bindParam(':VentasId', $IdVenta);
        $stmt->execute();

        return $stmt;

    } catch (PDOException $e) {
        return $e->getMessage();
    }

}




