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
		 $pos = "apicheck";
		 include('./install_menu.php') ?>
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Step 4: Configure Vline API Class</h1>
      <hr>
      <p>
      	<h2>Info</h2>
        The main PHP class used from the demo is located on the folder "classes" that resides on the root directory of the vline php example application. The name of the file is <code>Vline.php</code>. In order for the demo to operate you have to follow these steps:
        <ul>
       	 	<li>Sign up for a <a href="https://vline.com/developer/" target="_blank">vLine developer account</a> and create your vLine service.</li>
			<li>Make note of your <code>API Secret</code> on the <code>Service Settings</code> tab in the <a href="https://vline.com/developer/app/" target="_blank">vLine Developer Console</a>.</li>
            <li>Open the file <code>Vline.php</code> and place your API ID and Secret on the class variables.</li>
            <li>You are ready to go!</li>
        </ul>
      </p>
      <hr>
      <p>
      	<h2>Where to go from here</h2>
        <ul>
        	<li><a href="../admin/">Add some users to the application</a></li>
            <li><a href="../">Go straight to the application</a></li>
        </ul>
        <div style="background-color:#eee; width:98%; padding:1%">
        All users inserted by the administration panel are stored on the table <code>users</code> of the <code>vline-php-example</code> database. The main application loads the users from that table. In order to understand the VLine's API usage you should mainly focus and study the source code of the <code>main.php</code> and <code>Vline.php</code> files located on the root and on the classes folders of the application.
        </div>
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
