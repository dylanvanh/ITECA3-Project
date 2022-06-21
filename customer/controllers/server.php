<?php

include('session.php');
include('connection.php');
include('models/cartitem.php');

//checks if cart exists
if (!isset($_SESSION['cart'])) {
    //cart doesnt exist

    //create empty cart 
    $cart = [];

    //override old session cart details with new cart details
    $_SESSION['cart'] = serialize($cart);
}


//validate data function
function validateData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

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
        header("Location: /ITECA3-Project/customer/orders.php");
    }
}


//ADMIN OPTIONS
if (isset($_POST['toggleProductVisibility'])) {

    //required id of the item to be deleted
    $id = $_POST['id'];

    //check what the existing visibility is for the product
    $productVisibilityQuery = "SELECT visible FROM Products WHERE id = '$id'";
    $productsVisibilityResults = mysqli_query($conn, $productVisibilityQuery);
    $productVisibilityData = mysqli_fetch_array($productsVisibilityResults);

    $visibility =  $productVisibilityData['visible'];

    // $updatedVisibility = "";

    //if product already visibible
    if ($visibility == '1') {
        //change to hidden (false)
        $updateProductVisibilityQuery = "UPDATE Products SET visible = FALSE WHERE id = '$id'  ";
    } else {
        //change to visible (true)
        $updateProductVisibilityQuery = "UPDATE Products SET visible = TRUE  WHERE id = '$id'";
    }

    (mysqli_query($conn, $updateProductVisibilityQuery));
}
