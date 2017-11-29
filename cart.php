<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inventory</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="static/css/design.css">
        <script type="text/javascript">
            function Home(){  window.location='main.html';  }
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
                        require_once("controllers/cartController.php"); 
                        getLoginButton();
                    ?>
                </ul>
            </nav>
            <br>
                <div class="jumbotron jumbotron-billboard text-black text-center">
                    <div class="img"></div>  <!-- TODO add background Image !-->
                    <div class="col-lg-4">  <img src="" class="img-rounded">    </div>
                    <div class="container">
                        <h4 class="display-3">Your Cart</h4> <a class="btn btn-info" href="inventory.php">Back to Shop</a>
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

                    try {
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
                            echo "<div class=\"media-body\"><h2><a href=\"detailedItem.php?item=".$id."\"  style=\"color:black\">$name</a></h2><p>$summary</p></div>";
                            echo "<div style=\"margin-right: 70px;\" class=\"media-right text-right d-none d-md-block\"><h3>$$price</h3></div>";
                            echo "<div style=\"margin-right: 40px;\" class=\"media-right text-right\"><h4>$quantity</h4></div>";
                            echo '<div class="card-hover-show"><button type="submit" name="item" value="'.$id.'" class="btn btn-xs fs-10 btn-bold btn-block btn-danger">&times;</a></div>';
                            echo '</div></div></div>';
                            echo '<br>';
                        }
                        echo '<div class="container text-center">';
                        echo '<a href="placeOrder.php" class="btn btn-success">Place Order</a>';
                        echo '</div>';
                    }
                    catch (Exception $e) {
                        echo '<div class="container jumbotron text-center"><h2>Cart is Empty</h2></div>';
                    }
                ?>
            </form>
        </mid>
    </body>
</html>
