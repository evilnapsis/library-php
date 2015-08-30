<?php
// print_r($_SESSION);
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "admin";
// $a->in_test = true;
$a->nombre = $a->is_string($_POST["nombre"]);
$a->apellido = $a->is_string($_POST["apellido"]);
$a->password = $a->is_string($_POST["password"]);
$a->email = $a->is_string($_POST["email"]);
$a->add();
Core::redir("./index.php?view=admins");
}

?>