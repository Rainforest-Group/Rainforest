<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/register.css">
        <link rel="stylesheet" href="static/css/design.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function logIn(){  window.location='login.php';  }
            function Home(){  window.location='main.html';  }
        </script>
        <script type="text/javascript">
            function shop(){  window.location='inventory.php';  }
            function logOut() { window.location='logout.php'; }
        </script>
    </head>
    <body>
        <?php
            require_once("controllers/registerController.php");
            $errors = "";
        ?>
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
                </ul>
            </nav>
        </header>
        <mid>
            <div class="col-xs-6" id="Logform">    <!--  Allow adjacent divs login and the big note-->
                <div class="modal-dialog">
                    <div class="modal-content" id="padd"> <!--  adds boarders to the window!-->
                        <div class="modal-header"><h3>Registration</h3></div>
                        <?php 
                            require_once("controllers/registerController.php");
                            if (isset($_POST["createProfile"])) {
                                $username = $_POST["username"];
                                $password = $_POST["password"];
                                $verify_password = $_POST["verify_password"];
                                $address  = $_POST["address"];
                                $state    = $_POST["state"];
                                $city     = $_POST["city"];
                                $zip      = $_POST["zip"];
                                $errors   = validateProfile($username, $password, $verify_password, $address, $state, $city, $zip);

                                if ($errors) {
                                    echo '<div class="alert alert-danger">';
                                    echo $errors; 
                                    echo '</div>';
                                }
                                else {
                                    $success = createAccount($username, $password, $address, $state, $city, $zip);
                                    if (!$success) {
                                        echo '<div class="alert alert-danger">';
                                        echo 'The server encountered an issue creating your account.';
                                        echo '</div>';
                                    }
                                    else {
                                        // Redirect to login page
                                        header("Location: login.php?username=$username");
                                        die();
                                    }
                                }
                            }
                        ?>
                        <form method="POST" action="register.php">
                            <div class="form-group">
                                <!--
                                <label for="username" class="control-label">First Name</label>
                                <input type="text" class="form-control" id="lastname" name="firstname" value="" required="" placeholder="First name">
                                <label for="username" class="control-label">Last name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="" required=""  placeholder="Last name">
                                -->
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="" required=""  placeholder="your username">

                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="" required=""  placeholder="your password">
                                <label for="password" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control" id="verify_password" name="verify_password" value="" required=""  placeholder="Confirm password">

                                <label for="address" class="control-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required="" />

                                <label for="city" class="control-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required="" />

                                <label for="state" class="control-label">State</label>
                                <input type="text" class="form-control" id="state" name="state" required="" />
    
                                <label for="zip" class="control-label">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" required="" />
                            </div>
                            <button type="submit" name="createProfile" value="submit" class="btn btn-success">Sign up</button>
                        </form>
                        </div>
                    </div>
                </div>
            </mid>
        </div><!-- end .container -->
    </body>
</html>
