<?php
include('../../include/connection.php');
include('../../include/customerNavbar.php');


//cleans the submitted form data
function cleanData($formData)
{
    //remove whitespace
    $cleanedData = trim($formData);
    //removes raw html tags
    $cleanedData = htmlspecialchars($cleanedData);
    //remove any back slashes
    $cleanedData = stripslashes($cleanedData);
    return $cleanedData;
}

//uses regex to check if string contains a number
function containsNumber($value)
{
    if (preg_match("~[0-9]+~", $value)) {
        return TRUE;
    }
    return FALSE;
}

function validation()
{
    //email validation
    $name = cleanData($_POST["name"]);
    $email = cleanData($_POST["email"]);
    $phoneNumber = cleanData($_POST["phoneNumber"]);
    $password = cleanData($_POST['password']);

    //changes to false if errors found
    $checksPassed = true;

    //name validaiton
    if (containsNumber($name) || empty($name)) {
        $checksPassed = false;
    }

    //email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $checksPassed = false;
    }

    //phoneNumber validation
    if (!containsNumber($phoneNumber) || empty($phoneNumber)) {
        $checksPassed = false;
    }

    //password validation
    if (empty($password)) {
        $checksPassed = false;
    }

    return $checksPassed;
}


//Sign up form submitted
if (isset($_POST['signUp'])) {

    $checksPassed = validation();

    //if al checks passed (true)
    if ($checksPassed) {

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

                $userId = mysqli_insert_id($conn);
                //set session variables for required user details
                $_SESSION['userId'] = $userId;
                $_SESSION['userName'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['userPhoneNumber'] = $row['phoneNumber'];

                $_SESSION['userLoggedIn'] = True;

                //checks if the user was in the process of checking out , before sigining in
                if (isset($_SESSION['userTryingToCheckout'])) {
                    header('Location: /ITECA3-Project/customer/views/checkout.php');
                } else {
                    header("Location: /ITECA3-Project/index.php");
                }
            } catch (Exception $e) {
                echo "<p style='color:red'>Error Creating User</p>";
            }
        } else {
            echo 'email already exists';
        }
    }
}
