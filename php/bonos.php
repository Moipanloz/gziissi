<?php session_start();

require_once ("gestionBD.php");
require_once ("gestionBonos.php");

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Gamers Zone</title>
		<!--<link href="FUENTE" rel="font"> REVISAR FUENTE-->
		<link rel="stylesheet" type="text/css" href="css.css">
		<link rel="icon" type="image/x-icon" href="faviconURL">
	</head>
	<body>
		<header>
			<div>
				<a href="index.html"><img src="imagenes/GZ-logo.png" alt="Logo" class="logo"></a>
				<nav>
					<ul>
						<li class="ul-item"><a href="bonos.php">Bonos</a></li>
						<li class="ul-item"><a href="torneos.php">Torneos</a></li>
						<li class="ul-item"><a href="iniciaSesion.php">Inicia sesión</a></li>
						<li class="ul-item"><a href="registrate.php">Regístrate</a> </li>
					</ul>				
				</nav>
			</div>
		</header>

		<div class="grid-container-bonos">

			<?php  foreach (consultarTodosBonos() as $b ) { ?> 

				<div class="subgrid" id="c1">
					<img src="imagenes\Telegram.png">
					<div id="left">
						<h3><?php print ($b) ?></h3>
						<ul>
							<li>Papas fritas</li>
							<li>2 cocacolas</li>
						</ul>
					</div>
					<form>
						<input type="submit" value="Adquirir">
					</form>
				</div>

			<?php } ?>

		</div>
	</body>
</html>
