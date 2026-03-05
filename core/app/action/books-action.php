<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
if(count($_POST)>0){



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

	Core::alert("Libro agregado!");
	Core::redir("./?view=books&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
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

	Core::alert("Libro actualizado!");
	Core::redir("./?view=books&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = BookData::getById($_GET["id"]);
	$user->del();
	Core::alert("Libro eliminado!");
	Core::redir("./?view=books&opt=all");
}

?>
