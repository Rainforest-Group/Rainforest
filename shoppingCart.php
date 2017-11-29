<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shopping cart</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="register.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
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
                <button type="button" class="btn btn-success" id="login" onclick="Home();">Home</button>
            </nav>
        </header>
        <mid>
            <div class="container">
                <br>
                <h2>Your Shopping Cart</h2>
                <br>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tr>
                        <td><h4> Dell TV QHD+</h4></td>
                        <td>$1499.99</td>
                        <td>1</td>
                        <td >$1499.99</td>
                        <td><button class="btn btn-danger"> Delete</button></td>
                    </tr>
                    <tr>
                        <td><h4> iPhone X 1TB</h4></td>
                        <td>$1999.99</td>
                        <td>4</td>
                        <td >$7999.96</td>
                        <td><button class="btn btn-danger"> Delete</button></td>
                    </tr>
                    <tr>
                        <td><h4> Tires</h4></td>
                        <td>$199.99</td>
                        <td>1</td>
                        <td >199.99</td>
                        <td><button class="btn btn-danger"> Delete</button></td>
                    </tr>
                    <tr><td><button type="button" class="btn btn-info btn-lg btn-block "> Continue Shopping</button></td></tr>
                    <tr><td><button type="button" class="btn btn-success btn-lg btn-block">Proceed to Checkout</button></td></tr>
                </table>
            </div>
        </mid>
    </body>
</html>
