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
