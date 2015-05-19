<?php
session_start();
// ---
// la tarea de este archivo es eliminar todo rastro de cookie

// -- eliminamos el usuario
if(isset($_SESSION['admin_id'])){
	unset($_SESSION['admin_id']);
}

session_destroy();
// v0 29 jul 2013
//estemos donde estemos nos redirije al index
print "<script>window.location='./';</script>";
?>