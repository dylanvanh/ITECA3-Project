<?php
include('../userNavbar.php');
$_SESSION['activePage'] = 'orders';


//if customer not logged in -> route to home page
if (!isset($_SESSION['userLoggedIn'])) {
    header('location: /ITECA3-Project/index.php');
}
?>