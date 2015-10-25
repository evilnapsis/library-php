<?php

if(count($_POST)>0){
	$user = new ItemData();
	$user->code = $_POST["code"];
	$user->book_id = $_POST["book_id"];
	$user->status_id = $_POST["status_id"];
	$user->add();

print "<script>window.location='index.php?view=items&id=$_POST[book_id]';</script>";


}


?>