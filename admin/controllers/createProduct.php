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
