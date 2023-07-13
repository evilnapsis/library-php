<?php
/**
* Library Lite v2.0
* @author evilnapsis
* @brief Libera la bestia ...
**/

$debug = true;
if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}

session_start();
include "core/autoload.php";

$lb = new Lb();
$lb->loadModule("index");


?>