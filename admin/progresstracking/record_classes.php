<!-- php backend that queries all classes that a current user is not enrolled in and outputs them -->
<!-- Accesses current UIN for student through the _GET method -->
<!-- SQL select statement to determine Class_ID and Name -->

<?php
include 'db_connection.php';

$student_UIN = $_GET['student_UIN'];
$query = "SELECT Class_ID, `Name` FROM `classes` c
          WHERE NOT EXISTS (
              SELECT 1 FROM `class_enrollment` c_e
              WHERE c_e.UIN = '$student_UIN'
              AND c_e.Class_ID = c.Class_ID
          )";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<option value="null"></option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['Class_ID'] . '">' . $row['Name'] . '</option>';
    }
} else {    
    echo '<option value="">No classes available</option>';
}

$conn->close();
?>