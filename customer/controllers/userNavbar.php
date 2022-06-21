<?php
include('session.php');
include('server.php');

//login form submitted
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>
