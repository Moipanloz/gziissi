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


?>



