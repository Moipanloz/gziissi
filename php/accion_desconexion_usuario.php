<?php

if (isset($_SESSION["USUARIO"]))
    unset($_SESSION["USUARIO"]);

header("Location: index.php");