<?php
include('../models/cartItem.php');
include('../../include/session.php');
include('../../include/connection.php');
$_SESSION['activePage'] = 'checkout';


//user trying to checkout
$_SESSION['userTryingToCheckout'] = True;

//if user not logged in yet
//reroute to login page
if (!isset($_SESSION['userLoggedIn'])) {
    header('location: /ITECA3-Project/auth/views/login.php');
} else {
    include('../../include/customerNavbar.php');

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


//create order based on location specified for the user
if (isset($_POST['placeOrder'])) {
    //retrieve existing cart data
    $cart = unserialize($_SESSION['cart']);

    if ($_SESSION['userLoggedIn'] == True) {

        $location = $_POST['location'];
        $totalCost = $_POST['totalCost'];


        //retrieve userId
        $userId = $_SESSION['userId'];


        //create the order
        $orderInsertQuery = "INSERT INTO Orders (userId, deliveryLocation,totalCost)
            VALUES ('$userId','$location','$totalCost')";

        if (mysqli_query($conn, $orderInsertQuery)) {
            //id of the newly created created order field
            $orderId = mysqli_insert_id($conn);
            echo "New record created successfully. Last inserted ID is: " . $orderId;
        } else {
            echo "Error: " . $orderInsertQuery . "<br>" . mysqli_error($conn);
        }

        //create the order items
        $orderItemInsertQuery = "INSERT INTO OrderItems (userId, deliveryLocation,totalCost)
                VALUES ('$userId','$location','$totalCost')";

        for ($i = 0; $i < count($cart); $i++) {
            //create the order items
            //orderId , productId , quantity, size

            $productId = $cart[$i]->id;
            $quantity = $cart[$i]->quantity;
            $size = $cart[$i]->size;
            $cost = $cart[$i]->price * $quantity;

            $orderItemInsertQuery = "INSERT INTO OrderItems (orderId, productId,quantity,size,cost)
            VALUES ('$orderId','$productId','$quantity','$size','$cost')";

            //execute sql statement
            mysqli_query($conn, $orderItemInsertQuery);
        }

        //clear cart after order is placed
        $_SESSION['cart'] = serialize([]);
        //route to orders page
        header("Location: /ITECA3-Project/customer/views/orders.php");
    }
}
