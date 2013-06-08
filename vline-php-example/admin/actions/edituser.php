<?php
session_start();

if($_SESSION['authed'] == 1){
	include("../../classes/DbHandler.php");
	$dbh = new DbHandler();
	$dbh->connect('../../');
	$dbh->saveUser($_POST);
	$msg = urlencode("User info updated succesfully");
	header("Location: ../edit.php?uid=".$_POST['id']."&msg=".$msg);
}
?>