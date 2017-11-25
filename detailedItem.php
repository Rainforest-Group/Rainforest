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
          <input  id="pull" class="form-control input-lg" type="text" placeholder="Search">
          <button class="btn btn-info" type="submit" id="pull">Search</button>
        </form>
        <div class="row">
  <div class="col-md-4"> <button type="button" class="btn btn-success" id="login" onclick="Home();">Home</button></div>
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
  </header>



  <mid>
<!--  new item       !-->
<div class="col-md-9">
    <div class="card b-1 hover-shadow mb-20">
        <div class="media card-body">
            <div class="media-left pr-12">
                <img  src="http://panzer.me/wp-content/uploads/2017/11/389968_01-128x128.jpg">
            </div>
            <div class="media-body">
              <div class="mb-2" style="margin-left: 70px;">
                <h2>iPhone XXX</h2>
                <p>Description:  </p>
              </div>
            </div>
            <div class="media-right text-right d-none d-md-block"style="margin-right: 70px;"><h3>999$</h3></div>
            <div class="card-hover-show">
            <a class="btn btn-xs fs-10 btn-bold btn-block btn-info"  href="#">Add to Cart</a>
        </div>

    </div>
    <br>
</div>
</div>

<br><br>

<!--  new item       !-->
<div class="col-md-9">
    <div class="card b-1 hover-shadow mb-20">  <!-- card borders !-->
        <div class="media card-body">
            <div class="media-left pr-12">
                <img src="https://dtgxwmigmg3gc.cloudfront.net/files/5924d1c7777a423178007c33-icon-156x156.png">
            </div>
            <div class="media-body">
                <div class="mb-2" style="margin-left: 70px;">
                  <h2>Tomatoes</h2>
                  <p>Description:  </p>
                </div>
            </div>
            <div class="media-right text-right d-none d-md-block"style="margin-right: 70px;"><h3>16.00$/lb</h3></div>
            <div class="card-hover-show">
            <a class="btn btn-xs fs-10 btn-bold btn-block btn-info"  href="#">Add to Cart</a>
        </div>
    </div>
  </div>
</div>

<br><br>

  </mid>
      </body>
  </html>
