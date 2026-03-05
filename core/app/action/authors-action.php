<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
if(count($_POST)>0){



	$user = new AuthorData();

	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];

	$user->add();
	Core::alert("Autor agregado!");
	Core::redir("./?view=authors&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
if(count($_POST)>0){

	$user = AuthorData::getById($_POST["_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];

	$user->update();

	Core::alert("Autor actualizado!");
	Core::redir("./?view=authors&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = AuthorData::getById($_GET["id"]);
	$user->del();
	Core::alert("Autor eliminado!");
	Core::redir("./?view=authors&opt=all");
}



?>
