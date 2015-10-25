<?php

$client = ClientData::getById($_GET["id"]);
$client->del();
Core::redir("./index.php?view=clients");

?>