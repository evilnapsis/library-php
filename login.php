<?php

define('LBROOT',getcwd()); // LegoBox Root ... the server root
include("lib/legobox/lib/Database.php");

$user = $_POST['email'];
$pass = $_POST['password'];

$base = new Database();
$con = $base->connect();
$sql = "select * from admin where email= \"".$user."\" and password= \"".$pass."\"";
//print $sql;
$query = $con->query($sql);
$found = false;
$userid = null;
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
}
if($found==true) {
	session_start();
//	print $userid;
	$_SESSION['admin_id']=$userid ;
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];
	print "Cargando ... $user";
	print "<script>window.location='./';</script>";
}else {
	print "<script>window.location='./';</script>";
}
?>