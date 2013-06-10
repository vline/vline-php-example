<?php
include_once('classes/Installer.php');
$installer = new VlinePHPinstaller();
$res = $installer->checkConfFile();
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
		 $pos = "confcheck";
		 include('./install_menu.php');
		 ?>
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Step 1: Check configuration file</h1>
      <hr>
      <p>
      	<h2>Info</h2>
      	The configuration file, <code>vline-php-example/conf.json</code>, contains the database connection information
      	(host, username , password).<br>
        <h4>The file's format is:</h4><br>
        <pre>
        {
            "host":"localhost",
            "username":"username",
            "password":""
        }
        </pre>
      </p>
      <hr>
      <p>
      	<h2>Check</h2>
        <table class="table">
         	<tr>
            	<td>File Exists</td>
                <td><img src="../images/<?php echo $installer->getYesNoIcon($res['exists']) ?>.png"></td>
            </tr>
            <tr>
            	<td>File is Writable</td>
                <td><img src="../images/<?php echo $installer->getYesNoIcon($res['iswritable']) ?>.png"></td>
            </tr>
        </table>
      </p>
      <p>
		  <?php if(!$res['exists']){ ?>
          <div class="error">
            The <code>vline-php-example/conf.json</code> file does not exist. Restore it and then press the
            "Re-check" button.
          </div>
          <?php }
          else if(!$res['iswritable']){ ?>
          <div class="error">
            The <code>vline-php-example/conf.json</code> file is not writable. Please check the write permissions and try again by pressing the "Re-check" button.
          </div>
          <?php } ?>
      </p>
      <hr>
      <p align="right">
      	<?php if($res['iswritable'] && $res['exists']){ ?>
        <button type="button" class="btn" onClick="window.location = './database.php'">Next Step</button>
        <?php } else{ ?>
        <button type="button" class="btn" onClick="location.reload()">Re-check</button>
        <?php } ?>
      </p>
    </div> <!-- /container -->

  </body>
</html>
