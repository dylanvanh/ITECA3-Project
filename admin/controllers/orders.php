<?php
include('../../include/session.php');
include('../../include/connection.php');
$_SESSION['activePage'] = 'orders';
include('../../include/adminNavbar.php');

if (isset($_POST['completeOrder'])) {
    $id = $_POST['id'];

    //create the order
    $completeOrderQuery = "UPDATE orders SET completed = TRUE WHERE id = '$id' ";

    if (mysqli_query($conn, $completeOrderQuery)) {
        $orderId = mysqli_insert_id($conn);
        echo "Order completed successfully.";
    } else {
        echo "Error: " . $completeOrderQuery . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['completeAllOrders'])) {

    //create the order
    $completeOrderQuery = "UPDATE orders SET completed = TRUE";
    if (mysqli_query($conn, $completeOrderQuery)) {
        $orderId = mysqli_insert_id($conn);
        echo "Order completed successfully.";
    } else {
        echo "Error: " . $completeOrderQuery . "<br>" . mysqli_error($conn);
    }
}
