<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>

<header>
    <!-- navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	
      <!-- Brand/logo -->
      <a class="navbar-brand" href="#">
    <!-- add logo Image   !-->
      </a>
	  
        <!--Search form -->
        <form class="form-inline" >
          <input  id="pull" class="form-control input-lg" type="text" placeholder="Search">
          <button class="btn btn-info" type="submit" id="pull">Search</button>
        </form>
		
        <button type="button" class="btn btn-light" id="login"><a href="LogIn.html"><b>Log In</b></a></button>
        <button type="button" class="btn btn-light" id="home"><a href="main.html"><b>Home</b></a></button>
    </nav>
  </header>
  
  
  <mid>
		<div class="col-xs-6" id="Logform">    <!--  Allow adjacent divs login and the big note-->
		<div class="modal-dialog">
		<div class="modal-content" id="padd"> <!--  adds boarders to the window!-->
		<div class="modal-header"><h3>Registeration</h3></div>
						<form method="GET" action="AccountIn">
							<div class="form-group">
								<label for="username" class="control-label">First Name</label>
								<input type="text" class="form-control" id="lastname" name="firstname" value="" required="" placeholder="First name">
								<label for="username" class="control-label">Last name</label>
								<input type="text" class="form-control" id="lastname" name="lastname" value="" required=""  placeholder="Last name">
								<label for="username" class="control-label">Username</label>
								<input type="text" class="form-control" id="username" name="username" value="" required=""  placeholder="example@gmail.com">
								<label for="password" class="control-label">Password</label>
								<input type="password" class="form-control" id="password" name="password" value="" required=""  placeholder="your password">
								<label for="password" class="control-label">Confirm Password</label>
								<input type="password" class="form-control" id="password" name="password" value="" required=""  placeholder="Confirm password">
							</div>
							<button type="submit" class="btn btn-success">Sign up</button>
						</form>
		</div>  </div> </div>



  </mid>



    </div><!-- end .container -->
      </body>
  </html>
