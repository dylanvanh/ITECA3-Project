<?php
include('../session.php');
$_SESSION['activePage'] = 'products';
include('adminNavbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .productImage {
            height: 300px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <h1>Products Page</h1>

    <a class="btn btn-primary" href="createProduct.php">Create product</a>

    <div class="container py-5 my-5 mx-auto border">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            $productsSelectStatement = 'SELECT * FROM products';
            $productsResults = mysqli_query($conn, $productsSelectStatement);
            while ($productData = mysqli_fetch_array($productsResults)) {
            ?>
                <!--Product modal -->
                <div class='modal fade' id='productModal<?php echo $productData['id'] ?>' tabindex='-1' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='productModalLabel'><?php echo $productData['name']; ?> Details</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form method="post" name="toggleProductVisibilityForm" action="">

                                    <!-- Item info -->
                                    <div class="container d-flex">
                                        <div class="left mr-5">
                                            <h3>Name:</h3>
                                            <p><?php echo $productData['name']; ?></p>
                                            <h3>Price:</h3>
                                            <p><?php echo $productData['price']; ?></p>
                                            <h3>Description:</h3>
                                            <p><?php echo $productData['description']; ?></p>
                                            <h3>ID : <?php echo $productData['id']; ?></h3>
                                            <h3>Visibility : <?php echo $productData['visible'] == '1' ? 'Visible' : 'Hidden'; ?></h3>


                                        </div>
                                        <div class="right">
                                            <img class="productImage" src="<?php echo $productData['imageUrl']; ?>" alt="">
                                        </div>
                                    </div>
                            </div>
                            <div class='modal-footer'>
                                <input type="hidden" name="id" value="<?php echo $productData['id'] ?>">
                                <button type='submit' name="toggleProductVisibility" class='btn btn-danger'>Toggle Visibility</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Card Display -->
                <div class='col'>
                    <div class='card'>
                        <img src=<?php echo $productData['imageUrl']; ?> class='card-img-top productImage ' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $productData['name'] ?></h5>
                            <p class='card-text'>R<?php echo $productData['price'] ?></p>
                            <h3>Visibility : <?php echo $productData['visible'] == '1' ? 'Visible' : 'Hidden'; ?></h3>
                            <div class='d-flex justify-content-between options'>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal<?php echo $productData["id"] ?>" data-bs-whatever="@mdo">
                                    <i class="bi bi-view-stacked"></i>
                                    View details
                                </button>
                                <button type='submit' name="toggleProductVisibility" class='btn btn-danger'>Toggle Visibility</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>