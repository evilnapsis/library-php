<?php
$go = true;
if(strtotime($_POST["start_at"])>strtotime($_POST["finish_at"])){
$go=false;
}
if( $go && isset($_SESSION["cart"])){
	$cart = $_SESSION["cart"];
	if(count($cart)>0){
/*			$sell = new SellData();
			$sell->user_id = $_SESSION["user_id"];
			$sell->total = $_POST["total"];
			$sell->discount = $_POST["discount"];
			$s = $sell->add();
*/

		foreach($cart as  $c){


			$op = new OperationData();
			 $op->item_id = $c["item_id"] ;
			 $op->client_id = $_POST["client_id"];
			 $op->start_at = $_POST["start_at"];
			 $op->finish_at = $_POST["finish_at"];
			 $op->user_id=$_SESSION["user_id"];
			$add = $op->add();

			$item = ItemData::getById($c["item_id"]);
			$item->unavaiable();

			unset($_SESSION["cart"]);
			setcookie("selled","selled");
		}
////////////////////
		}
	}
if($go){
print "<script>window.location='index.php?view=rents';</script>";
}else{
print "<script>alert('Rango de fecha invalido!');</script>";
print "<script>window.location='index.php?view=rent';</script>";
}



?>
