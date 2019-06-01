<?php

session_start();

$TEST = $_SESSION ["TEST"];
unset ($_SESSION ["TEST"]);

print ".".$TEST.".";
