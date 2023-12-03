<?php
include 'db_connection.php';

$student_UIN = $_GET['student_UIN'];
$query = "SELECT Program_Num, `Name` FROM `programs` p
          WHERE EXISTS (
              SELECT 1 FROM `track` t
              WHERE t.UIN = '$student_UIN'
              AND t.Program_Num = p.Program_Num
          )";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<option value="null"></option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['Program_Num'] . '">' . $row['Name'] . '</option>';
    }
} else {    
    echo '<option value="">No programs available</option>';
}

$conn->close();
?>