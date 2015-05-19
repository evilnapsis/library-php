<?php
// print_r($_SESSION);
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "autor";
// $a->in_test = true;
$a->nombre = $a->is_string($_POST["nombre"]);
$a->apellido = $a->is_string($_POST["apellido"]);
$a->add();
Core::redir("./index.php?view=autores");
}

?>