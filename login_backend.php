<?php
$servername = "localhost";
$username = "user";
$password = "pass1";
$dbname = "csce310project_final";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$usernameInput = $_POST['usernameInput'];
$passwordInput = $_POST['passwordInput'];

if (empty($passwordInput)){
  header("Location: login.php");
  exit;
}

$sql = "SELECT User_Type, UIN FROM `users` WHERE Username='$usernameInput' AND Passwords='$passwordInput';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $User_Type = $row['User_Type'];
  session_start();
  if ($User_Type == 'CollegeStudent' || $User_Type == 'NonCollegeStudent' || $User_Type == 'CollegeStudent' || $User_Type == 'NonCollegeStudent') {
    $UIN = $row['UIN'];
    $_SESSION['UIN'] = $UIN;
    $_SESSION['User_Type'] = 'STUDENT';
    header("Location: students/authentication/authentication.php?UIN=$UIN");
  } else if ($User_Type == 'Admin' || $User_Type == 'Admin') {
    $UIN = $row['UIN'];
    $_SESSION['UIN'] = $UIN;
    $_SESSION['User_Type'] = 'Admin';
    header("Location: admin/authentication/authentication.php?UIN=$UIN");
  }
} else {
  header("Location: login.php");
}

exit();

$conn->close();
?>