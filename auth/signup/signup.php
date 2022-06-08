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





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login!</title>
    <style>
        .pool-image {
            background-image: url('../../assets/pool.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body>
    <div class="bg-image pool-image">
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../signup/signup.php">SignUp</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container py-5 h-100">
            <form method="post" action="login.php" name="form">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-primary bg-gradient text-white" style="border-radius: 3rem;">
                            <div class="card-body p-5 text-center">

                                <div class="-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-4">Sign Up</h2>

                                    <div class="mb-4">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name="na,e" class="form-control form-control-lg" />
                                    </div>


                                    <div class="mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" class="form-control form-control-lg" />
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <input type="text" name="phoneNumber" class="form-control form-control-lg" />
                                    </div>


                                    <div class="mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" class="form-control form-control-lg" />
                                    </div>


                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="login">Sign Up</button>

                                </div>

                                <div>
                                    <p class="mb-0">Have an account? <a href="../login/login.php" class="text-black fw-bold">Login</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </div>
</body>

</html>




<!-- <!DOCTYPE html>
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

</html> -->