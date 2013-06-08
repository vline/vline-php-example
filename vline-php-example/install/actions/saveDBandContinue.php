<?php
include('../classes/Installer.php');
$installer = new VlinePHPinstaller();
$installer->saveDB($_POST);
header("Location: ../dbtables.php");
?>