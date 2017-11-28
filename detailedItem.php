<!DOCTYPE html>
<html lang="en">
<head>
  <title>Detailed Item</title>
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

        <form class="form-inline" method="get" action="inventory.php">
            <input class="form-control input-lg" type="text" placeholder="Search" name="q">
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
          <h4 class="display-3" >I Phone X</h4>
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
                <img style="padding:50px;" src="https://cdn.macrumors.com/article-new/2017/09/iphonexfrontback-800x573.jpg">
            </div>
    </div>

</div>
</div>

<br><br>

        <!--  the lower discription box  !-->
          <div class="card card-body">
              <!--   Titles  !-->
                    <h3 class="card-title">Description:<small  style="margin-left:1050px;">Price:</small><small class="card-title" style="margin-left:30px;">999$</small></h3>

                    <!--   the quantity box  !-->
                <p class="card-text">Please buy this iphone to prove that you are a big Apple fan.</p>
                <div class="form-group row"><div class="col-xs-2">
                  <input class="form-control"  min="1" max="5" style="margin:20px" id="ex1" type="number">
                </div></div>

                <!--   Button !-->
                <a href="#" class="btn btn-info btn-lg btn-block ">Add to Cart</a>
          </div>

  </mid>
      </body>
  </html>
