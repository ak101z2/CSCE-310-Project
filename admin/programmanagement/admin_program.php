<?php

//Coded by: Ryan Paul

// Database connection code here
$servername = "localhost";
$username = "user";
$password = "pass1";
$dbname = "csce310project_final";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'insert':
            // Handle program insertion
            $name = $_POST['name'];
            $description = $_POST['description'];
            $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';

            $sql = "INSERT INTO Programs (Name, Description) VALUES ('$name', '$description')";
            if ($conn->query($sql) === TRUE) {
                header("Location: programmanagement.php?UIN=$UIN");
                // echo "Program added successfully";  // Commented out the success message
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;

        case 'update':
            // Handle program update
            $program_num = $_POST['program_num'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $grant_access = isset($_POST['grant_access']);  // Removed the specific value check
            $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';
            
            // Check for empty values
            if (empty($program_num)) {
                echo "Error: Program Number is required for updating.";
                break;
            }
        
            // Check if any of the fields are empty, if yes, fetch existing values from the database
            if (empty($name) || empty($description)) {
                $sqlSelect = "SELECT * FROM Programs WHERE Program_Num='$program_num'";
                $resultSelect = $conn->query($sqlSelect);
        
                if ($resultSelect->num_rows > 0) {
                    $rowSelect = $resultSelect->fetch_assoc();
        
                    // Use existing values if corresponding fields are empty
                    $name = empty($name) ? $rowSelect['Name'] : $name;
                    $description = empty($description) ? $rowSelect['Description'] : $description;
                }
            }
        
            // Update the program
            $sql = "UPDATE Programs SET Name='$name', Description='$description' WHERE Program_Num=$program_num";
            if ($conn->query($sql) === TRUE) {
                // Update successful, check for grant_access option
                if ($grant_access) {
                    // Implement logic to grant access back for students
                    $sqlGrantAccess = "UPDATE Programs SET IsVisible = 1 WHERE Program_Num = $program_num";
                    $conn->query($sqlGrantAccess);
                    echo "Access to Program $program_num granted back for students";
                }
                // Redirect to the program management page
                header("Location: programmanagement.php?UIN=$UIN");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;

        case 'select':
            // Handle program selection and report generation
            $program_num = $_POST['program_num'];
        
            // Fetch data from the database based on the selected program number
            $sql = "SELECT Name, Description FROM Programs WHERE Program_Num = $program_num";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                // Display the report
                $row = $result->fetch_assoc();
                echo "<h4>Report for {$row['Name']}</h4>";
                echo "<p>Description: {$row['Description']}</p>";
                // Add more details as needed
            } else {
                echo "No data found for Program $program_num";
            }
            break;

        case 'delete':
            // Handle program deletion
            $program_num = $_POST['program_num'];
            $delete_type = $_POST['delete_type'];
            $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';

        
            if ($delete_type === 'remove_access') {
                // Implement logic to set IsVisible to 0 for the program
                $program_num = $_POST['program_num']; // Make sure to get the program number
                $sql = "UPDATE Programs SET IsVisible = 0 WHERE Program_Num = $program_num";
                echo $sql; // Check the generated SQL query
                if ($conn->query($sql) === TRUE) {
                    echo "Access to Program $program_num removed for students";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } elseif ($delete_type === 'full_delete') {
                // Implement logic for full delete
                $sql = "DELETE FROM Programs WHERE Program_Num=$program_num";
                if ($conn->query($sql) === TRUE) {
                    header("Location: programmanagement.php?UIN=$UIN");
                    // echo "Program deleted successfully";  // Commented out the success message
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Invalid delete type";
            }
            break;

        default:
            echo "Invalid action.";
    }
}

// Close the database connection
$conn->close();
?>