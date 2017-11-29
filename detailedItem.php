<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Detailed Item</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="static/css/design.css">
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
                        require_once("controllers/indexController.php"); 
                        getLoginButton();
                    ?>
                </ul>
            </nav>
            <br>
            <?php
                require_once("rainforestClasses.php");
                if (!isset($_REQUEST["item"])) {
                    header("Location: inventory.php");
                    die();
                }
                try {
                    $item = new Item($_REQUEST["item"]);
                    $name = $item->getName();
                    $desc = $item->getDescription();
                    $price = $item->getPrice();
                }
                catch (Exception $e) {
                    $name = "Item does not exist";
                    $desc = "Could not find item.";
                    $price = "0.00";
                }
            ?>
            <div class="jumbotron jumbotron-billboard text-black text-center">
                <div class="img"></div>  <!-- TODO add background Image !-->
                <div class="col-lg-4"> </div>
                <div class="container">
                    <h4 class="display-3" ><?php echo "$name -- $$price"; ?></h4>
                </div>
            </div>
            <br>
        </header>

        <mid>
            <!--  new item       !-->
            </div>
            <br>
            <br>
            <!--  the lower discription box  !-->
            <div class="card card-body">
                <!--   Titles  !-->
                <h3 class="card-title">Description:</h3>

                <p class="card-text"><?php echo $desc; ?></p>
                <!--   the quantity box  
                    <div class="form-group row"><div class="col-xs-2">
                    <input class="form-control"  min="1" max="5" style="margin:20px" id="ex1" type="number">
                    </div></div>
                !-->
                <!--   Button !-->
                <?php
                    if (isset($_REQUEST["item"])) {
                        $id = $_REQUEST["item"];
                        echo '<form action="inventory.php" method="POST">';
                        echo '<button type="submit" name="item" value="'.$id.'" class="btn btn-success">Add to Cart</button>';
                        echo '</form>';
                    }
                ?>
            </div>
        </mid>
    </body>
</html>
