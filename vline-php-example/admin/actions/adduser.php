<?php
session_start();

if($_SESSION['authed'] == 1){
	include("../../classes/DbHandler.php");
	$dbh = new DbHandler();
	$dbh->connect('../../');
	$dbh->addUser($_POST);
	$msg = urlencode("User added succesfully");
	header("Location: ../main.php?msg=".$msg);
}
?>