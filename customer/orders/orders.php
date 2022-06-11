<?php

session_start();

//if user not logged in -> route to shop age 
if (!isset($_SESSION['userLoggedIn'])) {
    header('location: ../../shop/shop.php');
}else{
    //fetch customer order data from the database
}
?>





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Orders</title>
</head>

<body>
    <h1>Orders</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand">QuickSilver Swimming</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../shop/shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="../about/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../about/about.php">Order</a></li>
                </ul>
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill">
                        << /i>
                            <a href="#">Cart</a>
                </button>
            </div>
        </div>
    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>