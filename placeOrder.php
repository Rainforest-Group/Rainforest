<!DOCTYPE html>
<html lang="en">
<head>
  <title>Place Order</title>
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
          <input  id="pull" class="form-control input-lg" type="text" placeholder="Search">
          <button class="btn btn-info" type="submit" id="pull">Search</button>
        </form>

        <a class="btn btn-success" id="login" href="inventory.php">Shop</a>
    </nav>
  </header>

  <mid>
    <div class="container py-3">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 mx-auto">  <!-- bootstrap grid class!-->
                <div class="card">  <!-- boarders !-->
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="text-center">Payment</h1>
                        </div>
                        <form action="" method="post">

<?php
require_once("controllers/cartController.php");
if (isset($_POST["order"])) {
    placeOrder();
}

$total = 5;

echo "<h2>Payment amount: $$total</h2>";
?>

                            <div class="form-group has-success">
                                  <label class="control-label">Name on card</label>
                                  <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                  <label class="control-label" >Card Number</label>
                                  <input type="text" placeholder="1234-1234-1234-1234"class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-6">  <!-- bootstrap grid class!-->
                                    <div class="form-group">
                                        <label class="control-label">Expiration</label>
                                        <input class="form-control" placeholder="MM / YY">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="control-label">Security code</label>
                                        <input class="form-control" type="text">
                                </div>
                            </div>

                                <br>
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="order" value="place">Place Order</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </mid>

      </body>
  </html>
