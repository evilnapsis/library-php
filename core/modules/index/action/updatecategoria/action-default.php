<?php
// print_r($_SESSION);
if(count($_POST)>0){

$e = CategoriaData::getById($_POST["id"]);
$e->nombre = $_POST["nombre"];
$e->update();



//Core::redir("./index.php?view=categorias");
}

?>