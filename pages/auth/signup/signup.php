<?php

include('../../connection.php');


//Sign up form submitted
if (isset($_POST['signUp'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //query for checking if email already exists
    $checkForExistingUserQuery = "SELECT * FROM user WHERE email = '$email' LIMIT 1";

    //query the db
    $queryResults =  mysqli_query($conn, $checkForExistingUserQuery);
    $userData = mysqli_fetch_assoc($queryResults);

    //if userData doenst have a value (no existing user)
    if (!$userData) {

        //create insert query
        //signup is for normal user 
        // -> isAdmin = FALSE
        $insertUserQuery = "INSERT INTO user (name,email,password,phoneNumber,isAdmin) 
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
            header("Location: ../../user/home/userHome.php");


            echo 'created!';

        } catch (Exception $e) {
            echo "<p style='color:red'>Error Creating User</p>";
        }
    } else {
        echo 'email already exists';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Create Account<h1>
            <form method="post" action="signup.php">
                <label for="name">Name -</label>
                <input type="text" name="name" required>
                <br>
                <label for="email">Email -</label>
                <input type="text" name="email" required>
                <br>
                <label for="phoneNumber">Phone Number -</label>
                <input type="text" name="phoneNumber" required>
                <br>
                <label for="password">Password -</label>
                <input type="text" name="password" required>
                <br>
                <button type="subit" name="signUp">Submit</button>
                <br>
                <p>Have an account?<a href="login.php">Login</a></p>
            </form>
</body>

</html>