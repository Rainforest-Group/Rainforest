<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventory</title>
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
require_once("controllers/cartController.php");

getLoginButton();
?>
</div>

    </nav>
    <br>
    <div class="jumbotron jumbotron-billboard text-black text-center">
      <div class="img"></div>  <!-- TODO add background Image !-->
    <div class="col-lg-4">  <img src="" class="img-rounded">    </div>
      <div class="container">
          <h4 class="display-3">Your Cart</h4>
      </div>
     </div>
      <br>
  </header>



  <mid>
<form action="cart.php" method="POST">
<?php
if (isset($_POST["item"])) {
    $item_id = $_POST["item"];
    removeFromCart($item_id);
    header("Refresh:0;");
    die();
}

$items = getCartItems();
$quantities = getCartQuantities();

for ($i = 0; $i < count($items); $i++) {
    $item = $items[$i];
    $quantity = $quantities[$i];
    $name = $item->getName();
    $summary = $item->getSummary();
    $price = $item->getPrice();
    $id = $item->getID();
    echo '<div class="col-md-9"><div class="card b-1 hover-shadom mb-20"><div class="media card-body">';
    echo "<div class=\"media-body\"><h2>$name</h2><p>$summary</p></div>";
    echo "<div style=\"margin-right: 70px;\" class=\"media-right text-right d-none d-md-block\"><h3>$$price</h3></div>";
    echo "<div style=\"margin-right: 40px;\" class=\"media-right text-right\"><h4>$quantity</h4></div>";
    echo '<div class="card-hover-show"><button type="submit" name="item" value="'.$id.'" class="btn btn-xs fs-10 btn-bold btn-block btn-danger">&times;</a></div>';
    echo '</div></div></div>';
    echo '<br>';
}
?>
</form>
  </mid>
      </body>
  </html>

