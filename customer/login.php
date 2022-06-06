<?php
include('connection.php');

//login form submitted
if (isset($_POST['login'])) {

    //get user data from fields
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    //fetches existing userdata if exists
    $fetchUserDataQuery = "SELECT * FROM user WHERE '$email'= email AND '$password' = password LIMIT 1";

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
                header("Location: adminHome.php");
            } else {
                //if normal user (0) -> isAdmin = false
                //route to user home page
                $_SESSION['userLoggedIn'] = True;
                header("Location: userHome.php");
            }
        } else {
            //invalid user details, nothing returned
            echo "<p style='color:red'>Invalid User Details</p>";
        }
    } else {
        echo 'Error loggin in , server side problem';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>

<body>
    <h1>Login<h1>
            <form method="post" action="login.php">
                <label for="email">Email -</label>
                <input type="email" name="email" required>
                <br>
                <label for="password">Password -</label>
                <input type="password" name="password" required>
                <br>
                <button type="submit" name="login">Submit</button>
                <br>
                <p>Don't have an account?<a href="signup.php">Sign up</a></p>
            </form>
</body>

</html>