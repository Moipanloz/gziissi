<!DOCTYPE html>
<html lang="es">
	<head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
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
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porta quam eget luctus sodales. Nunc ut lorem pharetra, egestas erat sit amet, eleifend lorem. Aenean sapien augue, scelerisque vel est finibus, vestibulum eleifend leo. Proin pellentesque sem est, vel venenatis leo consectetur nec. Morbi ornare vulputate eros, non malesuada sapien pharetra eu. Proin condimentum accumsan iaculis. Nunc eu molestie erat, in commodo mi. Nulla sed vulputate erat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras libero enim, ullamcorper id massa nec, suscipit tempor elit. Quisque nec elementum tellus, quis porta neque.</p>
                <br>
                <p>Aliquam eget gravida ligula. Integer cursus dignissim maximus. Cras placerat mauris urna, porttitor rhoncus purus convallis in. Aliquam egestas mauris lobortis sem suscipit interdum. Nunc molestie nibh ac dolor sodales viverra. Sed magna tellus, mattis sed tellus a, ultrices auctor est. Proin non nunc rutrum, placerat neque ut, facilisis nisi. Maecenas fermentum tempus posuere. Donec et dolor eros. Quisque non tortor lectus. Fusce pharetra leo nisl, eget ornare nisl porta ut. Nam feugiat arcu eu nunc posuere vehicula. Ut cursus, orci ac hendrerit scelerisque, mi ipsum scelerisque eros, nec lacinia tortor lectus sit amet ante. Integer nec elit faucibus, lobortis augue vel, sollicitudin est.</p>
                <br>
                <p>Phasellus bibendum tortor id tortor aliquet malesuada. In sed lectus a nunc volutpat blandit. Quisque vitae efficitur ligula, vel faucibus odio. Pellentesque sit amet lacus at magna vestibulum euismod. Sed egestas venenatis ligula, vel aliquam mi faucibus in. In elementum nulla et auctor tempus. Sed iaculis interdum ipsum. Maecenas vulputate ipsum sem, a sagittis nisi consequat nec.</p>
            </div>
        </div>
                <div class="carta">
				<h1 class="titulo">Nuestra carta</h1>
                <div class="wrapMenu">
                    <ul class="tabs">
                        <li><a id="menuButtons" data-filter=".group-1" href="#">Group 1</a></li>
                        <li><a id="menuButtons" data-filter=".group-2" href="#">Group 2</a></li>
                        <li><a id="menuButtons" data-filter=".group-3" href="#">Group 3</a></li>
                        <li><a id="menuButtons" data-filter=".group-4" href="#">Group 4</a></li>
                    </ul>

                    <ul class="portfolio">
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>
                        <li class="group-2">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>

                        <li class="group-1">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>

                        <li class="group-1">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>
                        <li class="group-2">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>
                        <li class="group-1">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>

                    </ul>
                    <ul class="portfolio">
                        <li class="group-3">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>
                        <li class="group-3">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>

                        <li class="group-4">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="placeholder" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>

                        <li class="group-4">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="Monster" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>
                        <li class="group-4">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="Cerveza" />
                                <h3 id="menuText">The Title</h3>
                            </figure>
                        </li>
                        <li class="group-4">
                            <figure>
                                <img src="imagenes/refrescos.jpg" alt="Refrescos" />
                                <h3>Refrescos</h3>
                            </figure>
                        </li>

                    </ul>
                </div>
                <script  src="js/carta.js"></script>
			<div class="galeria">
				<h1 class="titulo">Galería</h1>
                <div class="container">
                    <h1>As-slider</h1>
                    <section class="my-slider">
                        <ul>
                            <li>
                                <section class="slide_1">
                                    <div class="caption">
                                        <h2 style="text-align:center;">This is a very basic and simple slider</h2>
                                        <p>Most of the style is set in CSS and <strong>not</strong> in the JavaScript as most of the other sliders.</p>
                                    </div>
                                </section>
                            </li>
                            <li>
                                <section class="slide_2">
                                    <div class="caption">
                                        <h2>It contains</h2>
                                        <ul>
                                            <li>Slider area</li>
                                            <li>Navigation buttons</li>
                                            <li>Progress bar</li>
                                            <li>Markers</li>
                                        </ul>
                                        <p>Nothing more, nothing less...</p>
                                    </div>
                                </section>
                            </li>
                            <li>
                                <section class="slide_3">
                                    <div class="caption">
                                        <h2>It's...</h2>
                                        <ul>
                                            <li>Stabile</li>
                                            <li>Easy to customize</li>
                                            <li>Responsive</li>
                                            <li>Hardware accelerated</li>
                                        </ul>
                                    </div>
                                </section>
                            </li>
                        </ul>
                    </section>
                </div>
                <script  src="js/galeria.js"></script>
			<div class="localizanos">
				<h1 class="titulo">Localizanos</h1>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122470.29726937723!2d-115.24122266102181!3d36.232787363024805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80beb782a4f57dd1%3A0x3accd5e6d5b379a3!2sLas+Vegas%2C+NV%2C+USA!5e0!3m2!1sen!2sca!4v1470931103436" class="map" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                <script  src="js/mapa.js"></script>
                </div>
            </div>
	</body>
</html>
