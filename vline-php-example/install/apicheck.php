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
		 $pos = "apicheck";
		 include('./install_menu.php') ?>
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Step 4: Configure the vLine API Class</h1>
      <hr>
      <p>
      	<h2>Info</h2>
        In order for the demo to work, you must perform the following steps:
        <ul>
       	 	<li>Sign up for a <a href="https://vline.com/developer/" target="_blank">vLine developer account</a> and create your vLine service.</li>
			<li>Make note of your <code>API Secret</code> on the <code>Service Settings</code> tab in the <a href="https://vline.com/developer/app/" target="_blank">vLine Developer Console</a>.</li>
            <li>Open <code>vline-php-example/classes/Vline.php</code> and fill in your your <code>Service ID</code>
            and <code>API Secret</code>.</li>
            <li>You are ready to go!</li>
        </ul>
      </p>
      <hr>
      <p>
      	<h2>Next Steps</h2>
        <ul>
        	<li><a href="../admin/">Add users</a></li>
            <li><a href="../">Go straight to the application</a></li>
        </ul>
        <div style="background-color:#eee; width:98%; padding:1%">
        All users added with the administration panel are stored in the <code>users</code> table in the
        <code>vline-php-example</code> database. In order to better understand the integration,
        take a look at <code>vline-php-example/main.php</code> and <code>vline-php-example/classes/Vline.php</code>.
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
