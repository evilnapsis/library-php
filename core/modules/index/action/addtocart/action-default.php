<?php
/**
* @author evilnapsis
**/
if(!isset($_SESSION["cart"])){


	$product = array("book_id"=>$_POST["book_id"],"item_id"=>$_POST["item_id"]);
	$_SESSION["cart"] = array($product);


	$cart = $_SESSION["cart"];



}else {

$found = false;
$cart = $_SESSION["cart"];
$index=0;






$can = true;
?>

<?php
if($can==true){
foreach($cart as $c){
	if($c["book_id"]==$_POST["book_id"]){
		echo "found";
		$found=true;
		break;
	}
	$index++;
//	print_r($c);
//	print "<br>";
}

if($found==false){
    $nc = count($cart);
	$product = array("book_id"=>$_POST["book_id"],"item_id"=>$_POST["item_id"]);
	$cart[$nc] = $product;
//	print_r($cart);
	$_SESSION["cart"] = $cart;
}else{
 print "<script>alert('El ejemplar ya esta agregado en la lista!');</script>";

}

}
}
 print "<script>window.location='index.php?view=rent';</script>";
// unset($_SESSION["cart"]);

?>