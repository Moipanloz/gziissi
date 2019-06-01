<!DOCTYPE html>
<html lang="es">
	<head>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gamers Zone</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="icon" type="image/png"  href="imagenes/favicon-32x32.png">
        <script language="JavaScript" src="js/slider.js"></script>
	</head>
    <?php include_once ("cabecera.php") ?>
    <body>
        <div class="grid-container">
            <div class="info">
		            <h1 class="titulo">Sobre nosotros</h1>
                <p>Gamers Zone es un bar gamer de comida casera de reciente apertura situado en la calle Monzón
                    paralela a Reina Mercedes. </p>
                <br>
                <p>Contamos con una zona dedicada a la restauración, donde los clientes pueden consumir comida
                    y bebida, e incluso jugar a los juegos de mesa de los que disponemos el establecimiento; un par
                    de zonas reservadas para el uso de videoconsolas y por último, una zona dedicada exclusivamente
                    para el uso de equipos de alto rendimiento, donde se pueden jugar a videojuegos de pc tanto
                    solo como con tus amigos.</p>
            </div>
        </div>
                <div class="carta">
				<h1 class="titulo">Nuestra carta</h1>
                <div class="wrapMenu">
                    <ul class="tabs">
                        <li><a id="menuButtons" data-filter=".group-1" href="#">Entrantes</a></li>
                        <li><a id="menuButtons" data-filter=".group-2" href="#">Ensaladas</a></li>
                        <li><a id="menuButtons" data-filter=".group-3" href="#">Hamburguesas</a></li>
                        <li><a id="menuButtons" data-filter=".group-4" href="#">Hot-Dogs</a></li>
                        <li><a id="menuButtons" data-filter=".group-5" href="#">Sandwiches</a></li>
                    </ul>

                    <ul class="portfolio">
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/e1.PNG" alt="placeholder" />
                                <h3 id="menuText">Alitas de Anivia</h3>
                            </figure>
                        </li>
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/e2.PNG" alt="placeholder" />
                                <h3 id="menuText">Lagrimitas de Amumu</h3>
                            </figure>
                        </li>
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/e3.PNG" alt="placeholder" />
                                <h3 id="menuText">Filo Infinito</h3>
                            </figure>
                        </li>
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/e4.PNG" alt="placeholder" />
                                <h3 id="menuText">Aperitivos de URF</h3>
                            </figure>
                        </li>
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/e5.PNG" alt="placeholder" />
                                <h3 id="menuText">Magma del monte del destino</h3>
                            </figure>
                        </li>
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/e6.PNG" alt="placeholder" />
                                <h3 id="menuText">Trifuerza</h3>
                            </figure>
                        </li>
                    </ul>
                    <ul class="portfolio">
                        <li class="group-2">
                            <figure>
                                <img src="imagenes/es1.PNG" alt="placeholder" />
                                <h3 id="menuText">Ensalada de Bowser</h3>
                            </figure>
                        </li>

                        <li class="group-2">
                            <figure>
                                <img src="imagenes/es2.PNG" alt="placeholder" />
                                <h3 id="menuText">Ensalada D.VA</h3>
                            </figure>
                        </li>

                        <li class="group-2">
                            <figure>
                                <img src="imagenes/es3.PNG" alt="Monster" />
                                <h3 id="menuText">Ensalada de Hyrule</h3>
                            </figure>
                        </li>
                    </ul>
                    <ul class="portfolio">
                        <li class="group-4">
                            <figure>
                                <img src="imagenes/hd1.PNG" alt="placeholder" />
                                <h3 id="menuText">Goomba</h3>
                            </figure>
                        </li>
                        <li class="group-4">
                            <figure>
                                <img src="imagenes/hd2.PNG" alt="placeholder" />
                                <h3 id="menuText">Lakitu</h3>
                            </figure>
                        </li>

                        <li class="group-4">
                            <figure>
                                <img src="imagenes/hd3.PNG" alt="placeholder" />
                                <h3 id="menuText">Capitan Toad</h3>
                            </figure>
                        </li>
                    </ul>
                    <ul class="portfolio">
                        <li class="group-3">
                            <figure>
                                <img src="imagenes/h1.PNG" alt="placeholder" />
                                <h3 id="menuText">Chocobo</h3>
                            </figure>
                        </li>
                        <li class="group-3">
                            <figure>
                                <img src="imagenes/h2.PNG" alt="placeholder" />
                                <h3 id="menuText">Rathalos</h3>
                            </figure>
                        </li>

                        <li class="group-3">
                            <figure>
                                <img src="imagenes/h3.PNG" alt="placeholder" />
                                <h3 id="menuText">Rathian</h3>
                            </figure>
                        </li>

                        <li class="group-3">
                            <figure>
                                <img src="imagenes/h4.PNG" alt="placeholder" />
                                <h3 id="menuText">Headshot</h3>
                            </figure>
                        </li>
                        <li class="group-3">
                            <figure>
                                <img src="imagenes/h5.PNG" alt="placeholder" />
                                <h3 id="menuText">Kog'Maw</h3>
                            </figure>
                        </li>
                        <li class="group-3">
                            <figure>
                                <img src="imagenes/h6.PNG" alt="placeholder" />
                                <h3 id="menuText">Pentakill</h3>
                            </figure>
                        </li>
                    </ul>
                    <ul class="portfolio">
                        <li class="group-5">
                            <figure>
                                <img src="imagenes/s1.PNG" alt="placeholder" />
                                <h3 id="menuText">Murky</h3>
                            </figure>
                        </li>
                        <li class="group-5">
                            <figure>
                                <img src="imagenes/s2.PNG" alt="placeholder" />
                                <h3 id="menuText">Gul'Dan</h3>
                            </figure>
                        </li>
                        <li class="group-5">
                            <figure>
                                <img src="imagenes/s3.PNG" alt="placeholder" />
                                <h3 id="menuText">Tracer</h3>
                            </figure>
                        </li>
                    </ul>
                </div>
                <script  src="js/carta.js"></script>
			<div class="galeria">
				<h1 class="titulo">Galería</h1>
                <div class="container">
                    <section class="my-slider">
                        <ul>
                            <li>
                                <section class="slide_1">
                                    <div class="caption">
                                        <h2 style="text-align:center;">Equipos de alto rendimiento</h2>
                                        <p>Para que juguéis en equipo como verdaderos profesionales.</p>
                                    </div>
                                </section>
                            </li>
                            <li>
                                <section class="slide_2">
                                    <div class="caption">
                                        <h2>Videoconsolas</h2>
                                        <ul>
                                            <li>WiiU</li>
                                            <li>Nintendo Switch</li>
                                            <li>PS4</li>
                                            <li>GameCube</li>
                                        </ul>
                                    </div>
                                </section>
                            </li>
                            <li>
                                <section class="slide_3">
                                    <div class="caption">
                                        <h2>El local</h2>
                                        <p>Amplio salón para que tú y tus amigos juguéis, veais streamings y paséis un buen rato.</p>
                                    </div>
                                </section>
                            </li>
                        </ul>
                    </section>
                </div>
                <script  src="js/galeria.js"></script>
			<div class="localizanos">
				<h1 class="titulo">Localizanos</h1>
                <iframe src="https://maps.google.com/maps?q=gamers%20zone&t=&z=15&ie=UTF8&iwloc=&output=embed" class="map" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                <script  src="js/mapa.js"></script>
                </div>
            </div>
	</body>
</html>