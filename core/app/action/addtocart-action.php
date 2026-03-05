<?php

if(!isset($_SESSION["cart"])){
	$product = array("book_id"=>$_POST["book_id"],"item_id"=>$_POST["item_id"]);
	$_SESSION["cart"] = array($product);
}else {
  $found = false;
  $cart = $_SESSION["cart"];
  foreach($cart as $c){
  	if($c["item_id"]==$_POST["item_id"]){
  		$found=true;
  		break;
  	}
  }

  if($found==false){
    $product = array("book_id"=>$_POST["book_id"],"item_id"=>$_POST["item_id"]);
    $cart[] = $product;
    $_SESSION["cart"] = $cart;
  }else{
    Core::alert("El ejemplar ya esta agregado en la lista!");
  }
}
Core::redir("./?view=rent");
?>
