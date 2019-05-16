<?php
	session_start();

	require_once("gestion/gestionBD.php");
	require_once("gestion/gestionUsuarios.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_usuario.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>GamersZone: Alta de Usuario realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<?php if (alta_usuario($conexion, $nuevoUsuario)) { 
				$_SESSION['login'] = $nuevoUsuario['email'];
		?>
				<h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="index.html">aquí</a> para acceder a la página principal.
				</div>
		<?php } else { ?>
				<h1>El usuario ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="form_alta_usuario.php">aquí</a> para volver al formulario.
				</div>
		<?php } ?>

	</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

