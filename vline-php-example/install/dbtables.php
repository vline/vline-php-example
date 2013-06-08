<?php
include_once('classes/Installer.php');
$installer = new VlinePHPinstaller();
$con = $installer->createDBandTables();
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
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->

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
         <?php 
		 $pos = "tablescheck";
		 include('./install_menu.php') ?>
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Step 3: Install database and tables</h1>
      <hr>
      <p>
      	<h2>Info</h2>
        This step creates the database <code>vline-php-example</code> and all the tables needed in order for the demo to run
      </p>
      <hr>
      <p>
      	<h2>Status</h2>
        <form class="navbar-form" action="actions/saveDBandContinue.php" method="post">
        	<table class="table">
            	<tr>
                	<td>Database created</td>
                    <td><img src="../images/<?php echo $installer->getYesNoIcon($con['dbcreated']) ?>.png"></td>
                </tr>
                <tr>
                	<td>Tables created</td>
                    <td><img src="../images/<?php echo $installer->getYesNoIcon($con['tablecreated']) ?>.png"></td>
                </tr>
                <tr>
                	<td>Admin account created</td>
                    <td><img src="../images/<?php echo $installer->getYesNoIcon($con['admincreated']) ?>.png"></td>
                </tr>
                <?php if($con['admincreated']){ ?>
                <tr>
                  <td>Admin account defaults:</td>
                  <td>Username: admin, password: admin</td>
                </tr>
                <?php } else{ ?>
                <tr>
                  <td colspan="2">The Admin account has not been created. Most propably because the table already contains users.</td>
                </tr>
                <?php } ?>
            </table>
          	
        </form>
      </p>
      <?php if($con['dbcreated'] && $con['tablecreated']){ ?>
      <hr>
		<p align="right">
        <button type="button" class="btn" onClick="window.location= './apicheck.php'">Next step</button>
      </p>
      <?php } ?>
    </div> <!-- /container -->

  </body>
</html>
