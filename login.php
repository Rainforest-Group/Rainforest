<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/login.css">
  <link rel="stylesheet" href="static/css/design.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script type="text/javascript">
	  function register(){  window.location='register.php';  }
	   function Home(){  window.location='main.html';  }
  </script>
  <script type="text/javascript">
	  function logIn(){  window.location='login.php';  }
	   function shop(){  window.location='inventory.php';  }
          function logOut() { window.location='logout.php'; }
  </script>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="index.php">
                    <img src="rainforest_logo.png" width="30" height="30">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php">Administrators</a>
            </li>

        </ul>
    </nav>
	
  
  
  
	<mid> 
		<div class="row">
		<div class="modal-dialog">
		<div class="modal-content" id="padd"> <!--  adds boarders to the window!-->
<?php

require_once("controllers/loginController.php");

$errors = "";

// Check to see if the form has been submitted
if (isset($_POST["login"])) {

    if (checkCredentials($_POST["username"], $_POST["password"])) {
        // Correct credentials
        createSession($_POST["username"], $_POST["password"]);
        // Redirect to correct page
        currentLogin();
    }
    else {
        // Incorrect credentials
        $errors = "Incorrect username/password combination.";
    }
}
else {
    // Find out if the user is already logged in
    // and redirect if needed
    currentLogin();

}
?>
    
    <div class="modal-header"><h3>Log In</h3></div><br>

    <form method="POST" action="login.php">

        <div class="form-group">
            <label for="username" class="control-label">Username</label>
                <?php
                $username = isset($_GET["username"]) ? $_GET["username"] : ""; 
                echo "<input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" value=\"$username\" required=\"\"  placeholder=\"Enter username\">";
                ?>
            <label for="password" class="control-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="" required="" placeholder="Enter password">
        </div>
        <div class="form-row">
            <div class="col">
                <button type="submit" name="login" value="submit" class="btn btn-success">Login</button>
            </div>
            <div class="col">                     
                <a href="register.php" class="btn btn-info">Create an Account</a>
            </div>
        </div>
        <div>
            <br>
            <a href="#Optional" class="btn btn-default btn-block">Forgot My Password</a>
        </div>
    </form>
    <?php
    if ($errors) echo "<div class=\"alert alert-danger\">$errors</div>";
    ?>
    </div> 
    </div>
    </div>

  </mid>
  
  



    </div><!-- end .container -->
      </body>
  </html>
