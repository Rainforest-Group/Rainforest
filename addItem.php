<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Item</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="Register.css">
        <link rel="stylesheet" href="static/css/design.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
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
                    require_once("controllers/helpers.php"); 
                    require_once("rainforestClasses.php");
                    getLoginButton();
                ?>
            </ul>
        </nav>

        <?php
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
                            <div class="form-row">
                                <div class="col">
                                    <button type="submit" name="createProfile" value="submit" class="btn btn-success">Add to Inventory</button>
                                </div>
                                <div class="col">
                                    <a href="admin.php" class="btn btn-info">Back to Admin</a>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </mid>
        </div><!-- end .container -->
    </body>
</html>
