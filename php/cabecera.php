

<header>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div>
		<a href="index.php"><img src="imagenes/GZ-logo.png" alt="Logo" class="logo"></a>
		<nav>
			<ul>



                <?php

                session_start();



                //if (isset($_SESSION ["ADMIN"])) { ?>


                <li class="ul-item"><a href="administracion.php">Administración</a></li>

                <?php //} ?>



				<li class="ul-item"><a href="bonos.php">Bonos</a></li>
				<li class="ul-item"><a href="torneos.php">Torneos</a></li>

                <?php

                if (!isset($_SESSION ["login_name"])) {

                    ?>

				<li class="ul-item"><a href="iniciaSesion.php">Inicia sesión</a></li>
				<li class="ul-item"><a href="registrate.php">Regístrate</a> </li>

                <?php } else { ?>

                <li class="ul-item"><a href="accion/accion_desconexion_usuario.php">Desconectarse</a> </li>

                <?php } ?>

            </ul>
		</nav>
</div>
</header>