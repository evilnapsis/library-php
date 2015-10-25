<?php

if(count($_POST)>0){
	$user = new AuthorData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->add();

print "<script>window.location='index.php?view=authors';</script>";


}


?>