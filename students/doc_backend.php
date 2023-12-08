<?php
//Written by Maharshi Rathod
include 'connectionDB.php';  // Include your database connection file
$UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
function getApps($conn) {
  $query = "SELECT * FROM applications";
  $result = $conn->query($query);

  $apps = [];
  while ($row = $result->fetch_assoc()) {
      $apps[] = $row;
  }

  return $apps;
}
function getDoc($conn) {
    $query = "SELECT * FROM documentation";
    $result = $conn->query($query);
  
    $apps = [];
    while ($row = $result->fetch_assoc()) {
        $apps[] = $row;
    }
  
    return $apps;
  }

function getDocument($conn, $docNum) {
    $query = "SELECT * FROM Documentation WHERE Doc_Num = '$docNum'";
    $result = $conn->query($query);

    return $result->fetch_assoc();
}
$apps = getApps($conn);
$documents = getDoc($conn);

// Insert Document
if (isset($_POST['insertDoc'])) {
    // Retrieve form data
    $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';
    $appNum = $_POST['appNum'];
    
    // Validate and sanitize input if necessary

    // Handle File Upload
    $docDir = "documents/";
    $docFile = $docDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($docFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($docFile)) {
        // If the file already exists, generate a unique file name
        $docFile = $docDir . uniqid() . '_' . basename($_FILES["file"]["name"]);
    }

    // Check file size (adjust max size as needed)
    if ($_FILES["file"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = array("pdf", "docx");
    if (!in_array($fileType, $allowedFormats)) {
        echo "Sorry, only PDF and Word documents are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $docFile)) {
            // File uploaded successfully, insert into database
            $link = $docFile;

            // Construct the insert query
            $insertQuery = "INSERT INTO Documentation (App_Num, Link, Doc_Type) 
                            VALUES ('$appNum', '$link', '$fileType')";

            // Execute the insert query
            if ($conn->query($insertQuery) === TRUE) {
                header("Location: document.php?UIN=$UIN");
                echo "File uploaded and document inserted successfully.";
            } else {
                echo "Error inserting document: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Update Document
if (isset($_POST['updateDoc'])) {
    // Retrieve form data
    $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';
    $docNum = $_POST['docNum'];
    $appNum = $_POST['appNumUpdate'];
    $updateOption = $_POST['updateOption'];
  
    // Validate and sanitize input if necessary

    // Check if the user wants to replace the document entirely
    if ($updateOption === "replace") {
        // Handle File Upload
        $documentDir = "documents/";
        $updatedFile = $documentDir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($updatedFile, PATHINFO_EXTENSION));


        // Check file size (adjust max size as needed)
        if ($_FILES["file"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = array("pdf", "docx");
        if (!in_array($fileType, $allowedFormats)) {
            echo "Sorry, only PDF and Word documents are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $updatedFile)) {
                // File uploaded successfully, update document information in the database
                $link = $updatedFile;

                // Construct the update query
                $updateQuery = "UPDATE Documentation SET App_Num = '$appNum', Link = '$link', Doc_Type = '$fileType' WHERE Doc_Num = '$docNum'";

                // Execute the update query
                if ($conn->query($updateQuery) === TRUE) {
                    header("Location: document.php?UIN=$UIN");
                    echo "File uploaded and document updated successfully.";
                } else {
                    echo "Error updating document: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } elseif ($updateOption === "changeAppNum") {
        // User wants to update only the application number
        // Construct the update query
        $updateQuery = "UPDATE Documentation SET App_Num = '$appNum' WHERE Doc_Num = '$docNum'";

        // Execute the update query
        if ($conn->query($updateQuery) === TRUE) {
            header("Location: document.php?UIN=$UIN");
            echo "Document application number updated successfully.";
        } else {
            echo "Error updating document: " . $conn->error;
        }
    }
}

// View Documents
if (isset($_POST['viewDocs'])) {
    // Retrieve form data
    $docNum = $_POST['docNumView'];
    $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';
    // Construct the query to fetch the selected document
    $query = "SELECT * FROM Documentation WHERE Doc_Num = '$docNum'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $selectedDoc = $result->fetch_assoc();
        echo "Document Number: " . $selectedDoc['Doc_Num'] . "<br>";
        echo "Application Number: " . $selectedDoc['App_Num'] . "<br>";
        echo "Document Type: " . $selectedDoc['Doc_Type'] . "<br>";
        echo "Link: " . $selectedDoc['Link'] . "<br>";

        // Add a button to reroute to document.php
        echo '<form action="document.php" method="GET">';
        echo '<input type="hidden" name="UIN" value="' . $UIN . '">';
        echo '<button type="submit">Go back to Document Page</button>';
        echo '</form>';

        $selectedDocNum = $_POST['docNumView'];
        $selectedDocument = getDocument($conn, $selectedDocNum);

        if ($selectedDocument) {
            $documentLink = $selectedDocument['Link'];
            $documentType = $selectedDocument['Doc_Type'];

            echo '<h3>Selected Document</h3>';
            echo "<p>Application Number: {$selectedDocument['App_Num']}</p>";
            echo "<iframe src='{$documentLink}' width='800' height='600'></iframe>";
        } else {
            echo '<p>No document selected or document not found.</p>';
        }
        

    } else {
        echo "No document found with the provided Document Number.";
    }
}

// Delete Document
if (isset($_POST['deleteDocBut'])) {
    // Retrieve form data
    $selectedDocID = $_POST['deleteDoc'];
    $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';
    // Validate and sanitize input if necessary

    // Delete all instances of the event from Event_Tracking table
    $deleteDocQuery = "DELETE FROM Documentation WHERE Doc_Num = '$selectedDocID'";

    // Execute the delete query for Event_Tracking table
    if ($conn->query($deleteDocQuery) === TRUE) {
        header("Location: document.php?UIN=$UIN");
    } else {
        echo "Error deleting event tracking entries: " . $conn->error;
    }
}

?>


