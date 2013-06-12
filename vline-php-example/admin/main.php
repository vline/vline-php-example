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
		$users = $dbh->getUsers();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>vLine PHP Example Configuration</title>
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
    <script src="scripts/main.js"></script>
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
          <a class="brand" href="#">vLine PHP Example</a>
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
      <h1>Manage Users</h1>
      <hr>
      <p>
      	<h2>Add User</h2>
        <form action="./actions/adduser.php" method="post" onSubmit="return trytosubmit();">
        <table class="table">
            <tr>
            	<td>Full Name</td>
                <td><input type="text" placeholder="" name="name" id="name"></td>
            </tr>
            <tr>
            	<td>Username</td>
                <td><input type="text" placeholder="" name="username" id="username"></td>
            </tr>
            <tr>
            	<td>Password</td>
                <td><input type="password" placeholder="" name="password" id="password"></td>
            </tr>
            <tr>
            	<td colspan="2"><input type="submit" class="btn" value="Submit" /></td>
            </tr>
        </table>
        </form>
      </p>
      <hr>
      <p>
      	<h2>Users List</h2>
        <table class="table">
        	<tr>
            	<th width="2%">#</th>
                <th width="40%">Full Name</th>
                <th width="18%"></th>
            </tr>
            <?php 
			$index = 1;
			while($row = mysqli_fetch_array($users, MYSQLI_ASSOC)){ 
			?>
            <tr>
            	<td><?php echo $index++ ?></td>
                <td><?php echo $row['name'] ?></td>
                <td>
                	<a href="./edit.php?uid=<?php echo $row['id'] ?>">Edit</a>
                    <?php if($row['id'] != 1){ ?> | <a class="del" href="./actions/del.php?uid=<?php echo $row['id'] ?>">Delete</a>
                    <?php } ?>
               </td>
            </tr>
            <?php } ?>
        </table>
        
      </p>
    </div> <!-- /container -->

  </body>
</html>
