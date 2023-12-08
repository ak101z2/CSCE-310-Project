<?php

//Coded by: Ryan Paul

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
            // Handle application insertion
            $program_num = $_POST['program_num'];
            $uin = $_POST['uin'];  // Autofilled UIN
            $uncom_cert = $_POST['uncom_cert'];
            $com_cert = $_POST['com_cert'];
            $purpose_statement = $_POST['purpose_statement'];
        
            $sql = "INSERT INTO Applications (Program_Num, UIN, Uncom_Cert, Com_Cert, Purpose_Statement) 
                    VALUES ('$program_num', '$uin', '$uncom_cert', '$com_cert', '$purpose_statement')";
            if ($conn->query($sql) === TRUE) {
                // echo "Application added successfully";  // Commented out the success message
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;

    case 'update':
        // Handle application update
        $uin = $_POST['uin'];
        $program_num = $_POST['program_num'];
        $uncom_cert = $_POST['uncom_cert'];
        $com_cert = $_POST['com_cert'];
        $purpose_statement = $_POST['purpose_statement'];
    
        // Check for empty values
        if (empty($uin) || empty($program_num)) {
            echo "Error: UIN and Program Number are required for updating.";
            break;
        }
    
        // Check if any of the fields are empty, if yes, fetch existing values from the database
        if (empty($uncom_cert) || empty($com_cert) || empty($purpose_statement)) {
            $sqlSelect = "SELECT * FROM Applications WHERE UIN='$uin' AND Program_Num='$program_num'";
            $resultSelect = $conn->query($sqlSelect);
    
            if ($resultSelect->num_rows > 0) {
                $rowSelect = $resultSelect->fetch_assoc();
    
                // Use existing values if corresponding fields are empty
                $uncom_cert = empty($uncom_cert) ? $rowSelect['Uncom_Cert'] : $uncom_cert;
                $com_cert = empty($com_cert) ? $rowSelect['Com_Cert'] : $com_cert;
                $purpose_statement = empty($purpose_statement) ? $rowSelect['Purpose_Statement'] : $purpose_statement;
            }
        }
    
        // Update the application
        $sql = "UPDATE Applications SET Uncom_Cert='$uncom_cert', Com_Cert='$com_cert', Purpose_Statement='$purpose_statement' 
                WHERE UIN='$uin' AND Program_Num='$program_num'";
        if ($conn->query($sql) === TRUE) {
            // Application updated successfully
            echo "Application updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        break;

    case 'select':
        // Handle application selection and review
        $program_num = $_POST['program_num'];
        $uin = $_POST['uin']; // Add this line
    
        // Fetch program name based on the selected Program_Num
        $programNameQuery = "SELECT Name FROM Programs WHERE Program_Num = '$program_num'";
        $programNameResult = $conn->query($programNameQuery);
    
        if ($programNameResult->num_rows > 0) {
            $programRow = $programNameResult->fetch_assoc();
            $program_name = $programRow['Name'];
    
            // Fetch data from the Applications table based on the selected Program_Num and UIN
            $applicationQuery = "SELECT * FROM Applications WHERE Program_Num = '$program_num' AND UIN = '$uin'";
            $applicationResult = $conn->query($applicationQuery);
    
            if ($applicationResult->num_rows > 0) {
                // Display the application details
                echo "<h4>Application Details for {$program_name}</h4>";
                while ($row = $applicationResult->fetch_assoc()) {
                    echo "<p>Uncompleted Certification: {$row['Uncom_Cert']}</p>";
                    echo "<p>Completed Certification: {$row['Com_Cert']}</p>";
                    echo "<p>Purpose Statement: {$row['Purpose_Statement']}</p>";
                    // Add more details as needed
                    echo "<hr>"; // Add a separator between applications
                }
            } else {
                echo "No applications found for Program $program_name and UIN $uin";
            }
        } else {
            echo "Program not found for Program_Num $program_num";
        }
        break;

    case 'delete':
        // Handle application deletion
        $uin = $_POST['uin'];
        $program_num = $_POST['program_num'];

        // Check if the user has applied for the selected program
        $sqlCheckApplication = "SELECT * FROM Applications WHERE UIN='$uin' AND Program_Num='$program_num'";
        $resultCheckApplication = $conn->query($sqlCheckApplication);

        if ($resultCheckApplication->num_rows > 0) {
            // User has applied for the program, proceed with deletion
            $sqlDelete = "DELETE FROM Applications WHERE UIN='$uin' AND Program_Num='$program_num'";
            if ($conn->query($sqlDelete) === TRUE) {
                // echo "Application deleted successfully";  // Commented out the success message
            } else {
                echo "Error: " . $sqlDelete . "<br>" . $conn->error;
            }
        } else {
            echo "Error: You haven't applied for the selected program.";
        }
        break;

    default:
        echo "Invalid action.";
    }
}

// Close the database connection
$conn->close();
?>
