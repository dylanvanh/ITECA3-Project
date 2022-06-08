<!-- handles the connection to the MySQL database -->
<?php 
session_start();

//ip hosted on (127.0.0.1)
$hostname = "localhost";
//username to db user
$db_username = "root";
//password to db user
$db_password = "root";
//database name
$db_name = "Quicksilver_swimming";

//try connect to the mysql db
$conn = mysqli_connect($hostname, $db_username, $db_password, $db_name);

//if connection not successful
if (!$conn) {
	// die("Failed to connect to db <br> ");
} else {
	// echo "Successfully connected to db <br>";
}

?>