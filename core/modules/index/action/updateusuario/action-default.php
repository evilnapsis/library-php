<?php
// print_r($_SESSION);
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "usuario";


// $a->in_test = true;
$a->nombre = $a->is_string($_POST["nombre"]);
$a->apellido = $a->is_string($_POST["apellido"]);
$a->update(array(
	"nombre"=>$a->is_string($_POST["nombre"]),
	"apellido"=>$a->is_string($_POST["apellido"]),
	"direccion"=>$a->is_string($_POST["direccion"]),
	"email"=>$a->is_string($_POST["email"]),
	"telefono"=>$a->is_string($_POST["telefono"])
	),"id=".$_POST["id"]);



Core::redir("./index.php?view=usuarios");
}

?>