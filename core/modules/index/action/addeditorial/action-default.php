<?php
// print_r($_SESSION);
if(count($_POST)>0){
$a = new EditorialData();
$a->nombre = $_POST["nombre"];
$a->add();
Core::redir("./index.php?view=editoriales");
}

?>