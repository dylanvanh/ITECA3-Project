<?php
include('session.php');
$_SESSION['activePage'] = 'index';
include('userNavbar.php');

$cart = unserialize($_SESSION['cart']);

for ($i = 0; $i < count($cart); $i++) {
    echo $cart[$i]->id;
    echo "<br>";
    echo $cart[$i]->name;
    echo "<br>";
    echo $cart[$i]->price;
    echo "<br>";
    echo $cart[$i]->quantity;
    echo "<br>";
    echo $cart[$i]->image;
    echo "<br>";
    echo $cart[$i]->size;
    echo "<br>";
    echo "---------------";
    echo "<br>";
}

echo 'COUNT = ',$_SESSION['count'];

//display all the products
//to each card add a drop down menu for size (S,M,L,XL)
//to each card add a drop down menu for quantity
//to each card add a button for add to cart

// define variables and set to empty values
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        .productImage {
            height: 300px;
        }
    </style>

    <title>Home</title>
</head>

<body>
    <div class="container py-5 my-5 mx-auto border">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            $sql = 'SELECT * FROM products';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <!-- 
                    Size dropdown -> default to nothing
                    Quantity input -> default to 1 
                -->
                <!--Product modal -->
                <div class='modal fade' id='productModal<?php echo $row['id'] ?>' tabindex='-1' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='productModalLabel'><?php echo $row['name']; ?> Details</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form method="post" name="addToCartForm" action="index.php">
                                    <?php
                                    //save latest viewed product details , for adding to the cart
                                    //saves having to query the db the db again when adding to cart
                                    $_SESSION['lastProductId'] = $row['id'];
                                    $_SESSION['lastProductName'] = $row['name'];
                                    $_SESSION['lastProductPrice'] = $row['price'];
                                    $_SESSION['lastProductImageUrl'] = $row['imageUrl'];
                                    $_SESSION['lastProductDescription'] = $row['description'];
                                    ?>

                                    <div class="container d-flex">
                                        <div class="left mr-5">
                                            <h3>Name:</h3>
                                            <p><?php echo $row['name']; ?></p>
                                            <h3>Price:</h3>
                                            <p><?php echo $row['price']; ?></p>
                                            <h3>Description:</h3>
                                            <p><?php echo $row['description']; ?></p>
                                            <h3>ID : <?php echo $row['id']; ?></h3>
                                        </div>
                                        <div class="right">
                                            <img class="productImage" src="<?php echo $row['imageUrl']; ?>" alt="">
                                        </div>
                                    </div>
                                    <hr class="border-2 border-top border-dark">

                                    <p>Select a size</p>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="size" value="small">Small
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio2" name="size" value="medium">Medium
                                            <label class="form-check-label" for="radio2"></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio2" name="size" value="large">Large
                                            <label class="form-check-label" for="radio2"></label>
                                        </div>
                                    </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' name="addToCart" class='btn btn-primary' data-bs-dismiss='modal'>Add to cart</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Product Card Display -->
                <div class='col'>
                    <div class='card'>
                        <img src=<?php echo $row['imageUrl']; ?> class='card-img-top productImage ' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $row['name'] ?></h5>
                            <p class='card-text'>R<?php echo $row['price'] ?></p>
                            <div class='d-flex justify-content-between options'>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal<?php echo $row["id"] ?>" data-bs-whatever="@mdo">
                                    <i class="bi bi-view-stacked"></i>
                                    View options
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

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Created by Dylan van Heerden</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>