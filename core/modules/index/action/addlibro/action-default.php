<?php
// print_r($_SESSION);
if(count($_POST)>0){
	$a = new SQLMan();
$a->tablename = "libro";
// $a->in_test = true;
$a->isbn = $a->is_string($_POST["isbn"]);
$a->titulo = $a->is_string($_POST["titulo"]);
$a->subtitulo = $a->is_string($_POST["subtitulo"]);


$a->anio = $a->is_string($_POST["anio"]);
$a->num_pag = $a->is_string($_POST["num_pag"]);

$a->editorial_id = $a->is_string($_POST["editorial_id"]);
$a->autor_id = $a->is_string($_POST["autor_id"]);
$a->categoria_id = $a->is_string($_POST["categoria_id"]);

$a->add();
Core::redir("./index.php?view=libros");
}

?>