<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
if(count($_POST)>0){



	$user = new ItemData();
	$user->code = $_POST["code"];
	$user->book_id = $_POST["book_id"];
	$user->status_id = $_POST["status_id"];
	$user->add();

	Core::alert("Ejemplar agregado!");
	Core::redir("./?view=items&id=".$_POST["book_id"]."&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
if(count($_POST)>0){

	$user = ItemData::getById($_POST["item_id"]);
	$user->code = $_POST["code"];
	$user->status_id = $_POST["status_id"];
	$user->update();

	Core::alert("Ejemplar actualizado!");
	Core::redir("./?view=items&id=".$user->book_id."&opt=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = ItemData::getById($_GET["item_id"]);
	$user->del();
	Core::alert("Ejemplar eliminado!");
	Core::redir("./?view=items&id=".$_GET["id"]."&opt=all");
}

?>
