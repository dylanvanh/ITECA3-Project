<?php

include('../session.php');


//user trying to checkout
$_SESSION['userTryingToCheckout'] = True;

//if user not logged in yet
//reroute to login page
if (!isset($_SESSION['userLoggedIn'])) {
    header('location: /ITECA3-Project/auth/login/login.php');
} else {
    include('../userNavbar.php');

    $cart = unserialize($_SESSION['cart']);

    $_SESSION['activePage'] = 'checkout';

    $fixedOperationsCost = 25;

    //initial subTotal value
    $subTotal = 0;

    //initial total value
    $total = 0;

    //calculate subTotal of items
    for ($i = 0; $i < count($cart); $i++) {
        $subTotal += $cart[$i]->price * $cart[$i]->quantity;
    }
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
    <title>Checkout Page</title>
</head>

<body>

    <h1>Checkout screen</h1>


    <form method="post" name="placeOrderForm" action="cart.php" class="container">
        <div class="container">
            <?php
            //calculate total
            if ($subTotal != 0) {
                $total = $subTotal + $fixedOperationsCost;
            }
            ?>
            <h3>Subtotal : R<?php echo $subTotal ?>
                <h3>Operations Cost : R30</h3>
                <h3>Total : R<?php echo $total ?>
                    <div class="location-container">
                        <label for="location">Collection Location :</label>
                        <select name="location" id="location">
                            <option value="Durbanville">Durbanville</option>
                            <option value="Tygervalley">Tygervalley</option>
                            <option value="Milnerton">Milnerton</option>
                        </select>
                    </div>
                    <button type="submit" name="placeOrder">Confirm Order</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>