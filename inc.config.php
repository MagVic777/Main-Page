<?php
if(!HOMEPLANTS) die("You do not have access to this file.");

// Default settings
$numofday = 3;
$maxnumofday = 7;

// Modified for the live demo.
$numofday = 1;
$maxnumofday = 2;

$islocked = array();
$islocked["lock"] = false;
$islocked["remove"] = false;
$islocked["edit"] = false;
$islocked["add"] = false;
$islocked["update"] = false; 
$islocked["pwd"] = "Test";
?>