<?php

include('session.php');
$_SESSION['activePage'] = 'home';
include('userNavbar.php');
$cart = unserialize($_SESSION['cart']);
