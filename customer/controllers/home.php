<?php
include('../models/cartItem.php');
include('../../include/connection.php');
include('../../include/customerNavbar.php');
$_SESSION['activePage'] = 'home';
$cart = unserialize($_SESSION['cart']);

//productModal submit button 
if (isset($_POST['addToCart'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageUrl = $_POST['imageUrl'];
    $size = $_POST['size'];


    //retrieve existing cart data
    $cart = unserialize($_SESSION['cart']);

    //reset
    $matchFound = false;

    // checks for matching item in existing cart
    // matching item = (same id & same size ) already in cart
    for ($i = 0; $i < count($cart); $i++) {
        //if it finds a matching cartItem 
        // echo 'id = ',gettype($cart[$i]) . "<br>";

        if (($cart[$i]->id == $id) && ($cart[$i]->size == $size)) {
            $matchFound = true;
            echo "found match";
            //increase quantity by 1
            $cart[$i]->quantity += 1;
            //end looping
            break;
        }
    }

    //if no matching item was found in cart , add new product to cart
    if (!$matchFound) {
        //create new cart item
        $newCartItem = new CartItem($id, $name, $price, 1, $imageUrl, $size);
        //add new item to cart variable
        $cart[] = $newCartItem;
        //update session cart variable with new cart data

    }
    //override old session['cart'] details with new details
    $_SESSION['cart'] = serialize($cart);

    //reload and route to the index page
    header("Location: /ITECA3-Project/index.php");
}
