<?php
include('session.php');
include('connection.php');


// class representing a single product item in the cart
class CartItem
{
    // Properties
    public $id;
    public $name;
    public $price;
    public $quantity;
    public $description;
    public $imageUrl;
    public $size;

    function __construct($id, $name, $price, $quantity, $imageUrl, $size)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->imageUrl = $imageUrl;
        $this->size = $size;
    }
}


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

//login modal submit button
if (isset($_POST['login'])) {

    //get user data from fields
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    //fetches existing userdata if exists
    $fetchUserDataQuery = "SELECT * FROM users WHERE '$email'= email AND '$password' = password LIMIT 1";

    $queryResults =  mysqli_query($conn, $fetchUserDataQuery);

    //if query was a success
    if ($queryResults) {
        if (mysqli_num_rows($queryResults) > 0) {
            //data returned with query -> valid user details
            $row = mysqli_fetch_assoc($queryResults);

            //set session variables for required user details
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['userPhoneNumber'] = $row['phoneNumber'];
            $_SESSION['userIsAdmin'] = $row['isAdmin'];



            if ($row['isAdmin'] == 1) {
                //if admin (1) -> isAdmin = true
                //route to admin home page
                $_SESSION['adminLoggedIn'] = True;
                header("Location: ../../admin/home/adminHome.php");
            } else {
                //if normal user (0) -> isAdmin = false
                //route to user home page
                $_SESSION['userLoggedIn'] = True;
                header("Location: /ITECA3-Project/index.php");
            }
        } else {
            //invalid user details, nothing returned
            echo "<p style='chaolor:red'>Invalid User Details</p>";
        }
    } else {
        echo 'Error logging in , server side problem';
    }
}

//signup modal submit button
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //query for checking if email already exists
    $checkForExistingUserQuery = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

    //query the db
    $queryResults =  mysqli_query($conn, $checkForExistingUserQuery);
    $userData = mysqli_fetch_assoc($queryResults);

    //if userData doenst have a value (no existing user)
    if (!$userData) {

        //create insert query
        //signup is for normal user 
        // -> isAdmin = FALSE
        $insertUserQuery = "INSERT INTO users (name,email,password,phoneNumber,isAdmin) 
        VALUES ('$name','$email','$password','$phoneNumber',FALSE)";

        //execute insert query
        try {
            //run the insert query
            mysqli_query($conn, $insertUserQuery);
            echo "<p style='color:green'>User Created Successfully</p>";

            //set session variables for required user details
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['userPhoneNumber'] = $row['phoneNumber'];


            $_SESSION['userLoggedIn'] = True;
            header("Location: /ITECA3-Project/index.php");


            echo 'created!';
        } catch (Exception $e) {
            echo "<p style='color:red'>Error Creating User</p>";
        }
    } else {
        echo 'email already exists';
    }
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


if (isset($_POST['clearCart'])) {
    //retrieve existing cart data

    $_SESSION['cart'] = serialize([]);
    header("Location: /ITECA3-Project/customer/cart.php");
}


if (isset($_POST['checkoutCart'])) {
    //retrieve existing cart data
    $cart = unserialize($_SESSION['cart']);

    $_SESSION['cart'] = serialize($cart);

    echo "Test";

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
        header("Location : login.php");
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
        header("Location: /ITECA3-Project/customer/orders.php");
    }
}
