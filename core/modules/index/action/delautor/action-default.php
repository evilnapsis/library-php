<?php
// print_r($_SESSION);
if(count($_GET)>0){
$a = AutorData::getById($_GET["id"]);
$a->del();



Core::redir("./index.php?view=autores");
}

?>