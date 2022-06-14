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
    public $image;
    public $size;

    function __construct($id, $name, $price, $quantity, $image, $size)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->size = $size;
    }
}

//id,name,price,quantity,image,size
$cartItem = new CartItem(1, 'test', 123, 1, '/ITECA3-Project/assets/fins.jpg', 's');
$cartItem2 = new CartItem(2, 'test2', 321, 1, '/ITECA3-Project/assets/shorts.jpg', 'm');
$cartItem3 = new CartItem(1, 'test', 123, 1, '/ITECA3-Project/assets/fins.jpg', 's');



//checks if cart exists
if (isset($_SESSION['cart'])) {
    //session cart variable already exists

    //check if already in cart etc..
    echo "cart already exists!";


    //checks for matching item in existing cart
    //matching item = same id , same size    $matchFound = false;
    // for ($i = 0; $i < count($cart); $i++) {
    //     echo $cart[$i]->id;
    //     echo "<br>";
    //     echo $cart[$i]->name;
    //     echo "<br>";
    //     echo $cart[$i]->price;
    //     echo "<br>";
    //     echo $cart[$i]->quantity;
    //     echo "<br>";
    //     echo $cart[$i]->image;
    //     echo "<br>";
    //     echo $cart[$i]->size;
    //     echo "<br>";

    //     //if it finds the cart , break out of the loop
    //     if (($cart[$i]->id == $cartItem->id) && ($cart[$i]->size == $cartItem->size)) {
    //         echo "found match";
    //         //increase quantity by 1
    //         $cart[$i]->quantity += 1;
    //         $matchFound = true;
    //         break;
    //     }
    // }

    // //if no matching item was found in cart , add product to cart
    // if (!$matchFound) {
    //     $cart[] = $cartItem3;
    // }

    // //override old session cart details with new cart details
    // $_SESSION['cart'] = serialize($cart);
} else {
    //session cart variable doesnt exist

    //create empty cart 
    $cart = [];

    //dummy data added to cart
    $cart[] = $cartItem;
    $cart[] = $cartItem2;

    //override old session cart details with new cart details
    $_SESSION['cart'] = serialize($cart);

    //checks for matching item
    //matching item = same id , same size
    // $matchFound = false;
    // for ($i = 0; $i < count($cart); $i++) {
    //     echo $cart[$i]->id;
    //     echo "<br>";
    //     echo $cart[$i]->name;
    //     echo "<br>";
    //     echo $cart[$i]->price;
    //     echo "<br>";
    //     echo $cart[$i]->quantity;
    //     echo "<br>";
    //     echo $cart[$i]->image;
    //     echo "<br>";
    //     echo $cart[$i]->size;
    //     echo "<br>";

    //     //if it finds the cart , break out of the loop
    //     if (($cart[$i]->id == $cartItem->id) && ($cart[$i]->size == $cartItem->size)) {
    //         echo "found match";
    //         //increase quantity by 1
    //         $cart[$i]->quantity += 1;
    //         $matchFound = true;
    //         break;
    //     }
    // }

    //if no matching item was found in cart , add product to cart
    // if (!$matchFound) {
    //     $cart[] = $cartItem3;
    // }


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
                header("Location: index.php");
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
            header("Location: index.php");


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

    // $_SESSION['count'] = 1;

    // //get user data from fields
    // // $email = mysqli_real_escape_string($conn, $_POST['email']);
    // // $password = mysqli_real_escape_string($conn, $_POST['password']);


    $size = $_POST['size'];

    $productId = $_SESSION['lastProductId'];
    $productName = $_SESSION['lastProductName'];
    $productPrice = $_SESSION['lastProductPrice'];
    $productImageUrl = $_SESSION['lastProductImageUrl'];
    $productDescription = $_SESSION['lastProductDescription'];



    $newCartItem = new CartItem($productId, $productName, $productPrice, 1, $productImageUrl, $size);

    //retrieve existing cart data
    $cart = unserialize($_SESSION['cart']);
    //add new item to existing cart data
    $cart[] = $newCartItem;

    //update session variable with new cart data
    $_SESSION['cart'] = serialize($cart);


    // // checks for matching item in existing cart
    // // matching item = same id , same size $matchFound = false;
    // for ($i = 0; $i < count($cart); $i++) {
    //     echo $cart[$i]->id;
    //     echo "<br>";
    //     echo $cart[$i]->name;
    //     echo "<br>";
    //     echo $cart[$i]->price;
    //     echo "<br>";
    //     echo $cart[$i]->quantity;
    //     echo "<br>";
    //     echo $cart[$i]->image;
    //     echo "<br>";
    //     echo $cart[$i]->size;
    //     echo "<br>";

    //     //if it finds the cart , break out of the loop
    //     if (($cart[$i]->id == $cartItem->id) && ($cart[$i]->size == $cartItem->size)) {
    //         echo "found match";
    //         //increase quantity by 1
    //         $cart[$i]->quantity += 1;
    //         $matchFound = true;
    //         break;
    //     }
    // }

    // //if no matching item was found in cart , add product to cart
    // if (!$matchFound) {
    //     $cart[] = $cartItem3;
    // }

    //override old session cart details with new cart details
}
