<?php
$UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
session_start();
if ($_SESSION['User_Type'] != "Admin") {
  header("Location: ../students/authentication.php?UIN=$UIN");
}

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

$tables = array("applications", "cert_enrollment", "class_enrollment", "college_student", "events", "event_tracking", "intern_app", "track");

$conn->begin_transaction();

try {
    // Loop through related tables and delete rows with the specified foreign key
    foreach ($tables as $table) {
        $query = "DELETE FROM $table WHERE UIN = $_POST[DeleteAccount]";
        $conn->query($query);
        echo $query . " Complete <br>";
    }

    // Delete the row from the main table
    $mainTableQuery = "DELETE FROM users WHERE UIN = $_POST[DeleteAccount]";
    $conn->query($mainTableQuery);
    echo "MAIN Complete <br>";

    // Commit the transaction
    $conn->commit();
    header("Location: http://localhost/csce-310-project/admin/authentication/authentication.php?UIN=$UIN");
} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}


?>