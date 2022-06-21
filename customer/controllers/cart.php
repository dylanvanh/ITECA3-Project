<?php
include('../models/cartItem.php');
include('../../include/connection.php');
include('../../include/customerNavbar.php');
$_SESSION['activePage'] = 'cart';

$cart = unserialize($_SESSION['cart']);

$fixedOperationsCost = 25;

//initial subTotal value
$subTotal = 0;

//initial total value
$total = 0;

if (isset($_POST['clearCart'])) {
    //retrieve existing cart data

    $_SESSION['cart'] = serialize([]);
    header("Location: /ITECA3-Project/customer/views/cart.php");
}


if (isset($_POST['checkoutCart'])) {
    //retrieve existing cart data
    $cart = unserialize($_SESSION['cart']);

    $_SESSION['cart'] = serialize($cart);

    //user is logged in
    if ($_SESSION['userLoggedIn'] == True) {

        //check that the cart is not empty
        if (count($cart) > 0) {
            //route to checkout page
            header("Location: checkout.php");
        } else {
            header("Location: /ITECA3-Project/index.php");
        }
    } else {
        header("Location : ../../auth/views/login.php");
    }
}


if (isset($_POST['deleteCartItem'])) {

    //required id of the item to be deleted
    $id = $_POST['id'];


    //retrieve existing cart data
    $cart = unserialize($_SESSION['cart']);

    //set the quantity to the new value
    for ($i = 0; $i < count($cart); $i++) {
        //check if the id provided in cart matches the id provided in the form
        if ($cart[$i]->id == $id) {
            //remove cartItem object from cart array
            unset($cart[$i]);
        }
    }

    $_SESSION['cart'] = serialize($cart);
}


//when the user clicks the update cart button
if (isset($_POST['updateCartItemQuantity'])) {

    //need id of item to update
    //need quantity to update
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // echo $id;
    // echo "<br>";
    // echo $quantity;

    //retrieve existing cart data
    $cart = unserialize($_SESSION['cart']);

    //set the quantity to the new value
    for ($i = 0; $i < count($cart); $i++) {
        //check if the id provided in cart matches the id provided in the form
        if ($cart[$i]->id == $id) {
            //set the quantity to the new value
            $cart[$i]->quantity = $quantity;
            //end looping
            break;
        }
    }

    $_SESSION['cart'] = serialize($cart);
}
