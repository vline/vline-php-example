<?php
session_start();

if($_SESSION['authed'] == 1){
	include("../../classes/DbHandler.php");
	$dbh = new DbHandler();
	$dbh->connect('../../');
	$dbh->deleteUser($_GET['uid']);
	$msg = urlencode("User deleted");
	header("Location: ../main.php?msg=".$msg);
}
?>