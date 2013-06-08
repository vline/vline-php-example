<?php
session_start();
include("../../classes/DbHandler.php");
$dbh = new DbHandler();
$mysqli = $dbh->connect('../../');
if(!$mysqli){
	header("Location: ../../install/index.php");	
}
else{
	$auth = $dbh->authAdmin($_POST);
	if($auth){
		header("Location: ../main.php");	
	} else{
		header("Location: ../index.php?failed=1");	
	}
}
?>