<?php
error_reporting(0);
include('../classes/Installer.php');
$inst = new VlinePHPinstaller();
$con = $inst->checkDBconnection($_POST['host'], $_POST['user'], $_POST['password']);
echo json_encode(array('connected'=>$con));
?>