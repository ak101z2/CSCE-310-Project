<?php

$UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN

$servername = "localhost";
$username = "user";
$password = "pass1";
$dbname = "csce310project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

session_start();
$sql = "UPDATE `users` SET `Passwords` = '' WHERE `UIN` = '$_POST[DisableAccount]'";

if ($conn->query($sql) === TRUE) {
    header("Location: admin/authentication/authentication.php?UIN=$UIN");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1");

$conn->close();

?>