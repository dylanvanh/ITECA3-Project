<?php
include('../controllers/userNavbar.php');
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand " href="/ITECA3-Project/index.php">QuickSilver Swimming</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <!-- 
                            if index page is displaying
                            show the navItem as active
                        -->
                        <?php if ($_SESSION['activePage'] == 'index') { ?>
                            <!-- Page active -->
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <?php } else { ?>
                            <!-- Page not active -->
                            <a class="nav-link" aria-current="page" href="/ITECA3-Project/index.php">Home</a>
                        <?php } ?>
                    </li>
                    <!-- Only shows order navItem , if the user is logged in and  -->
                    <?php if (!empty($_SESSION['userLoggedIn'])) : ?>
                        <li class="nav-item">
                            <?php if ($_SESSION['activePage'] == 'orders') { ?>
                                <!-- Page active -->
                                <a class="nav-link active" aria-current="page" href="#">Orders</a>
                            <?php } else { ?>
                                <!-- Page not active -->
                                <a class="nav-link" aria-current="page" href="/ITECA3-Project/customer/orders.php">Orders</a>
                            <?php } ?>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <?php if ($_SESSION['activePage'] == 'about') { ?>
                            <!-- Page active -->
                            <a class="nav-link active" aria-current="page" href="#">About</a>
                        <?php } else { ?>
                            <!-- Page not active -->
                            <a class="nav-link" aria-current="page" href="/ITECA3-Project/about.php">About</a>
                        <?php } ?>
                    </li>
                </ul>

                <div class="d-flex px-5">
                    <?php if (empty($_SESSION['userLoggedIn'])) : ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item px-3">
                                <a class="btn btn-primary" href="/ITECA3-Project/auth/login/login.php">Login</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['userLoggedIn'])) : ?>
                        <form action="/ITECA3-Project/home.php" method="post" name="form">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item px-3">
                                    <button class="btn btn-outline-danger" type="submit" name="logout">
                                        <i class="bi bi-box-arrow-left"></i>
                                        Logout
                                    </button>
                                </li>
                            </ul>
                        </form>
                    <?php endif; ?>
                    <a href="/ITECA3-Project/customer/cart.php">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="bi-cart-fill"></i>
                            Cart
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

</body>

</html>