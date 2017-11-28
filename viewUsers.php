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
    echo '<div class="card-hover-show"><button type="submit" name="user" value="'.$name.'" class="btn btn-xs fs-10 btn-bold btn-block btn-info">'.$button.'</a></div>';
    echo '</div></div></div>';
    echo '<br>';
}
?>
  </mid>
      </body>
  </html>
