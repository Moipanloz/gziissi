<!DOCTYPE html>
<html lang="es">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gamers Zone</title>
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css.css">
        <link rel="icon" type="image/png"  href="imagenes/favicon-32x32.png">
        <script language="JavaScript" src="js/slider.js"></script>
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
                <div class="div_centrado">
                    <input type="radio" name="itemsCarta" id="i1" checked>
                    <input type="radio" name="itemsCarta" id="i2">
                    <input type="radio" name="itemsCarta" id="i3">
                    <input type="radio" name="itemsCarta" id="i4">
                    <div class="botones_carta">
                        <label class="botones" id="b1" for="i1" >Bebidas</label>
                        <label class="botones" id="b2" for="i2" >Hamburguesas</label>
                        <label class="botones" id="b3" for="i3" >Sandwiches</label>
                        <label class="botones" id="b4" for="i4" >Postres</label>
                    </div>
                    <div class="carta_item" id="bebidas">
                        <img src="imagenes/GZ-Slider1.jpeg">
                    </div>
                    <div class="carta_item" id="hamburguesas">
                        <img src="imagenes/GZ-Slider2.PNG">
                    </div>
                    <div class="carta_item" id="sandwiches">
                        <img src="imagenes/GZ-Slider3.jpeg">
                    </div>
                    <div class="carta_item" id="postres">
                        <img src="imagenes/GZ-Slider4.PNG">
                    </div>
                </div>
			</div>
			<div class="galeria">
				<h1 class="titulo">Galería</h1>
                <div id="slider">
                    <a class="control_next">></a>
                    <a   class="control_prev"><</a>
                    <ul>
                        <li>SLIDE 1</li>
                        <li>SLIDE 2</li>
                        <li>SLIDE 3</li>
                        <li>SLIDE 4</li>
                    </ul>
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
