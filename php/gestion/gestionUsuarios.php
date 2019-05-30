<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_usuario($conexion,$usuario) {
	$fechaNacimiento = date('d/M/Y', strtotime($usuario["fechaNacimiento"]));


	try {
		$consulta = "CALL NUEVO_USUARIO(:dni, :nombre, :pass, :email, :fechaNacimiento, :tipoPago)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':pass',$usuario["pass"]);
        $stmt->bindParam(':email',$usuario["email"]);
        $stmt->bindParam(':fechaNacimiento',$fechaNacimiento);
        $stmt->bindParam(':tipoPago',$usuario["pago"]);

        $stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		return $e->getMessage();
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}
 


  
function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE CORREO=:email AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function getNombreUsuario($conexion,$email,$pass) {
    $consulta = "SELECT NOMBRE FROM USUARIOS WHERE CORREO=:email AND PASS=:pass";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':pass',$pass);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getDNIUsuario($conexion,$email,$pass) {
    $consulta = "SELECT DNI FROM USUARIOS WHERE CORREO=:email AND PASS=:pass";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':pass',$pass);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function existeEmailEnBD ($conexion, $Email) {

    $consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE CORREO=:email";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':email',$Email);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;

}

