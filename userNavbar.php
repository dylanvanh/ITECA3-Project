<!DOCTYPE html>
<?php
include('session.php');
include('server.php');

//login form submitted
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php" name="loginForm">
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
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-whatever="@mdo">Create Account</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Create Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php" name="signupForm">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="name" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="col-form-label">Phone Number:</label>
                            <input type="text" class="form-control" name="phoneNumber">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-whatever="@mdo">Login</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="signup" class="btn btn-primary">Signup</button>
                </div>
                </form>
            </div>
        </div>
    </div>


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
                                <a class="nav-link" aria-current="page" href="/ITECA3-Project/customer/orders/orders.php">Orders</a>
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
                                <button type="button" class="nav-link btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-whatever="@mdo">Login</button>
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
                    <form action="index.php" method="post" name="form">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item px-3">
                                <button class="nav-link btn btn-outline-danger" type="submit" name="logout">Clear data</button>
                            </li>
                        </ul>
                    </form>
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