<?php
// print_r($_SESSION);
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "editorial";
// $a->in_test = true;
$a->nombre = $a->is_string($_POST["nombre"]);
$a->add();
Core::redir("./index.php?view=editoriales");
}

?>