<?php
//print_r($_SESSION);
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "libro";


// $a->in_test = true;
$a->update(array(
	"isbn"=>$a->is_string($_POST["isbn"]),
	"titulo"=>$a->is_string($_POST["titulo"]),
	"subtitulo"=>$a->is_string($_POST["subtitulo"]),
	"anio"=>$a->is_string($_POST["anio"]),
	"num_pag"=>$a->is_string($_POST["num_pag"]),
	"autor_id"=>$a->is_string($_POST["autor_id"]),
	"editorial_id"=>$a->is_string($_POST["editorial_id"]),
	"categoria_id"=>$a->is_string($_POST["categoria_id"])


	),"id=".$_POST["id"]);



Core::redir("./index.php?view=libros");
}

?>