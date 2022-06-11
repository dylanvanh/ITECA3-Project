<?php

session_start();

// //if user not logged in -> route to login
// if (!isset($_SESSION['userLoggedIn'])) {
//     header('location: ../../login/login.php');
// }
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <title>Home</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand">QuickSilver Swimming</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../about/about.php">About</a></li>
                </ul>
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill"></i>
                    <a href="../cart/cart.php">Cart</a>
                </button>
            </div>
        </div>
    </nav>


    <div class="shop-items">
        <div class="card" style="width: 18rem;">
            <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">R400</h5>
                <p class="card-text">Product name</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>


    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Created by Dylan van Heerden</p>
        </div>
    </footer>
</body>

</html>