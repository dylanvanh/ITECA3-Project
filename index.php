<?php
include('server.php');


//login form submitted
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}
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
    <div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php" name="form">
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Create Account</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand " href="#">QuickSilver Swimming</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer/orders/orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer/about/about.php">About</a>
                    </li>
                </ul>

                <div class="d-flex px-5">
                    <?php if (empty($_SESSION['userLoggedIn'])) : ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item px-3">
                                <button type="button" class="nav-link btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" data-bs-whatever="@mdo">Login</button>
                                <!-- <a class="nav-link" aria-current="page" href="./auth/login/login.php">Login</a> -->
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['userLoggedIn'])) : ?>
                        <form action="index.php" method="post" name="form">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item px-3">
                                    <button class="nav-link btn btn-outline-danger" type="submit" name="logout">Logout</button>
                                </li>
                            </ul>
                        </form>
                    <?php endif; ?>
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi-cart-fill"></i>
                        Cart
                    </button>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>