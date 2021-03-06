<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Profile</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="register.css">
  <link rel="stylesheet" href="static/css/design.css">
  <script type="text/javascript">
   function Home(){  window.location='main.html';  }
  </script>
  <script type="text/javascript">
	  function logIn(){  window.location='login.php';  }
	   function shop(){  window.location='inventory.php';  }
          function logOut() { window.location='logout.php'; }
  </script>
</head>
<body>
<header>
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
                
            <li>
                <button type="button" class="btn btn-success" id="home" onclick="shop();">Shop</button>
            </li>
            <li>
                <!--Search form -->
                <form class="form-inline" method="get" action="inventory.php">
                  <input class="form-control input-lg" type="text" placeholder="Search" name="q">
                  <button class="btn btn-info" type="submit" id="pull">Search</button>
                </form>
            </li>
            <?php 
                require_once("controllers/indexController.php"); 
                getLoginButton();
            ?>
        </ul>
    </nav>
    <br>
    <div class="jumbotron jumbotron-billboard text-black text-center">
      <div class="img"></div>  <!-- TODO add background Image !-->
    <div class="col-lg-4">  <img src="" class="img-rounded">    </div>
      <div class="container">
          <h4 class="display-3">Edit Profile Data</h4>
      </div>
     </div>
      <br>
  </header>



  <mid>
    <mid>
      <div class="col-xs-6" id="Logform">    <!--  Allow adjacent divs login and the big note-->
      <div class="modal-dialog">
      <div class="modal-content" id="padd"> <!--  adds boarders to the window!-->
      <div class="modal-header"></div>

                <!--         profile data should be displayed in the text feild as value="old item value"!-->


                <form method="POST" action="AccountIn">
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
                    <button type="submit" class="btn btn-success btn-lg btn-block ">Save changes</button>
                  </form>

                          </div>

                  </div>
              </div>
          </div>



    </mid>

  </mid>
      </body>
  </html>
