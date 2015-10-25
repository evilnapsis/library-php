<?php

if(count($_POST)>0){
$r = BookData::getById($_POST["id"]);
$r->title = $_POST["title"];
$r->subtitle = $_POST["subtitle"];
$r->description = $_POST["description"];
$r->isbn = $_POST["isbn"];
$r->n_pag = $_POST["n_pag"];
$r->year = $_POST["year"];
$r->category_id = $_POST["category_id"]!="" ? $_POST["category_id"] : "NULL";
$r->editorial_id = $_POST["editorial_id"]!="" ? $_POST["editorial_id"] : "NULL";
$r->author_id = $_POST["author_id"]!="" ? $_POST["author_id"] : "NULL";
$r->update();


Core::alert("Actualizado exitosamente!");
print "<script>window.location='./index.php?view=books';</script>";

}


?>