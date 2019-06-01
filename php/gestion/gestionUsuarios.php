<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

function consultarTodosUsuarios($conexion) {
    $consulta = "SELECT * FROM USUARIOS";
    return $conexion->query($consulta);
}

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


		
		return $stmt->execute();;
	} catch(PDOException $e) {
		return $e->getMessage();
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }
}

function darseDeAlta ($conexion, $dni) {

    try {
        $consulta = "CALL DARSE_ALTA(:dni)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':dni',$dni);
        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
        // Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }

}

function darseDeBaja ($conexion, $dni) {

    try {
        $consulta = "CALL DARSE_BAJA(:dni)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':dni',$dni);

        $stmt->execute();
        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
        // Si queremos visualizar la excepción durante la depuración: $e->getMessage();
    }

}
  
function consultarUsuario($conexion,$email,$pass) {
    /*
 	$consulta = "SELECT PASS FROM USUARIOS WHERE CORREO=:email AND PASS=:pass AND ACTIVO = 'TRUE'";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
    $hash = $stmt->fetchColumn();
	return password_verify ($pass, $hash);
    */

    $stmt = $conexion->prepare("SELECT PASS FROM USUARIOS WHERE CORREO=:email AND ACTIVO = 'TRUE'");
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    $userPass = $stmt->fetchColumn();

    if (password_verify($pass, $userPass))
    {
        return true;
    } else {
        return false;
    }

}

function getNombreUsuario($conexion,$email) {
    $consulta = "SELECT NOMBRE FROM USUARIOS WHERE CORREO=:email";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getDNIUsuario($conexion,$email) {
    $consulta = "SELECT DNI FROM USUARIOS WHERE CORREO=:email";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function existeDNIEnBD ($conexion, $DNI) {

    $consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE DNI=:dni";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':dni',$DNI);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;

}

function existeEmailEnBD ($conexion, $Email) {

    $consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE CORREO=:email";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':email',$Email);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;

}

function esActivo($conexion, $dni){
    $consulta = "SELECT ACTIVO FROM USUARIOS WHERE DNI=:dni";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':dni',$dni);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function borrarUsuario($conexion,$dni) {
    try {
        $stmt=$conexion->prepare("DELETE FROM USUARIOS WHERE DNI = :dni");
        $stmt->bindParam(':dni',$dni);
        $stmt->execute();

        return "";
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}

