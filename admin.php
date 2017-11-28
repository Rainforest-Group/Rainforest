<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="register.css">
  <script type="text/javascript">
   function Home(){  window.location='main.html';  }
  </script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

        <form class="form-inline" >
        <input  name="q" id="pull" class="form-control input-lg" type="text" placeholder="Search" value="<?php if (isset($_REQUEST["q"])) echo $_REQUEST["q"]; ?>">
          <button class="btn btn-info" type="submit" id="pull">Search</button>
        </form>
        <div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<?php
require_once("controllers/adminController.php");

getLoginButton();
?>
</div>

    </nav>
    <br>
    <div class="jumbotron jumbotron-billboard text-black text-center">
      <div class="img"></div>  <!-- TODO add background Image !-->
    <div class="col-lg-4">  <img src="" class="img-rounded">    </div>
      <div class="container">
          <h4 class="display-3"> Admin Page</h4>
      </div>
     </div>
      <br>
  </header>



  <mid>
<?php

$user = getCurrentUser();

if (!$user->isAdmin()) {
    echo '<div class="text-center"><h4>You do not have administrative privileges</h4></div>';
    die();
}


?>

    <div class="row">
        <div class="col-sm text-center">
            <a class="btn btn-success" href="addItem.php">Add Item to Inventory</a>
        </div>
        <div class="col-sm text-center">
            <a class="btn btn-info" href="viewUsers.php">View all Users</a>
        </div>
        <div class="col-sm text-center">
            <a class="btn btn-info" href="viewOrders.php">View all Orders</a>
        </div>
    </div>
        
   
  

  </mid>
      </body>
  </html>
