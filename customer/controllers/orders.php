<?php
include('../../include/session.php');
include('../../include/connection.php');
include('../../include/customerNavbar.php');
$_SESSION['activePage'] = 'orders';


//if customer not logged in -> route to home page
if (!isset($_SESSION['userLoggedIn'])) {
    header('location: /ITECA3-Project/index.php');
}

?>