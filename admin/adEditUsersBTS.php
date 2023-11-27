<?php
$servername = "localhost";
$username = "user";
$password = "pass1";
$dbname = "CSCE310project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT MAX(UIN) FROM Users; ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$UIN = $row["MAX(UIN)"] + 1;

$First_Name = $_POST["First_Name"];
$M_Initial = $_POST["M_Initial"];
$Last_Name = $_POST["Last_Name"];
$Username = $_POST["Username"];
$Passwords = $_POST["Passwords"];
$User_Type = $_POST["User_Type"];
$Email = $_POST["Email"];
$Discord_Name = $_POST["Discord_Name"];


$sql = "INSERT INTO users (UIN, First_Name, M_Initial, Last_Name, Username, Passwords, User_Type, Email, Discord_Name) 
VALUES ('$UIN', '$First_Name', '$M_Initial', '$Last_Name', '$Username', '$Passwords', '$User_Type', '$Email', '$Discord_Name');";

if ($conn->query($sql) === TRUE) {
    header('Location: http://localhost/csce-310-project/UAaR/adEditUsers.php');
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();

$conn->close();

?>