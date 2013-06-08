<?php
session_start();

include('../classes/Checker.php');
include('../classes/DbHandler.php');
$chk = new Checker();
if(!$chk->checkInstallation())
	header("Location: ../install/index.php");
else{
	if($_SESSION['authed'] != 1)
		header("Location: ./index.php");
	else{
		//error_reporting(E_ALL ^ E_NOTICE);
		$dbh = new DbHandler();
		$dbh->connect('../');
		$user = $dbh->getUser($_GET['uid']);
		if($user === false){
			$msg = urlencode('The user with the provided id does not exist!');
			header("Location: ./main.php?msg=".$msg);	
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vline php example set up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link type="image/png" href="../images/favicon.png" rel="shortcut icon"/>
    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->
	<script src="../scripts/jquery-1.10.1.min.js"></script>
    <script src="scripts/edit.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><img src="../images/logo.png"></a>
         <?php include("./admin_menu.php"); ?>
        </div>
      </div>
    </div>

    <div class="container">
	   <?php if(array_key_exists('msg', $_GET)){ ?>
       	<div class="msg">
        	<?php echo $_GET['msg'] ?>
        </div>
       <?php } ?>
      <h1>Edit User</h1>
      <hr>
      <p>
        <form action="./actions/edituser.php" method="post" onSubmit="return trytosubmit();">
        <table class="table">
        	<tr>
            	<td>Surname</td>
                <td><input name="surname" type="text" id="surname" placeholder="" value="<?php echo $user['surname'] ?>"></td>
            </tr>
            <tr>
            	<td>Name</td>
                <td><input name="name" type="text" id="name" placeholder="" value="<?php echo $user['name'] ?>"></td>
            </tr>
            <tr>
            	<td>Username</td>
                <td><input name="username" type="text" id="username" placeholder="" value="<?php echo $user['username'] ?>"></td>
            </tr>
            <tr>
            	<td>Password</td>
                <td><input name="password" type="password" id="password" placeholder="" value="<?php echo $user['password'] ?>"></td>
            </tr>
            <tr>
            	<td colspan="2"><input type="submit" class="btn" value="Save" /> <button type="button" class="btn" onClick="window.location='./main.php'">Return to List</button></td>
            </tr>
        </table>
        <input type="hidden" name="id" id="id" value="<?php echo $_GET['uid'] ?>" />
        </form>
      </p>
      <hr>
    </div> <!-- /container -->

  </body>
</html>
