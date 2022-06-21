<?php
include('../session.php');
include('../server.php');


// if admin not logged in -> route to login
if (!isset($_SESSION['adminLoggedIn'])) {
    header('location: /ITECA3-Project/index.php');
}


//logout button (form) clicked
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /ITECA3-Project/index.php");
}
?>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand " href="users.php">QuickSilver Swimming</a>
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
                        <?php if ($_SESSION['activePage'] == 'users') { ?>
                            <!-- Page active -->
                            <a class="nav-link active" aria-current="page" href="#">Users</a>
                        <?php } else { ?>
                            <!-- Page not active -->
                            <a class="nav-link" aria-current="page" href="users.php">Users</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <?php if ($_SESSION['activePage'] == 'products') { ?>
                            <!-- Page active -->
                            <a class="nav-link active" aria-current="page" href="#">Products</a>
                        <?php } else { ?>
                            <!-- Page not active -->
                            <a class="nav-link" aria-current="page" href="products.php">Products</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <?php if ($_SESSION['activePage'] == 'orders') { ?>
                            <!-- Page active -->
                            <a class="nav-link active" aria-current="page" href="#">Orders</a>
                        <?php } else { ?>
                            <!-- Page not active -->
                            <a class="nav-link" aria-current="page" href="orders.php">Orders</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <?php if ($_SESSION['activePage'] == 'bulk') { ?>
                            <!-- Page active -->
                            <a class="nav-link active" aria-current="page" href="#">Bulk</a>
                        <?php } else { ?>
                            <!-- Page not active -->
                            <a class="nav-link" aria-current="page" href="bulk.php">Bulk</a>
                        <?php } ?>
                    </li>
                </ul>
                <div class="d-flex px-5">
                    <?php if (!empty($_SESSION['adminLoggedIn'])) : ?>
                        <form action="/ITECA3-Project/index.php" method="post" name="form">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item px-3">
                                    <button class="nav-link btn btn-outline-danger" type="submit" name="logout">Logout</button>
                                </li>
                            </ul>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

</body>

</html>