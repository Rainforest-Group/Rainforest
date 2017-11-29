<!DOCTYPE html>
<html lang="en">
    <head>
        <title>All Users</title>
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
                        require_once("controllers/adminController.php");
                        require_once("rainforestClasses.php");
                        getLoginButton();
                    ?>
                </ul>
            </nav>
            <br>
            <?php checkAdmin(); ?>
            <div class="jumbotron jumbotron-billboard text-black text-center">
                <div class="img"></div>  <!-- TODO add background Image !-->
                <div class="col-lg-4">  <img src="" class="img-rounded">    </div>
                <div class="container">
                    <h4 class="display-3">User Listing</h4>
                    <br>
                    <a href="admin.php" class="btn btn-info">Back to Admin</a>
                </div>
            </div>
            <br>
        </header>
        <mid>
            <form action="viewUsers.php" method="POST">
            <?php
                if (isset($_POST["user"])) {
                    $username = $_POST["user"];
                    toggleAdmin($username);
                }

                $users = getAllUsers();

                foreach ($users as $user) {
                    $name = $user->getUsername();
                    $admin = $user->isAdmin();
                    $button = $admin ? "Demote to Customer" : "Promote to Admin";
                    echo '<div class="col-md-9"><div class="card b-1 hover-shadom mb-20"><div class="media card-body">';
                    echo "<div class=\"media-body\"><h2>$name</h2></div>";
                    // Don't let admins demote themselves.
                    if ($name != getCurrentUser()->getUsername()) {
                        echo '<div class="card-hover-show"><button type="submit" name="user" value="'.$name.'" class="btn btn-xs fs-10 btn-bold btn-block btn-info">'.$button.'</a></div>';
                    }
                    echo '</div></div></div>';
                    echo '<br>';
                }
            ?>
        </mid>
    </body>
</html>
