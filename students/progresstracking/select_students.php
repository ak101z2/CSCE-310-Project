<?php
include 'db_connection.php';

$selectedStudentUIN = isset($_GET['UIN']) ? $_GET['UIN'] : '';
$sql = "SELECT First_Name, Last_Name, UIN FROM `users`";
$students = $conn->query($sql);
if ($students->num_rows > 0) {
    while ($row = $students->fetch_assoc()) {
        
        if ($row['UIN'] == $selectedStudentUIN) {
            $selectedAttribute = ($row['UIN'] == $selectedStudentUIN) ? 'selected' : '';
            echo '<option value="' . $row['UIN'] . '" ' . $selectedAttribute . '>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</option>';
        }
    }
} else {
    echo '<option value="">No students found</option>';
}

$conn->close();
?>
