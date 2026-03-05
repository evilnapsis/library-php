<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
if(count($_POST)>0){



	$user = new EditorialData();

	$user->name = $_POST["name"];

	$user->add();
	Core::alert("Editorial agregada!");
	Core::redir("./?view=editorials&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
if(count($_POST)>0){

	$user = EditorialData::getById($_POST["_id"]);
	$user->name = $_POST["name"];

	$user->update();

	Core::alert("Editorial actualizada!");
	Core::redir("./?view=editorials&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = EditorialData::getById($_GET["id"]);
	$user->del();
	Core::alert("Editorial eliminada!");
	Core::redir("./?view=editorials&opt=all");
}



?>
