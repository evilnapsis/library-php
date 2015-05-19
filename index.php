<?php
// el archivo autoload inicializa todos lo archivos necesarios para que el framework funcione
include "lib/legobox/autoload.php";


// cargamos el modulo iniciar.
$lb = new Lb("index");
$lb->environment = "develop";
$lb->display_errors = false;
$lb->loadModule("blog");

?>