

<header>
	<div>
		<a href="index.php"><img src="imagenes/GZ-logo.png" alt="Logo" class="logo"></a>
		<nav>
			<ul>
				<li class="ul-item"><a href="bonos.php">Bonos</a></li>
				<li class="ul-item"><a href="torneos.php">Torneos</a></li>

                <?php
                session_start();

                if (!isset($_SESSION ["USUARIO"])) {

                    ?>

				<li class="ul-item"><a href="iniciaSesion.php">Inicia sesión</a></li>
				<li class="ul-item"><a href="registrate.php">Regístrate</a> </li>

                <?php } else { ?>

                <li class="ul-item"><a href="accion_desconexion_usuario.php">Desconectarse</a> </li>

                <?php } ?>

            </ul>
		</nav>
</div>
</header>