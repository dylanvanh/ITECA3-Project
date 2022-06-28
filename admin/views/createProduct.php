<?php
include("../controllers/createProduct.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/ITECA3-Project/include/globalStyles.css" rel="stylesheet" />
    <title>Create Product</title>
</head>

<body class="backColor">
    <h1 class="text-center my-3">Create Product Page</h1>

    <!-- form to create a product -->
    <div class="container text-center">
        <form method="post" enctype="multipart/form-data" action="" name="createProductForm">
            <h3>Name:</h3>
            <input type="text" name="name">
            <span class="error-message" name="name-error"></span>
            <h3>Descripion:</h3>
            <input type="text" name="description">
            <span class="error-message" name="description-error"></span>
            <h3>Price:</h3>
            <input type="number" name="price">
            <span class="error-message" name="price-error"></span>
            <h3> Upload Image</h3>
            <input class="ms-5" type="file" name="image" id="fileToUpload">
            <span class="error-message" name="image-error"></span>
            <br>
            <br>
            <button class="btn btn-primary" type="submit" value="productImage" name="createProduct">Create Product</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>