<?php

if($_SESSION["user_id"]!=""){
$operation = OperationData::getById($_GET["id"]);
$item = ItemData::getById($operation->item_id);
$item->avaiable();
$operation->finalize();
Core::redir("./?view=rents");

}

?>