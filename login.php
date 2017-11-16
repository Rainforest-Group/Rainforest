<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
	  function register(){  window.location='register.html';  }
	   function Home(){  window.location='main.html';  }
  </script>
</head>
<body>
<header>
    <!-- navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	
      <!-- Brand/logo -->
      <a class="navbar-brand">
    <!-- add logo Image !-->
      </a>
	  
        <!--Search form -->
        <form class="form-inline" >
          <input  id="pull" class="form-control input-lg" type="text" placeholder="Search">
          <button class="btn btn-info" type="submit" id="pull">Search</button>
        </form>
        <button type="button" class="btn btn-success" id="home" onclick="Home();">Home</button>
    </nav>
	
  </header>
  
  
  
	<mid> 
		<div class="row">
		<div class="col-xs-6">  <div id="Logform">     <!--  Allow adjacent divs login and the big note-->
		<div class="modal-dialog">
		<div class="modal-content" id="padd"> <!--  adds boarders to the window!-->
<?php

require_once("controllers/loginController.php");


// Check to see if the form has been submitted
if (isset($_POST["login"])) {

    if (checkCredentials($_POST[$username], $_POST[$password])) {
        // Correct credentials
        createSession($username, $password);
        // Redirect to correct page
        currentLogin();
    }
    else {
        // Incorrect credentials
        ;
    }
}
else {
    // Find out if the user is already logged in
    // and redirect if needed
    currentLogin();
}
?>
    
		<div class="modal-header"><h3>Log In</h3></div>
						<form method="POST" action="login.php">
						
							<div class="form-group">
								<label for="username" class="control-label">Username</label>
								<input type="text" class="form-control" id="username" name="username" value="" required=""  placeholder="example@gmail.com">
								<label for="password" class="control-label">Password</label>
								<input type="password" class="form-control" id="password" name="password" value="" required="" placeholder="your password">
							</div>
							
							<button type="submit" name="login" value="submit" class="btn btn-success">Login</button>
							<a href="#Optional" class="btn btn-default btn-block">Forgot My Password</a>
							
						</form>
					</div> 
				</div>
			</div>
		</div>

		<div class="col-xs-6"><h2 class="display-4 py-5 mt-5 text-right" id="note">Or join the family</h2>
		<button type="button" class="btn btn-success" onclick="register();" id="buttonLeft">Create an Account</button></div>  <!-- button !-->


  </mid>
  
  



    </div><!-- end .container -->
      </body>
  </html>
