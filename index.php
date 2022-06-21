<?php
include('session.php');
$_SESSION['activePage'] = 'index';


// if admin not logged in -> route to login
if (isset($_SESSION['adminLoggedIn'])) {
    header('location: /ITECA3-Project/admin/users.php');
}else{
    header('location: /ITECA3-Project/customer/view/home.php');
}
?>
