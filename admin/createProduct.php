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
    $erorsFound = false;
    $errors = [];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //validate the file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $erorsFound = true;
    } else {
    }


    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $erorsFound = true;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $erorsFound = true;
    }

    //Checks if valid image file types
    if (!$imageFileType == "jpg" && !$imageFileType == "png" && !$imageFileType == "jpeg") {
        $erorsFound = true;
    }

    // Checks if any errors found
    if ($erorsFound) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        // add the new image to the assets folder
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
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
    <h1>Create Product Page</h1>
    <!-- form to create a product -->
    <div class="container">
        <form method="post" enctype="multipart/form-data" action="" name="createProductForm">
            <h3>Name:</h3>
            <input type="text" name="name">
            <h3>Descripion:</h3>
            <input type="text" name="description">
            <h3>Price:</h3>
            <input type="number" name="price">
            <h3>Image:</h3>
            <h3> Upload Image</h3>
            <input type="file" name="image" id="fileToUpload">
            <br>
            <button type="submit" value="productImage" name="createProduct">Create Product</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>