<?php
include('session.php');
$_SESSION['activePage'] = 'index';
include('userNavbar.php');

//display all the products
//to each card add a drop down menu for size (S,M,L,XL)
//to each card add a drop down menu for quantity
//to each card add a button for add to cart




?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <title>Home</title>
</head>

<body>


    <a class="btn btn-primary" aria-current="page" href="/ITECA3-Project/test.php">TEST</a>


    <div class="container py-5 my-5 mx-auto border">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            $sql = 'SELECT * FROM products';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <!--Product modal -->
                <div class='modal fade' id='productModal<?php echo $row['id'] ?>' tabindex='-1' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='productModalLabel'>Product Details</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form method='post' action='index.php' name='productForm'>
                                    <h3>Name : <?php echo $row['name']; ?></h3>
                                    <h3>Price: <?php echo $row['price']; ?></h3>
                                    <h3>ID : <?php echo $row['id']; ?></h3>
                                    <!-- <div class='mb-3'>
                                        <label for='email' class='col-form-label'>Email:</label>
                                        <input type='text' class='form-control' name='email'>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='password' class='col-form-label'>Password:</label>
                                        <input type='password' class='form-control' name='password'>
                                    </div> -->
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Product Card Display -->
                <div class='col'>
                    <div class='card'>
                        <img src='https://picsum.photos/300/200' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $row['name'] ?></h5>
                            <p class='card-text'><?php echo $row['price'] ?></p>
                            <div class='d-flex justify-content-between options'>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal<?php echo $row["id"] ?>" data-bs-whatever="@mdo">
                                    <i class='bi-info-circle-fill'></i>
                                    View product info
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