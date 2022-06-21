<?php
include('../session.php');
include('../server.php');


// if admin not logged in -> route to login
if (!isset($_SESSION['adminLoggedIn'])) {
    header('location: /ITECA3-Project/index.php');
}


//logout button (form) clicked
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /ITECA3-Project/index.php");
}
