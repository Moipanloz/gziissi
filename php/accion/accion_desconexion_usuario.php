<?php

session_start();

    unset($_SESSION["login_name"]);
    unset($_SESSION["login_dni"]);


header("Location: ../index.php");