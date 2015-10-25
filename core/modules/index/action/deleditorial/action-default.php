<?php
/**
* @author evilnapsis
* @brief Eliminar editoriales 
**/
$category = EditorialData::getById($_GET["id"]);
$category->del();
Core::redir("./index.php?view=editorials");

?>