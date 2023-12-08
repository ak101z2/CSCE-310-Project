<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  session_start();
  $type = isset($_GET['Type']) ? $_GET['Type'] : ''; // Gets Search Type
  $value = $_POST["$type"];

  if ($type == "UIN") {
    $sql = "SELECT * FROM `users` WHERE UIN = $value";

} else if ($type == "Username") {
    $sql = "SELECT * FROM `users` WHERE Username = '$value'";
}
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
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['User_Type'] != "Admin"){
        $_SESSION[$type] = $value;
        header("Location: AuthEditSearchResultsStudent.php?UIN=$UIN&Type=$type");
        exit;
    } else {
        $_SESSION[$type] = $value;
        header("Location: AuthEditSearchResultsAdmin.php?UIN=$UIN&Type=$type");
        exit;
    }
} else {
    header("Location: authentication.php?UIN=$UIN");
    exit;
  }

?>
