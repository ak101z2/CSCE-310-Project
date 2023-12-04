<?php
include 'db_connection.php';

$student_UIN = $_GET['UIN'];
$query = "SELECT Intern_ID, `Name` FROM `internship` i
          WHERE NOT EXISTS (
              SELECT 1 FROM `intern_app` i_a
              WHERE i_a.UIN = '$student_UIN'
              AND i_a.Intern_ID = i.Intern_ID
          )";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<option value="null"></option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['Intern_ID'] . '">' . $row['Name'] . '</option>';
    }
} else {    
    echo '<option value="">No internships available</option>';
}

$conn->close();
?>