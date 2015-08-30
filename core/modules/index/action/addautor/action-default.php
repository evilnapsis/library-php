<?php
// print_r($_SESSION);
if(count($_POST)>0){
$a = new AutorData();
// $a->in_test = true;
$a->nombre = $_POST["nombre"];
$a->apellido = $_POST["apellido"];
$a->add();


Core::redir("./index.php?view=autores");
}

?>