<?php
include('../../include/session.php');
include('../../include/connection.php');
$_SESSION['activePage'] = 'bulk';
include('../../include/adminNavbar.php');
include('../models/bulkOrderItem.php');


// if admin not logged in -> route to login
if (!isset($_SESSION['adminLoggedIn'])) {
    header('location: /ITECA3-Project/index.php');
}


//consists of multiple BulkOrderItem objects
$bulkProductsOrder = [];


// 1. loop through orders and get the order id's , where completed = 0
$ordersSelectStatement = 'SELECT * FROM orders WHERE completed = 0';
$ordersResult = mysqli_query($conn, $ordersSelectStatement);

while ($orderData = mysqli_fetch_array($ordersResult)) {
    //retrieve the orderItems for the current order
    $orderItemsSelectStatement = "SELECT * FROM orderItems WHERE orderId = '$orderData[id]'";
    $orderItemsResult = mysqli_query($conn, $orderItemsSelectStatement);
    while ($orderItemsData = mysqli_fetch_array($orderItemsResult)) {


        //retrieve the product for the current orderItem
        $productId = $orderItemsData['productId'];

        //reset if a match is found
        $foundMatch = false;
        //track the index of the found match

        //index for tracking the current product in the bulkProductsOrder array
        $index = 0;


        //check if product object already exists in the bulkProductsOrder array
        foreach ($bulkProductsOrder as $product) {
            if ($product->productId == $productId) {
                $foundMatch = true;
                break;
            }
            $index += 1;
        }

        //if a match was found (product already in bulkOrdersArray)
        if ($foundMatch) {
            switch ($orderItemsData['size']) {
                case "S":
                    $bulkProductsOrder[$index]->smallSize += $orderItemsData['quantity'];
                    break;
                case "M":
                    $bulkProductsOrder[$index]->mediumSize += $orderItemsData['quantity'];
                    break;
                case "L":
                    $bulkProductsOrder[$index]->largeSize += $orderItemsData['quantity'];
                    break;
                default:
                    break;
            }

            // //calculate the new total
            $bulkProductsOrder[$index]->total += $orderItemsData['quantity'];
        } else {

            //get productName from products table
            $productNameSelectStatement = "SELECT * FROM products WHERE id = '$productId'";
            $productNameResult = mysqli_query($conn, $productNameSelectStatement);
            $productNameData = mysqli_fetch_array($productNameResult);
            $productName = $productNameData['name'];

            //create new productItem
            $newFoundProduct = new BulkOrderItem($productId, $productName, 0, 0, 0, 0);

            //add the size quantity to the newly created object
            switch ($orderItemsData['size']) {
                case "S":
                    $newFoundProduct->smallSize += $orderItemsData['quantity'];
                    break;
                case "M":
                    $newFoundProduct->mediumSize += $orderItemsData['quantity'];
                    break;
                case "L":
                    $newFoundProduct->largeSize += $orderItemsData['quantity'];
                    break;
                default:
                    break;
            }

            //calculate the new total
            $newFoundProduct->total += $orderItemsData['quantity'];

            //add the productId to the array
            $bulkProductsOrder[] = $newFoundProduct;
        }
    }
}
