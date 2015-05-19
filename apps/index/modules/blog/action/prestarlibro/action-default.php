<?php
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "prestamo";
// $a->in_test = true;
$a->usuario_id = $_POST["usuario_id"];
$a->ejemplar_id = $_POST["ejemplar_id"];
$a->prestador_id = $_SESSION["admin_id"];
$a->return_at = $a->is_string($_POST["return_at"]);
$a->created_at = "NOW()";
$a->add();


$e = new SQLMan();
//$e->in_test = true;
$e->tablename = "ejemplar";
$e->update(array(
	"status"=>1	),"id=".$_POST["ejemplar_id"]);

$e = new SQLMan();
$e->tablename = "ejemplar";
//$e->in_test=true;
$ejemplar= $e->select("one","",$where="id=".$_POST["ejemplar_id"]);
$ejemplar = $ejemplar[0];



Core::redir("./index.php?view=ejemplares&id=".$ejemplar->fields["libro_id"]);
}

?>