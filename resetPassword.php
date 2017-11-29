<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reset Password</title>
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
                    require_once("controllers/adminController.php"); 
                    require_once("rainforestClasses.php");
                    require_once("databaseOps.php");
                    getLoginButton();
                ?>
            </ul>
        </nav>

        <?php
            if (isset($_POST["username"]) and isset($_POST["email"])) {
                $username = sanitize($_POST["username"]);
                $email = sanitize($_POST["email"]);
                try {
                    $user = new User($username);
                    
                    if ($email == $user->getEmail()) {
                        $password = $_POST["newPassword"];
                        $conPassword = $_POST["conPassword"];
                        if ($password == $conPassword) {
                            $user->setPassword(encrypt($password));
                            echo "<div class='container text-center alert alert-success'><h4>Your password has been reset!</h4></div>";
                        } else {
                            echo '<div class="alert alert-danger">Passwords do not match.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">Username and Email do not match.</div>';
                    }
                }
                catch (Exception $e) {
                    echo '<div class="alert alert-danger">Username and Email do not match.</div>';
                }
                
            }
        ?>

        <mid>
            <div class="col-xs-6" id="Logform">    <!--  Allow adjacent divs login and the big note-->
                <div class="modal-dialog">
                    <div class="modal-content" id="padd" style="padding: 15px;"> <!--  adds boarders to the window!-->
                        <form action="resetPassword.php" method="POST">
                            <div class="modal-header"><h3>Reset your password</h3></div><br>
                            <div class="form-group">
                                <label for="username" class="control-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" value="" required=""  placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="" required=""  placeholder="Enter your email">
                            </div> 
                            <div class="form-group">
                                <label for="newPassword" class="control-label">New Password:</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" value="" required=""  placeholder="Enter a new password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword" class="control-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="conPassword" name="conPassword" value="" required="">
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <button type="submit" name="resetPassword" value="submit" class="btn btn-success">Reset Password</button>
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
