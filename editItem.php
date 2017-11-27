<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="Register.css">
    <script type="text/javascript">
	  function logOut(){  window.location='Index.php';  }
	   function Home(){  window.location='main.html';  }
  </script>
</head>
<body>
<?php
require_once("controllers/registerController.php");

$errors = "";
?>

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

        <button type="button" class="btn btn-success" id="login" onclick="logOut();">Log Out</button>
        <button type="button" class="btn btn-success" id="home" onclick="Home();">Home</button>
		</nav>
  </header>


  <mid>
		<div class="col-xs-6" id="Logform">    <!--  Allow adjacent divs login and the big note-->
		<div class="modal-dialog">
		<div class="modal-content" id="padd"> <!--  adds boarders to the window!-->
		<div class="modal-header"><h3>Editing Item</h3></div><br>

              <!--             When using this page old data for that Item should be
              displayed in the text feild as value="old item value"!-->


                            <label for="username" class="control-label">Name:</label>
                            <input type="text" class="form-control" id="username" name="username" value="" required=""  placeholder="new Item">
                            <br>
                            <label for="password" class="control-label">Description:</label>
                            <input type="text" class="form-control" id="password" name="password" value="" required=""  placeholder="Used">
                            <br>
                            <label for="address" class="control-label">Quantity In Stock:</label>
                            <input type="number" class="form-control" min="0" id="address" name="address" required="" />
                            <br>
                            <label for="city" class="control-label">Image Link:</label>
                            <input type="text" class="form-control" id="city" name="city" required="" />
                            <br>
                              <button type="submit" name="createProfile" value="submit" class="btn btn-success">Save changes</button>
							                                <br>
                              <button type="submit" name="createProfile" value="submit" class="btn btn-danger">Delete Item</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>



  </mid>

    </div><!-- end .container -->
      </body>
  </html>