<!-- php backend that queries all certifications that a current user is enrolled in and outputs them -->
<!-- Accesses current UIN for student through the _GET method -->
<!-- SQL select statement to determine Cert_ID and Name -->

<?php
include 'db_connection.php';

$student_UIN = $_GET['UIN'];
$query = "SELECT Cert_ID, `Name` FROM `certification` c
          WHERE EXISTS (
              SELECT 1 FROM `cert_enrollment` c_e
              WHERE c_e.UIN = '$student_UIN'
              AND c_e.Cert_ID = c.Cert_ID
          )";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<option value="null"></option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['Cert_ID'] . '">' . $row['Name'] . '</option>';
    }
} else {    
    echo '<option value="">No certifications available</option>';
}

$conn->close();
?>