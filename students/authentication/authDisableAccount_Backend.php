<?php
$servername = "localhost";
$username = "user";
$password = "pass1";
$dbname = "csce310project_final";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

session_start();
$sql = "UPDATE `users` SET `Passwords` = '' WHERE `UIN` = '$_SESSION[DisableAccount]'";

if ($conn->query($sql) === TRUE) {
    header('Location: http://localhost/csce-310-project/login.php');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1");

$conn->close();

?>