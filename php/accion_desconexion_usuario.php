<?php

session_start();

//TODO Desconectar al usuario, es decir, borrarle de $_SESSION

if (isset($_SESSION ["DISCONNECT_ATTEMPT"])) {

unset($_SESSION ["USUARIO"]);
unset ($_SESSION ["DISCONNECT_ATTEMPT"]);
}

header("index.php");