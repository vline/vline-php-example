<?php
session_start();
// Class's "Checker" "checkInstallation" method checks if the vline php example has been properly installed and configured  
include('./classes/Checker.php');
include('./classes/DbHandler.php');
$chk = new Checker();
if(!$chk->checkInstallation("./"))
	header("Location: ./install/index.php");
else{
	// All authenticated users have $_SESSION['plainuserauth'] == 1
	// If the user is already authenticated by the system then he/she stays. If not he/she is been directed to index.php page
	// in order to fill in the authentication form
	if($_SESSION['plainuserauth'] != 1)
		header("Location: ./index.php");
	else{
	// the application is installed and configured properly, the user is authenticated
	// we instatiate an object of the class DbHandler
		$dbh = new DbHandler();
	// we connect to the database
		$dbh->connect();	
	// and get all the registered users
		$users = $dbh->getUsers();
	// Vline
	// Before anything else, first we have to include the JWT.php file 
		include("./includes/JWT.php");
	// And now we acquire the token form Vline by setting the user and calling the init method of the Vline class
		include("./classes/Vline.php");
		$vline = new Vline();
		$vline->setUser($_SESSION['user']['id'], $_SESSION['user']['surname']." ".$_SESSION['user']['name']);
		$vline->init();
	// Almost ready. All we have to do is to include the vline.js script on the head section. Also, take a look on the scrit placed just before the </body> tag.
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Vline php example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link type="image/png" href="./images/favicon.png" rel="shortcut icon"/>
    <!-- Le styles -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    
    <script src="scripts/jquery-1.10.1.min.js"></script>
    
    <!-- vline --------------------------------------------->
    <!-- Load the vline script ----------------------------->
    <script src="https://static.vline.com/vline.js" type="text/javascript"></script>
	<!-- /vline script ------------------------------------->



    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#"><img src="images/logo.png"></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <?php echo $_SESSION['user']['surname']." ".$_SESSION['user']['name'] ?>
            </p>
            <ul class="nav">
              <li><a href="./admin/index.php">Go to admin panel</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
            <div style="padding:2%; width:96%">
                <h4>Make calls</h4>
                 <p>Click on any of the online users listed below in order to initiate a call. <br>
The users that are online are annotated by blue background color.</p>
             </div>
          </div><!--/.well -->
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Registered Users</li>
              <?php while($row = mysqli_fetch_array($users, MYSQLI_ASSOC)){  ?>
              <li class="callbutton" data-userid="<?php echo $row['id'] ?>"><a href="#"><?php echo $row['surname']." ".$row['name'] ?></a></li>
              <?php } ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>Vline php example</h1>
            <p>Simple implementation of the Vline API integration using php.</p>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <h2>Who's online</h2>
              <p>On the left there is the list of the registered users to our application. Vline API provides us the capability to &quot;listen&quot; and know, at any time, who's online and who's not. Users that are online are annotated by blue background color.</p>
            </div><!--/span-->
            <div class="span4">
              <h2>How to make a call</h2>
              <p>Open up an incognito window on Chrome. Log in as a different user and make a call.</p>
            </div><!--/span-->
            <div class="span4">
              <h2>API reference</h2>
              <p>Except the ones used on this example Vline's API provides a number of other features and capabilities. For a full API reference you can visit the Developers section of Vline's website.</p>
              <p><a class="btn" href="https://vline.com/developer/docs/vline.js/" target="_blank">API overview &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>
	<!--
      <footer>
        <p>&copy; Company 2013</p>
      </footer>
	-->
    </div><!--/.fluid-container-->

	<!-- vline ------------------------------------------->
	<script>
	var vlineClient = (function(){
	  
	  var client, vlinesession,
		authToken = '<?php echo $vline->getJWT() ?>',
		serviceId = '<?php echo $vline->getServiceID() ?>',
		profile = {"displayName": '<?php echo $vline->getUserDisplayName() ?>', "id": '<?php echo $vline->getUserID() ?>'};
	
	  // Create vLine client  
	  window.vlineClient = client = vline.Client.create({"serviceId": serviceId, "ui": true});
	  // Add login event handler
	  client.on('login', onLogin);
	  // Do login
	  
	  
      client.login(serviceId, profile, authToken);
      
	
	  function onLogin(event) {
		vlinesession = event.target;

		// Find and init call buttons and init them
		$(".callbutton").each(function(index, element) {
           initCallButton($(this)); 
        });
	  }
	
	  // add event handlers for call button
	  function initCallButton(button) {
		var userId = button.attr('data-userid');
	  
		// fetch person object associated with username
		vlinesession.getPerson(userId).done(function(person) {
		  // update button state with presence
		  function onPresenceChange() {
			if(person.getPresenceState() == 'online'){
				button.removeClass().addClass('active');	
			}else{
				button.removeClass();	
			}
			button.attr('data-presence', person.getPresenceState());
		  }
		
		  // set current presence
		  onPresenceChange();
		
		  // handle presence changes
		  person.on('change', onPresenceChange);
		
		  // start a call when button is clicked
		  button.click(function() {
			  if(button.hasClass('active'))
				person.startMedia();
		  });
		});
	  }
	  
	  return client;
	})();
	</script>
    <!-- /vline -------------------------------------------->
    
  </body>
</html>
