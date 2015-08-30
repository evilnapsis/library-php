<?php
// print_r($_SESSION);
if(count($_POST)>0){

$autor = AutorData::getById($_POST["id"]);
$autor->nombre = $_POST["nombre"];
$autor->apellido = $_POST["apellido"];
$autor->update();



Core::redir("./index.php?view=autores");
}

?>