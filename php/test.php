<?php

session_start();


$Contras [] = "PassDeIvan1";
$Contras [] = "PassDeMoises1";
$Contras [] = "PassDeCote1";
$Contras [] = "Pavussss1";
$Contras [] = "Archerrrr1";
$Contras [] = "PassDeBaja1";

foreach ($Contras as $s) {
    print ("Hash de la contra ".$s.": " . password_hash($s, PASSWORD_BCRYPT));
    print ("\n\n\n");

}
