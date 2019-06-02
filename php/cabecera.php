<header>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="header.css">
    <a href="index.php"><img src="imagenes/GZ-logo.png" alt="Logo" class="img-logo"></a>
    <ul id="bigScreen">
        <?php
        session_start();
        if (isset($_SESSION ["login_dni"]) && $_SESSION ["login_dni"] == "00000000A") { ?>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Administración</a>
                <div class="dropdown-content">
                    <a href="torneos_admin.php">Torneos</a>
                    <a href="pases_admin.php">Pases</a>
                    <a href="consumibles_admin.php">Consumibles</a>
                    <a href="usuarios_admin.php">Usuarios</a>
                    <a href="ventas_admin.php">Ventas</a>
                    <a href="almacenes_admin.php">Almacenes de Usuarios</a>
                </div>
        <?php }
        if (!isset($_SESSION ["login_name"])) {
            ?>
            <li><a href="registrate.php">Regístrate</a></li>
            <li><a href="iniciaSesion.php">Inicia sesión</a></li>
        <?php } else { ?>
            <li><a href="accion/accion_desconexion_usuario.php">Desconectarse</a></li>
        <?php } ?>
        <li><a href="torneos.php">Torneos</a></li>
        <li><a href="bonos.php">Bonos</a></li>
    </ul>

    <ul id="smallScreen">
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Menu</a>
            <div class="dropdown-content">
                <a href="bonos.php">Bonos</a>
                <a href="torneos.php">Torneos</a>
                <?php
                if (!isset($_SESSION ["login_name"])) {
                    ?>
                    <a href="iniciaSesion.php">Inicia sesión</a>
                    <a href="registrate.php">Regístrate</a>
                <?php } else { ?>
                    <a href="accion/accion_desconexion_usuario.php">Desconectarse</a>
                <?php } ?>
            </div>
    </ul>
</header>


