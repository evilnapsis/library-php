<?php
/**
* @author evilnapsis
* @brief Eliminar autores 
**/
$category = AuthorData::getById($_GET["id"]);
$category->del();
Core::redir("./index.php?view=authors");


?>