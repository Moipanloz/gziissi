<?php

session_start();

$TEST = $_SESSION ["TEST"];
unset ($_SESSION ["TEST"]);

foreach ($TEST as $t) {

    print " - ";
    print $t;

}