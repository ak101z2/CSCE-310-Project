<?php
$UINGET = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
session_start();
if ($_SESSION['User_Type'] != "Admin") {
  header("Location: ../.php?UIN=$UIN");
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

$Gender = $_POST["Gender"];
$Hispanic_Latino = $_POST["Hispanic_Latino"];
$Race = $_POST["Race"];
$US_Citizen = $_POST["US_Citizen"];
$First_Generation = $_POST["First_Generation"];
$DoB = $_POST["DoB"];
$GPA = $_POST["GPA"];
$Major = $_POST["Major"];
$Minor1 = $_POST["Minor1"];
$Minor2 = $_POST["Minor2"];
$Expected_Graduation = $_POST["Expected_Graduation"];
$School = $_POST["School"];
$Classification = $_POST["Classification"];
$Phone = $_POST["Phone"];
$Student_Type = $_POST["Student_Type"];



$sql = "INSERT INTO users (UIN, First_Name, M_Initial, Last_Name, Username, Passwords, User_Type, Email, Discord_Name) 
VALUES ('$UIN', '$First_Name', '$M_Initial', '$Last_Name', '$Username', '$Passwords', '$User_Type', '$Email', '$Discord_Name');";

if ($conn->query($sql) === TRUE) {
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$sql = "INSERT INTO college_student (UIN, Gender, Hispanic_Latino, Race, US_Citizen, First_Generation, DoB, GPA, Major, Minor1, Minor2, Expected_Graduation, School, Classification, Phone, Student_Type)
VALUES ('$UIN', '$Gender', '$Hispanic_Latino', '$Race', '$US_Citizen', '$First_Generation', '$DoB', '$GPA', '$Major', '$Minor1', '$Minor2', '$Expected_Graduation', '$School', '$Classification', '$Phone', '$Student_Type');";

if ($conn->query($sql) === TRUE) {
    header("Location: authentication.php?UIN=$UINGET");
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }  

$conn->close();

?>