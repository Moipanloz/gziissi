
<!DOCTYPE html>
<html lang="es">
	<head>
<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Gamers Zone</title>
		<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css.css">
        <link rel="icon" type="image/png"  href="imagenes/favicon-32x32.png">
	</head>

	<!--
		<?php include_once ("cabecera.php");

		if (!isset($_SESSION ["ADMIN"]))

            Header("Location: index.php");


		?>

-->

	<body>

		<div>
			<h2 class="titulo">Administración</h2>
			<div class="grid-container-administracion">
				<div id="bonos-div">
					<h2>Bonos</h2>
					<!--FOR EACH BONO-->
						<!-- CUANDO ESTE EDITANDO -->
					<h3><input type="text" name="BONO" value="" id="BONO"/></h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!-- CUANDO SE MUESTRE -->
					<h3>NombreBono</h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!---->
					<!---->
					<div class="botones_administracion">
						<!-- SI ESTA EDITANDO -->
						<input id="guardar" name="guardar" type="submit" value="Guardar" class="boton_administracion">
						<!-- SI NO -->
						<input id="editar" name="editar" type="submit" value="Editar" class="boton_administracion">
						<!---->
						<input id="borrar" name="borrar" type="submit" value="Borrar" class="boton_administracion">
					</div>
				</div>
				<div id="pases-div">
					<h2>Pases</h2>
					<!--FOR EACH PASE-->
						<!-- CUANDO ESTE EDITANDO -->
					<h3><input type="text" name="PASE" value="" id="PASE"/></h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!-- CUANDO SE MUESTRE -->
					<h3>NombrePase</h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!---->
					<!---->
					<div class="botones_administracion">
						<!-- SI ESTA EDITANDO -->
						<input id="guardar" name="guardar" type="submit" value="Guardar" class="boton_administracion">
						<!-- SI NO -->
						<input id="editar" name="editar" type="submit" value="Editar" class="boton_administracion">
						<!---->
						<input id="borrar" name="borrar" type="submit" value="Borrar" class="boton_administracion">
					</div>
				</div>
				<div id="torneos-div">
					<h2>Torneos</h2>
					<!--FOR EACH TORNEO-->
						<!-- CUANDO ESTE EDITANDO -->
					<h3><input type="text" name="TORNEO" value="" id="TORNEO"/></h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!-- CUANDO SE MUESTRE -->
					<h3>NombreTorneo</h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!---->
					<!---->
					<div class="botones_administracion">
						<!-- SI ESTA EDITANDO -->
						<input id="guardar" name="guardar" type="submit" value="Guardar" class="boton_administracion">
						<!-- SI NO -->
						<input id="editar" name="editar" type="submit" value="Editar" class="boton_administracion">
						<!---->
						<input id="borrar" name="borrar" type="submit" value="Borrar" class="boton_administracion">
					</div>
				</div>
				<div id="consumibles-div">
					<h2>Consumibles</h2>
					<!--FOR EACH CONUSMIBLE-->
					<span>
						<!-- CUANDO ESTE EDITANDO -->
					<h3><input type="text" name="CONUSMIBLE" value="" id="CONUSMIBLE"/></h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!-- CUANDO SE MUESTRE -->
					<h3>NombreConsumible</h3>
					<ul>
							<!-- FOR EACH ELEMENTO -->
						<li>Elemento</li>
							<!---->
					</ul>
						<!---->
					<!---->
					<div class="botones_administracion">
						<!-- SI ESTA EDITANDO -->
						<input id="guardar" name="guardar" type="submit" value="Guardar" class="boton_administracion">
						<!-- SI NO -->
						<input id="editar" name="editar" type="submit" value="Editar" class="boton_administracion">
						<!---->
						<input id="borrar" name="borrar" type="submit" value="Borrar" class="boton_administracion">
					</div>
					</span>
				</div>
			</div>
		</div>
	</body>
</html>
