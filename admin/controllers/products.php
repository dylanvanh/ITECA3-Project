<?php
include('../../include/session.php');
include('../../include/connection.php');
$_SESSION['activePage'] = 'products';
include('../../include/adminNavbar.php');

//ADMIN OPTIONS
if (isset($_POST['toggleProductVisibility'])) {

    //required id of the item to be deleted
    $id = $_POST['id'];

    //check what the existing visibility is for the product
    $productVisibilityQuery = "SELECT visible FROM Products WHERE id = '$id'";
    $productsVisibilityResults = mysqli_query($conn, $productVisibilityQuery);
    $productVisibilityData = mysqli_fetch_array($productsVisibilityResults);

    $visibility =  $productVisibilityData['visible'];

    // $updatedVisibility = "";

    //if product already visibible
    if ($visibility == '1') {
        //change to hidden (false)
        $updateProductVisibilityQuery = "UPDATE Products SET visible = FALSE WHERE id = '$id'  ";
    } else {
        //change to visible (true)
        $updateProductVisibilityQuery = "UPDATE Products SET visible = TRUE  WHERE id = '$id'";
    }

    (mysqli_query($conn, $updateProductVisibilityQuery));
}
