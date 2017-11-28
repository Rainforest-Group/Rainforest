<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="Register.css">
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
        <form class="form-inline" method="get" action="inventory.php">
          <input class="form-control input-lg" type="text" placeholder="Search" name="q">
          <button class="btn btn-info" type="submit" id="pull">Search</button>
        </form>
<?php
require_once("controllers/helpers.php");
require_once("rainforestClasses.php");

getLoginButton();

if (isset($_POST["createProfile"])) {
    try {
        $item = new Item(-1, $_POST["name"], $_POST["price"], $_POST["description"], false, $_POST["quantity"]);
        header("Location: inventory.php");
        die();
    }
    catch (Exception $e) {
        echo '<div class="alert alert-danger">Could not add item</div>';
    }
}
?>
		</nav>
  </header>


  <mid>
		<div class="col-xs-6" id="Logform">    <!--  Allow adjacent divs login and the big note-->
		<div class="modal-dialog">
		<div class="modal-content" id="padd" style="padding: 15px;"> <!--  adds boarders to the window!-->
<form action="addItem.php" method="POST">
		<div class="modal-header"><h3>Adding New Item</h3></div><br>
                            <div class="form-group">
                                <label for="name" class="control-label">Name:</label>
                                <input type="text" class="form-control" id="username" name="name" value="" required=""  placeholder="new Item">
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label">Description:</label>
                                <input type="text" class="form-control" id="password" name="description" value="" required=""  placeholder="Used">
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="control-label">Quantity In Stock:</label>
                                <input type="number" class="form-control" min="0" id="address" name="quantity" required="" />
                            </div>
                            <div class="form-group">
                                <label for="price" class="control-label">Price:</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="price" required="" />
                            </div>
                            <button type="submit" name="createProfile" value="submit" class="btn btn-success">Add to Inventory</button>
                        </div>

</form>
                </div>
            </div>
        </div>



  </mid>

    </div><!-- end .container -->
      </body>
  </html>
