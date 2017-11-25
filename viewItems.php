<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Inventory</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/viewItem.css">
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

<?php
require_once("controllers/viewItemsController.php");

getLoginButton();
?>
    </nav>
  </header>
  <mid>
    <div class="col-xs-6">

      <div class="container" id="margin">
        <div><h2>Items in stock: </h2></div>

    <table class="table table-hover">
        <tr>
          <!-- dummy data should be a PHP loop instead!-->
          <th>Name</th>
          <th>Description</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>

<?php

$items = getItems();

foreach ($items as $item) {
    $name = $item->getName();
    $summary = $item->getSummary();
    $quantity = $item->getQuantity();
    $price = $item->getPrice();
    echo "<tr>";
    echo "<td>$name</td>";
    echo "<td>$summary</td>";
    echo "<td>$quantity</td>";
    echo "<td>$price</td>";
    echo "</tr>";
}
?>
    </table>
  </div>
</div>


  </mid>



    </div><!-- end .container -->
      </body>
  </html>
