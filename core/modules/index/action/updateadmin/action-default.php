<?php
// print_r($_SESSION);
if(count($_POST)>0){
$a = new SQLMan();
$a->tablename = "admin";


$a->update(array(
	"nombre"=>$a->is_string($_POST["nombre"]),
	"apellido"=>$a->is_string($_POST["apellido"]),
	"email"=>$a->is_string($_POST["email"]),
	"password"=>$a->is_string($_POST["password"])
	),"id=".$_POST["id"]);



Core::redir("./index.php?view=admins");
}

?>