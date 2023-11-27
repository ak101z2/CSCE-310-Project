<?php
$servername = "localhost";
$username = "user";
$password = "pass1";
$dbname = "csce310project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$usernameInput = $_POST['usernameInput'];
$passwordInput = $_POST['passwordInput'];

$sql = "SELECT User_Type, UIN FROM `users` WHERE Username='$usernameInput' AND Passwords='$passwordInput';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $User_Type = $row['User_Type'];
  if ($User_Type == 'Student') {
    $UIN = $row['UIN'];
    header("Location: students/authentication.php?UIN=$UIN");
  } else if ($User_Type == 'Admin') {
    $UIN = $row['UIN'];
    header("Location: admin/authentication.php?UIN=$UIN");
  }
} else {
  header("Location: login.php");
}

exit();

$conn->close();
?>