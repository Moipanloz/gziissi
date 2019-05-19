<!DOCTYPE html>
<html lang="es">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gamers Zone</title>
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css.css">
        <link rel="icon" type="image/png"  href="imagenes/favicon-32x32.png">
	</head>
    <?php include_once ("cabecera.php") ?>
    <body>
        <div class="grid-container">
            <div class="info">
		            <h1 class="titulo">Sobre nosotros</h1>
			   		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                        in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			<div class="carta">
				<h1 class="titulo">Nuestra carta</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
				   labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
				   nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
				   esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
				   in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			<div class="galeria">
				<h1 class="titulo">Galería</h1>
				<div class="slider">
					<!--Cambiar imagen-->
					<input type="radio" name="imagenes" id="i1" checked>
					<input type="radio" name="imagenes" id="i2">
					<input type="radio" name="imagenes" id="i3">
					<input type="radio" name="imagenes" id="i4">					
					<input type="radio" name="imagenes" id="i5">					
					
					<!--Imagenes-->

					<div class="slider_item" id="uno">
						<img src="imagenes/GZ-Slider1.jpeg" alt="n1"/>
						<label for="i5" class="previous"></label>
						<label for="i2" class="next"></label>
					</div>
					<div class="slider_item" id="dos">
						<img src="imagenes/GZ-Slider2.png" alt="n2"/>
						<label for="i1" class="previous"></label>
						<label for="i3" class="next"></label>							
					</div>
					<div class="slider_item" id="tres">
						<img src="imagenes/GZ-Slider3.jpeg" alt="n3"/>
						<label for="i2" class="previous"></label>
						<label for="i4" class="next"></label>							
					</div>
					<div class="slider_item" id="cuatro">
						<img src="imagenes/GZ-Slider4.png" alt="n4"/>
						<label for="i3" class="previous"></label>
						<label for="i5" class="next"></label>							
					</div>
					<div class="slider_item" id="cinco">
						<img src="imagenes/GZ-Slider5.jpeg" alt="n5"/>
						<label for="i4" class="previous"></label>
						<label for="i1" class="next"></label>							
					</div>
					<!--Navegador de puntos-->
					<div class="dotnav">
						<label class="dots" id="dot1" for="i1"></label>
						<label class="dots" id="dot2" for="i2"></label>
						<label class="dots" id="dot3" for="i3"></label>	
						<label class="dots" id="dot4" for="i4"></label>
						<label class="dots" id="dot5" for="i5"></label>																											
					</div>
				</div>
			</div>
			<div class="localizanos">
				<h1 class="titulo">Localizanos</h1>
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="900" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=gamers%20zone&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                    <style>.mapouter{margin:auto;position:relative;text-align:right;height:400px;width:900px;}.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:900px;}</style>
                </div>
			</div>
		</div>
	</body>
</html>
