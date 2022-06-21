<?php
include('./include/session.php');
$_SESSION['activePage'] = 'index';

//checks if cart exists
if (!isset($_SESSION['cart'])) {
    //cart doesnt exist

    //create empty cart 
    $cart = [];

    //override old session cart details with new cart details
    $_SESSION['cart'] = serialize($cart);
}

// if admin not logged in -> route to login
if (isset($_SESSION['adminLoggedIn'])) {
    header('location: /ITECA3-Project/admin/views/users.php');
}else{
    header('location: /ITECA3-Project/customer/views/home.php');
}
?>
