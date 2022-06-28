<?php
include('../../include/session.php');
include('../../include/connection.php');
include('../../include/customerNavbar.php');

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
//used in the fName and lName validation
function containsNumber($value){
  if(preg_match("~[0-9]+~",$value)){
    return TRUE;
  }
  return FALSE;
}


//login form submitted
if (isset($_POST['login'])) {

  //get user data from fields
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);


  //fetches existing userdata if exists
  $fetchUserDataQuery = "SELECT * FROM users WHERE '$email'= email AND '$password' = password LIMIT 1";

  $queryResults =  mysqli_query($conn, $fetchUserDataQuery);

  //if query was a success
  if ($queryResults) {
    if (mysqli_num_rows($queryResults) > 0) {
      //data returned with query -> valid user details
      $row = mysqli_fetch_assoc($queryResults);

      //set session variables for required user details
      $_SESSION['userId'] = $row['id'];
      $_SESSION['userName'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['userPhoneNumber'] = $row['phoneNumber'];
      $_SESSION['userIsAdmin'] = $row['isAdmin'];

      if ($row['isAdmin'] == 1) {
        //if admin (1) -> isAdmin = true
        //route to admin home page
        $_SESSION['adminLoggedIn'] = True;
        header("Location: /ITECA3-Project/admin/views/users.php");
      } else {
        //if normal user (0) -> isAdmin = false
        //route to user home page

        $_SESSION['userLoggedIn'] = True;

        //checks if the user was in the process of checking out , before sigining in
        if (isset($_SESSION['userTryingToCheckout'])) {
          header('location: /ITECA3-Project/customer/views/checkout.php');
        } else {
          header("Location: /ITECA3-Project/index.php");
        }
      }
    } else {
      //invalid user details, nothing returned
      // echo "<p style='color:red'>Invalid User Details</p>";
    }
  } else {
    echo 'Error logging in , server side problem';
  }
}
 
?>