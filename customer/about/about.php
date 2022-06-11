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
        <div class="container-fluid">
            <a class="navbar-brand " href="#">QuickSilver Swimming</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer/orders/orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">About</a>
                    </li>
                </ul>

                <div class="d-flex px-5">
                    <?php if (empty($_SESSION['userLoggedIn'])) : ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item px-3">
                                <a class="nav-link" aria-current="page" href="./auth/login/login.php">Login</a>
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

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Created by Dylan van Heerden</p>
        </div>
    </footer>
</body>

</html>