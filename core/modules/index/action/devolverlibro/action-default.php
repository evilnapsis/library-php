<?php

$p = new SQLMan();
$p->tablename = "prestamo";
//$p->in_test=true;
$prestamo= $p->select("one","",$where="id=".$_GET["prestamo_id"]);
$prestamo = $prestamo[0];


$a = new SQLMan();
$a->tablename = "prestamo";
$a->update(array(
	"returned_at"=>"NOW()",
	"receptor_id"=>$_SESSION["admin_id"]
	),"id=".$_GET["prestamo_id"]);

$a = new SQLMan();
$a->tablename = "ejemplar";
$a->update(array(
	"status"=>0
	),"id=".$prestamo->fields["ejemplar_id"]);

Core::redir("./index.php?view=prestamos");


?>


