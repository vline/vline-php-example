<?php
include_once('classes/Installer.php');
$installer = new VlinePHPinstaller();
$con = $installer->checkDBconnectionFromConf();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>vline PHP Example Configuration</title>
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
    <script src="../scripts/jquery-1.10.1.min.js"></script>
    <script src="scripts/database.js"></script>

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
		 $pos = "dbcheck";
		 include('./install_menu.php') ?>
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Step 2: Configure Database Connection</h1>
      <hr>
      <p>
      	<h2>Current Status</h2>
        <img src="../images/<?php echo $installer->getYesNoIcon($con['connected']) ?>.png">
      	<?php if($con['connected']){ ?>
		Successfully connected to the MySQL server!
		<?php } else{ ?>
        Connection could not be established. Please make sure MySQL is running and that the configuration info is
        valid before trying again.
        <?php } ?>
      </p>
      <hr>
      <p>
      	<h2>Configuration</h2>
        <form class="navbar-form" action="actions/saveDBandContinue.php" method="post">
        	<table class="table">
            	<tr>
                	<td>Host</td>
                    <td><input type="text" placeholder="" name="host" id="host" value="<?php echo $con['conf']->host ?>"></td>
                </tr>
                <tr>
                	<td>Username</td>
                    <td><input type="text" placeholder="" name="user" id="user" value="<?php echo $con['conf']->username ?>"></td>
                </tr>
                <tr>
                	<td>Password</td>
                    <td><input type="password" placeholder="" name="password" id="password" value="<?php echo $con['conf']->password ?>" ></td>
                </tr>
                <tr>
                	<td colspan="2"><button type="button" class="btn checkconn">Check connection</button></td>
                </tr>
            </table>
          	
        </form>
      </p>
      <hr>
		<p align="right">
        <button type="button" class="btn" onClick="tryToGoToNextStep()">Next step</button>
      </p>
    </div> <!-- /container -->

  </body>
</html>
