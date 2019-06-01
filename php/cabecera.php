<header>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="header.css">
    <a href="index.php"><img src="imagenes/GZ-logo.png" alt="Logo" class="img-logo"></a>
    <ul id="bigScreen">
        <?php
        session_start();
        if (isset($_SESSION ["login_dni"]) && $_SESSION ["login_dni"] == "00000000A") { ?>
            <li><a href="administracion.php">Administración</a></li>
        <?php } ?>
        <li><a href="bonos.php">Bonos</a></li>
        <li><a href="torneos.php">Torneos</a></li>
        <?php
        if (!isset($_SESSION ["login_name"])) {
            ?>
            <li><a href="iniciaSesion.php">Inicia sesión</a></li>
            <li><a href="registrate.php">Regístrate</a></li>
        <?php } else { ?>
            <li><a href="accion/accion_desconexion_usuario.php">Desconectarse</a></li>
        <?php } ?>
    </ul>

    <<ul id="smallScreen">
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Dropdown</a>
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
    </ul>
</header>