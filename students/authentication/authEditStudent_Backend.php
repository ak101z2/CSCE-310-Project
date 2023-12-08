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

$sql = "SELECT MAX(UIN) FROM Users; ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$UIN = $_POST["UIN"];
$First_Name = $_POST["First_Name"];
$M_Initial = $_POST["M_Initial"];
$Last_Name = $_POST["Last_Name"];
$Username = $_POST["Username"];
$Passwords = $_POST["Passwords"];
$User_Type = $_POST["User_Type"];
$Email = $_POST["Email"];
$Discord_Name = $_POST["Discord_Name"];

$Gender = $_POST["Gender"];
$Hispanic_Latino = $_POST["Hispanic_Latino"];
$Race = $_POST["Race"];
$US_Citizen = $_POST["US_Citizen"];
$First_Generation = $_POST["First_Generation"];
$DoB = $_POST["GPA"];
$Major = $_POST["Major"];
$Minor1 = $_POST["Minor1"];
$Minor2 = $_POST["Minor2"];
$Expected_Graduation = $_POST["Expected_Graduation"];
$School = $_POST["School"];
$Classification = $_POST["Classification"];
$Phone = $_POST["Phone"];
$Student_Type = $_POST["Student_Type"];


$sql = "UPDATE users SET First_Name = '$First_Name', M_Initial = '$M_Initial', Last_Name = '$Last_Name', Username = '$Username', Passwords = '$Passwords', User_Type = '$User_Type', Email = '$Email', Discord_Name = '$Discord_Name'
WHERE UIN = '$UIN'"; 

if ($conn->query($sql) === TRUE) {
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$sql = "UPDATE college_student
SET Gender = '$Gender', Hispanic_Latino = '$Hispanic_Latino', Race = '$Race', US_Citizen = '$US_Citizen', 
    First_Generation = '$First_Generation', DoB = '$DoB', Major = '$Major', Minor1 = '$Minor1', 
    Minor2 = '$Minor2', Expected_Graduation = '$Expected_Graduation', School = '$School', 
    Classification = '$Classification', Phone = '$Phone', Student_Type = '$Student_Type'
WHERE UIN = $UIN"; 

if ($conn->query($sql) === TRUE) {
    header("Location: http://localhost/csce-310-project/students/authentication/authentication.php?UIN=$UIN");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
$conn->close();

?>