<?php
include("../../classes/DbHandler.php");
$dbh = new DbHandler();
$dbh->connect("../../");
echo json_encode(array("valid"=>$dbh->checkUsername($_POST)));
?>