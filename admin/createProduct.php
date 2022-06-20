<?php
include('../session.php');
$_SESSION['activePage'] = 'createProduct';
include('adminNavbar.php');


// if admin not logged in -> route to login
if (!isset($_SESSION['adminLoggedIn'])) {
    header('location: /ITECA3-Project/index.php');
}

// Check if image file is a actual image or fake image
if (isset($_POST["createProduct"])) {

    //location where the file will be stored
    $target_dir = "../assets/";
    // $target_dir = "../assets/";   
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    echo $target_file;
    $errorsFound = false;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //validate the file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $errorsFound = true;
    } else {
    }


    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $errorsFound = true;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $errorsFound = true;
    }

    //Checks if valid image file types
    if (!$imageFileType == "jpg" && !$imageFileType == "png" && !$imageFileType == "jpeg") {
        $errorsFound = true;
    }

    // Checks if no errors found
    if (!$errorsFound) {
        // add the new image to the assets folder
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Error uplading file.";
            $errorsFound = true;
        }
    } else {
        //if errors found
        echo "Error uploading image.";
    }

    //checks if any errors again , incase image upload failed
    if (!$errorsFound) {
        //create product record
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $imageUrl = "/ITECA3-Project/assets/" . $_FILES["image"]["name"];


        //create the product
        $productInsertQuery = "INSERT INTO Products (name, price,description,imageUrl,visible)
                VALUES ('$name','$price','$description','$imageUrl',TRUE)";

        if (mysqli_query($conn, $productInsertQuery)) {
            echo "New product created successfully.";
            header("Location: /ITECA3-Project/admin/products.php");
        } else {
            echo "Error: " . $productInsertQuery . "<br>" . mysqli_error($conn);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Create Product</title>
</head>

<body>
    <h1 class="text-center my-3">Create Product Page</h1>

    <!-- form to create a product -->
    <div class="container text-center">
        <form   method="post" enctype="multipart/form-data" action="" name="createProductForm">
            <h3>Name:</h3>
            <input type="text" name="name">
            <h3>Descripion:</h3>
            <input type="text" name="description">
            <h3>Price:</h3>
            <input type="number" name="price">
            <h3> Upload Image</h3>
            <input class="ms-5" type="file" name="image" id="fileToUpload">
            <br>
            <br>
            <button class="btn btn-primary" type="submit" value="productImage" name="createProduct">Create Product</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body> 

</html>