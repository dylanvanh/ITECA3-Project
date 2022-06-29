<?php
include('../controllers/orders.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="/ITECA3-Project/include/globalStyles.css" rel="stylesheet" />
    <title>Orders</title>
    <style>
        .modalImage {
            max-width: 250px;
            max-height: 250px;
            margin-left: 2rem;
        }
    </style>
</head>

<body class="backColor">
    <h1 class="text-center my-3">Orders</h1>
    <div class="container py-5 my-5 mx-auto border">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            $ordersSelectStatement = 'SELECT * FROM orders WHERE userId = ' . $_SESSION['userId'] . ' ORDER BY date DESC';
            $ordersResult = mysqli_query($conn, $ordersSelectStatement);

            //calculate total price an individual order
            while ($orderData = mysqli_fetch_array($ordersResult)) {
            ?>
                <!--Order modal -->
                <div class='modal fade' id='orderModal<?php echo $orderData['id'] ?>' tabindex='-1' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='orderModalLabel'><?php echo $orderData['id']; ?> Details</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <?php

                                $orderItemsSelectStatement = "SELECT * FROM orderItems WHERE orderId = '$orderData[id]'";
                                $orderItemsResult = mysqli_query($conn, $orderItemsSelectStatement);
                                while ($orderItemsData = mysqli_fetch_array($orderItemsResult)) {
                                    $productId = $orderItemsData['productId'];
                                    $productSelectStatement = "SELECT name,imageUrl FROM products WHERE id = '$productId'";
                                    $productNameResult = mysqli_query($conn, $productSelectStatement);
                                    $productData = mysqli_fetch_array($productNameResult);
                                    $productName = $productData['name'];
                                    $productImageUrl =  $productData['imageUrl'];
                                ?>
                                    <!-- Items details -->
                                    <div class="container d-flex">
                                        <div class="left mr-5">
                                            <h3>Name:</h3>
                                            <p><?php echo $productName; ?></p>
                                            <h3>Quantity:</h3>
                                            <p><?php echo $orderItemsData['quantity']; ?></p>
                                            <h3>Size:</h3>
                                            <p><?php echo $orderItemsData['size']; ?></p>
                                            <h3>Cost:</h3>
                                            <p><?php echo $orderItemsData['cost']; ?></p>
                                        </div>
                                        <div class="right ml-5">
                                            <img src="<?php echo $productImageUrl; ?>" class="img-fluid modalImage">
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Card Display -->
                <div class='col'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $orderData['date'] ?></h5>
                            <p class='card-text'><?php echo $orderData['deliveryLocation'] ?></p>
                            <p class='card-text'><?php echo $orderData['id'] ?></p>
                            <p class='card-text'>R<?php echo $orderData['totalCost'] ?></p>
                            <div class='d-flex justify-content-between options'>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $orderData["id"] ?>" data-bs-whatever="@mdo">
                                    <i class="bi bi-view-stacked"></i>
                                    View details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php include("../../include/footer.php"); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>