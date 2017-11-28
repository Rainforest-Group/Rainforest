<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/design.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
	  function logIn(){  window.location='login.php';  }
	   function shop(){  window.location='inventory.php';  }
          function logOut() { window.location='logout.php'; }
  </script>
</head>
<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		  <!-- Brand/logo -->
                  <a class="navbar-brand" href="#">
                      <img src="rainforestLogo.jpg" width="30" height="30" alt="">
		  </a>

		  <!-- Links -->
		  <ul class="navbar-nav">
			<li class="nav-item">
			  <a class="nav-link" href="admin.php">Administrators</a>
			</li>
		  </ul>

<?php require_once("controllers/indexController.php"); 
getLoginButton();
?>
            <button type="button" class="btn btn-success" id="home" onclick="shop();">Shop</button>
            
            <!--Search form -->
            <form class="form-inline" method="get" action="inventory.php">
              <input class="form-control input-lg" type="text" placeholder="Search" name="q">
              <button class="btn btn-info" type="submit" id="pull">Search</button>
            </form>

    </nav>
	
    <div class="jumbotron jumbotron-billboard text-black text-center">
    <div class="img"></div>
      <div class="container">
          <h1 class="display-1">   Welcome to Rainforest</h1>
          <p class="lead">Shop confidently...</p>
      </div>
     </div>

        <!-- navs -->
			<div class="container text-muted">
				<br><br>
				<h2 class="display-4 py-5 mt-5 text-center">What do you need today ...</h2>

				

			</div>
      </body>
  </html>
