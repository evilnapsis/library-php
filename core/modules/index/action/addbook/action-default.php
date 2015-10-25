<?php

if(!empty($_POST)){
$r = new BookData();
$r->title = $_POST["title"];
$r->subtitle = $_POST["subtitle"];
$r->description = $_POST["description"];
$r->isbn = $_POST["isbn"];
$r->n_pag = $_POST["n_pag"];
$r->year = $_POST["year"];
$r->category_id = $_POST["category_id"]!="" ? $_POST["category_id"] : "NULL";
$r->editorial_id = $_POST["editorial_id"]!="" ? $_POST["editorial_id"] : "NULL";
$r->author_id = $_POST["author_id"]!="" ? $_POST["author_id"] : "NULL";
$r->add();
}
//Core::alert("Agregado exitosamente!");
Core::redir("./index.php?view=books");
?>