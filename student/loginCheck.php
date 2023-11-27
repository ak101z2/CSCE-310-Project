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

$user = $_POST["user"];
$pass = $_POST["password"];

$sql = "SELECT Passwords, First_Name, Last_Name, User_Type FROM users WHERE Username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
	// output data of each row
    if ($row["Passwords"] == $pass){
        if ($row["User_Type"] == "Admin") {
            header('Location: http://localhost/csce-310-project/dummy1.php');
            exit;
        } else if ($row["User_Type"] == "College Student") {
            header('Location: http://localhost/csce-310-project/dummy2.php');
            exit;
        } else {
            header('Location: http://localhost/csce-310-project/login.php');
            exit;
        }
    } else {
        header('Location: http://localhost/csce-310-project/login.php');
        exit;
    }
} else {
echo "0 results";
}
$conn->close();

?>