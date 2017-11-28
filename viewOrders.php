<!DOCTYPE html>
<html lang="en">
<head>
  <title>All Users</title>
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
       <ul class="navbar-nav mr-auto">
          <li class="nav-item">

            <input  name="q" id="pull" class="form-control input-lg" type="text" placeholder="Search" value="<?php if (isset($_REQUEST["q"])) echo $_REQUEST["q"]; ?>">
          </li>
          <li class="nav-item">
              <button class="btn btn-info" type="submit" id="pull">Search</button>
          </li>
          <li class="nav-item">
<?php
require_once("controllers/adminController.php");

getLoginButton();

checkAdmin();

?>
</li>
</ul>
            </form>

    </nav>
    <br>
    <div class="jumbotron jumbotron-billboard text-black text-center">
      <div class="img"></div>  <!-- TODO add background Image !-->
    <div class="col-lg-4">  <img src="" class="img-rounded">    </div>
      <div class="container">
          <h4 class="display-3">User Listing</h4>
      </div>
     </div>
      <br>
  </header>



  <mid>

<form action="viewUsers.php" method="POST">
<?php

if (isset($_POST["order"])) {
    $order_id = $_POST["order"];
    fillOrder($order_id);
}

$orders = getOrders();

foreach ($orders as $order) {
    $id = $order->getOrderId();
    $name = $order->getUsername();
    $address = buildAddress($name);
    $filled = $order->isFilled();
    $button = $filled ? "<h5>Filled</h5" : '<button type="submit" name="order" value="'.$id.'" class="btn btn-success">Mark as Filled</button>';
    echo '<div class="col-md-9"><div class="card b-1 hover-shadom mb-20"><div class="media card-body">';
    echo "<div class=\"media-body\"><h2>$name</h2></div>";
    echo "<div class=\"card-body\">$address</div>";
    echo '<div class=\"card-body\" style="margin-right: 40px;"><ul class="list-group">';
    foreach ($order->getItemList() as $id => $quantity) {
        $item = new Item($id);
        echo "<li class=\"list-group-item\">".$item->getName()."&nbsp;&nbsp;$quantity</li>";
    }
    echo '</ul></div>';
    echo '<div class="card-hover-show">'.$button.'</div>';
    echo '</div></div></div>';
    echo '<br>';
}
?>
  </mid>
      </body>
  </html>
