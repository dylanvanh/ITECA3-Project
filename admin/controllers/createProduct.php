<?php
include('../../include/session.php');
include('../../include/connection.php');
$_SESSION['activePage'] = 'createProduct';
include('../../include/adminNavbar.php');



// if admin not logged in -> route to login
if (!isset($_SESSION['adminLoggedIn'])) {
    header('location: /ITECA3-Project/index.php');
}

//cleans the submitted form data
function cleanData($formData)
{
    //remove whitespace
    $cleanedData = trim($formData);
    //removes raw html tags
    $cleanedData = htmlspecialchars($cleanedData);
    //remove any back slashes
    $cleanedData = stripslashes($cleanedData);
    return $cleanedData;
}

//uses regex to check if string contains a number
function containsNumber($value)
{
    if (preg_match("~[0-9]+~", $value)) {
        return TRUE;
    }
    return FALSE;
}

function validation()
{
    //email validation
    $name = cleanData($_POST["name"]);
    $description = cleanData($_POST["description"]);
    $price = cleanData($_POST["price"]);

    //changes to false if errors found
    $checksPassed = true;

    //name validaiton
    if (containsNumber($name) || empty($name)) {
        $checksPassed = false;
    }

    //description validation
    if (containsNumber($description) || empty($description)) {
        $checksPassed = false;
    }

    //price validation
    if (!filter_var($price, FILTER_VALIDATE_FLOAT) || empty($price)) {
        $checksPassed = false;
    }

    return $checksPassed;
}



// Check if image file is a actual image or fake image
if (isset($_POST["createProduct"])) {

    //validation of form inputs
    $checksPassed = validation();

    //if all input fields valid
    if ($checksPassed) {

        //location where the file will be stored
        $target_dir = "../../assets/";
        // $target_dir = "../assets/";   
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $fileErrorsFound = false;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //validate the file is an image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $fileErrorsFound = true;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $fileErrorsFound = true;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 900000) {
            echo "Sorry, your file is too large.";
            $fileErrorsFound = true;
        }

        //Checks if valid image file types
        if (!$imageFileType == "jpg" && !$imageFileType == "png" && !$imageFileType == "jpeg") {
            $fileErrorsFound = true;
        }

        // Checks if no errors found
        if (!$fileErrorsFound) {
            // add the new image to the assets folder
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Error uploading image.";
                $fileErrorsFound = true;
            }
        } else {
            //if errors found
            echo "Error uploading image.";
        }

        //validates succesful image uploaded
        if (!$fileErrorsFound) {
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
                header("Location: /ITECA3-Project/admin/views/products.php");
            } else {
                echo "Error: " . $productInsertQuery . "<br>" . mysqli_error($conn);
            }
        }
    }
}
