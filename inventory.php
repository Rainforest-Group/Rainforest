<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventory</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/design.css">
  <link rel="stylesheet" href="register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
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
                require_once("controllers/inventoryController.php"); 
                getLoginButton();
            ?>
        </ul>
    </nav>
    
    
    <br>
    <div class="jumbotron jumbotron-billboard text-black text-center">
      <div class="img"></div>  <!-- TODO add background Image !-->
    <div class="col-lg-4">  <img src="" class="img-rounded">    </div>
      <div class="container">
          <h4 class="display-3"> Inventory</h4>
      </div>
     </div>
      <br>




  <mid>

<?php

if (isset($_REQUEST["q"])) {
    $items = getItems($_REQUEST["q"]);
}
else {
    $items = getItems(false);
}

if (isset($_POST["item"])) {
    $item_id = $_POST["item"];
    addToCart($item_id);
}

$user = getCurrentUser();

foreach ($items as $item) {
    $name = $item->getName();
    $summary = $item->getSummary();
    $quantity = $item->getQuantity();
    $price = $item->getPrice();
    $id = $item->getID();
    echo '<div class="col-md-9"><div class="card b-1 hover-shadom mb-20"><div class="media card-body">';
    echo "<div class=\"media-body\"><h2>$name</h2><p>$summary<br>$quantity in stock</p></div>";
    echo "<div style=\"margin-right: 70px;\" class=\"media-right text-right d-none d-md-block\"><h3>$$price</h3></div>";
    echo '<div class="card-hover-show"><a href="detailedItem.php?item='.$id.'" class="btn btn-success">View detail</a></div>';
    if ($quantity > 0) {
        echo '<form action="inventory.php" method="POST">';
        echo '<div class="card-hover-show"><button type="submit" name="item" value="'.$id.'" class="btn btn-xs fs-10 btn-bold btn-block btn-info">Add to Cart</a></div>';
        echo '</form>';
    }

    if ($user && $user->isAdmin()) {
        echo '<form action="controllers/deleteItemController.php" method="POST">';
        echo '<button type="submit" class="btn btn-danger" name="item" value="'.$id.'">&times;</button>';
        echo '</form>';
    }
    echo '</div></div></div>';
    echo '<br>';
}
?>
  </mid>
      </body>
  </html>
