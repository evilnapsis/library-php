<?php
$go = true;
if(strtotime($_POST["start_at"])>strtotime($_POST["finish_at"])){
  $go=false;
}
if( $go && isset($_SESSION["cart"])){
	$cart = $_SESSION["cart"];
	if(count($cart)>0){
		foreach($cart as  $c){
			$op = new OperationData();
			 $op->item_id = $c["item_id"] ;
			 $op->client_id = $_POST["client_id"];
			 $op->start_at = $_POST["start_at"];
			 $op->finish_at = $_POST["finish_at"];
			 $op->user_id=$_SESSION["user_id"];
			 $op->add();

			$item = ItemData::getById($c["item_id"]);
			$item->unavaiable();
		}
    unset($_SESSION["cart"]);
	}
}
if($go){
  Core::alert("Prestamo procesado!");
  Core::redir("./?view=rents");
}else{
  Core::alert("Rango de fecha invalido!");
  Core::redir("./?view=rent");
}
?>
