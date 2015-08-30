<?php
// print_r($_SESSION);
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "ejemplar";
// $a->in_test = true;
$a->codigo = $a->is_string($_POST["codigo"]);
$a->libro_id = $_POST["libro_id"];
$a->add();
Core::redir("./index.php?view=ejemplares&id=".$_POST["libro_id"]);
}

?>