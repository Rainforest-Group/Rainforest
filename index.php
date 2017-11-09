<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/design.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script>
  $(function () {
      $('[data-toggle="tooltip"]').tooltip();
  });
  </script>
</head>
<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <!-- Brand/logo -->
      <a class="navbar-brand" href="#">
        <img src="bird.jpg" alt="logo" style="width:40px;">
      </a>

      <!-- Links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">New Arrivals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Clearance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="lastlink">About us</a>
        </li>
      </ul>
        <!--Search form -->
        <form class="form-inline" >
          <input class="form-control input-lg" type="text" placeholder="Search">
          <button class="btn btn-info" type="submit" id="pull">Search</button>
        </form>
              <!-- buttons -->
        <button type="button" class="btn btn-success">Log In</button>
        <button type="button" class="btn btn-success">Create an Account</button>

    </nav>
    <div class="jumbotron jumbotron-billboard text-black text-center">
    <div class="img"></div>
      <div class="container">
          <h1 class="display-1">   Welcome to Rainforest</h1>
          <p class="lead">Shop confidently...</p>
      </div>
     </div>

        <!-- navs -->
    <div class="container text-muted">
        <h2 class="display-4 py-5 mt-5 text-center">What do you need today ...</h2>

        <nav class="nav justify-content-center nav-pills flex-column flex-md-row">
            <a class="nav-link active" href="#elec" data-toggle="tab">Electronics</a>
            <a class="nav-link" href="#" data-toggle="tab">Furniture</a>
            <a class="nav-link" href="#" data-toggle="tab">Outdoors</a>
            <a class="nav-link" href="#" data-toggle="tab">School stuff</a>
        </nav>

        <div class="tab-content py-5">
            <div class="tab-pane active" >
          
            </div>
            <div class="tab-pane fade" >
            </div>
            <div class="tab-pane fade">
            </div>
            <div class="tab-pane fade">
            </div>
        </div>

    </div><!-- end .container -->
      </body>
  </html>