<?php
//Written by Maharshi Rathod
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
?>
<?php
session_start();
include 'dbConnection.php'; // Make sure to include your database connection file
function getEvents($conn) {
    $query = "SELECT * FROM Events";
    $result = $conn->query($query);

    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    return $events;
}

function getAttendees($conn, $eventID) {
    $query = "SELECT UIN FROM Event_Tracking WHERE Event_ID='$eventID'";
    $result = $conn->query($query);

    $attendees = [];
    while ($row = $result->fetch_assoc()) {
        $attendees[] = $row;
    }

    return $attendees;
}

// Function to retrieve events with program and user information from the database
function getEventsWithDetails($conn) {
    $query = "SELECT Events.Event_ID, Users.Username AS UserName, Programs.Name AS ProgramName, 
              Events.Start_Date, Events.Start_Time, Events.Location, Events.End_Date, 
              Events.End_Time, Events.Event_Type
              FROM Events
              JOIN Users ON Events.UIN = Users.UIN
              JOIN Programs ON Events.Program_Num = Programs.Program_Num";
    $result = $conn->query($query);

    $events = [];
    while ($row = $result->fetch_assoc()) {
        // Fetch attendees for the current event
        $eventID = $row['Event_ID'];
        $attendees = getAttendees($conn, $eventID);
        
        if ($attendees == NULL){
            $row['Attendees'] = 'NONE';
        }
        else{
            $names = '';
            foreach ($attendees as $user) {
                $uin = $user['UIN'];
                $name = getStudent($conn, $uin);
                $attendeeNames = $name[0]['First_Name'];
                if($names === ''){
                    $names = $attendeeNames;
                }
                else{
                    $names = $names . ', ' . $attendeeNames;
                }  
            }
            $row['Attendees'] = $names;
        }
        // Check if attendees is not NULL before appending
        

        // Add the event to the events array
        $events[] = $row;
    }

    return $events;
}

function getEventDetails($conn, $eventID) {
    $query = "SELECT Events.Event_ID, Users.Username AS UserName, Programs.Name AS ProgramName, 
              Events.Start_Date, Events.Start_Time, Events.Location, Events.End_Date, 
              Events.End_Time, Events.Event_Type
              FROM Events
              JOIN Users ON Events.UIN = Users.UIN
              JOIN Programs ON Events.Program_Num = Programs.Program_Num
              WHERE Events.Event_ID = '$eventID'";
    $result = $conn->query($query);

    $eventDetails = [];
    while ($row = $result->fetch_assoc()) {
        // Fetch attendees for the current event
        $attendees = getAttendees($conn, $eventID);
        
        // Check if attendees is not NULL before appending
        if ($attendees == NULL){
            $row['Attendees'] = 'NONE';
        }
        else{
            $names = '';
            foreach ($attendees as $user) {
                $uin = $user['UIN'];
                $name = getStudent($conn, $uin);
                $attendeeNames = $name[0]['First_Name'];
                if($names === ''){
                    $names = $attendeeNames;
                }
                else{
                    $names = $names . ', ' . $attendeeNames;
                }  
            }
            $row['Attendees'] = $names;
        }

        // Assign the event details to the result array
        $eventDetails = $row;
    }

    return $eventDetails;
}

// Initialize the session variable if it doesn't exist
if (!isset($_SESSION['selectedEventID'])) {
    $_SESSION['selectedEventID'] = 'all'; // Set a default value, assuming 'all' is the default option
    $_SESSION['UIN'] = $UIN;
}

if (isset($_POST['selectEvent'])) {
    $retrieveEventID = $_POST['eventSelection'];
    if ($retrieveEventID === 'all') {
        $Allevents = getEventsWithDetails($conn);
        $id = $Allevents[0]['Event_ID'];
        $UIN = getUIN($conn, $id);
        $_SESSION['Allevents'] = $Allevents;
        $_SESSION['selectedEventID'] = $retrieveEventID;
        header("Location: eventmanagement.php?UIN=$UIN");
        // print_r($Allevents[0]);
        exit();
    } else {
        $UIN = getUIN($conn, $retrieveEventID);
        $Oneevent = getEventDetails($conn, $retrieveEventID);
        $_SESSION['Oneevent'] = $Oneevent;
        $_SESSION['selectedEventID'] = $retrieveEventID;
        header("Location: eventmanagement.php?UIN=$UIN");
        exit();
    }
}


function getUIN($conn, $eventID) {
    $query = "SELECT UIN FROM Events WHERE Event_ID = '$eventID'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['UIN'];
    } else {
        // Handle the case where the event with the given Event_ID is not found
        return null;
    }
}


// Function to retrieve programs from the database
function getPrograms($conn) {
    $query = "SELECT * FROM Programs";
    $result = $conn->query($query);

    $programs = [];
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }

    return $programs;
}

// Function to retrieve students from the database
function getStudent($conn, $uinSTU) {
    $query = "SELECT First_Name FROM users WHERE UIN='$uinSTU'";
    $result = $conn->query($query);

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    return $students;
}

function getStudents($conn) {
    $query = "SELECT * FROM users WHERE User_Type='Student'";
    $result = $conn->query($query);

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    return $students;
}



// Insert Event
if (isset($_POST['insertEvent'])) {
    // Retrieve form data
    $UIN = isset($_POST['UIN']) ? $_POST['UIN'] : '';
    $programNum = $_POST['programNum'];
    $startDate = $_POST['startDate'];
    $startTime = $_POST['startTime'];
    $location = $_POST['location'];
    $endDate = $_POST['endDate'];
    $endTime = $_POST['endTime'];
    $eventType = $_POST['eventType'];

    // Validate and sanitize input if necessary

    // Construct the insert query
    $insertQuery = "INSERT INTO Events (UIN, Program_Num, Start_Date, Start_Time, Location, End_Date, End_Time, Event_Type) 
                    VALUES ('$UIN', '$programNum', '$startDate', '$startTime', '$location', '$endDate', '$endTime', '$eventType')";

    

    if (
        (!empty($_POST['programNum'])) ||
        !empty($_POST['startDate']) ||
        !empty($_POST['startTime']) ||
        !empty($_POST['location']) ||
        !empty($_POST['endDate']) ||
        !empty($_POST['endTime']) ||
        !empty($_POST['eventType'])
    ) 
        {

        // Execute the insert query
            if ($conn->query($insertQuery) === TRUE) {
                header("Location: eventmanagement.php?UIN=$UIN");
            } else {
                echo "Error inserting event: " . $conn->error;
            }
    } 
    else {
        header("Location: eventmanagement.php?UIN=$UIN");
    }


}

// Insert Attendee
if (isset($_POST['addAttendee'])) {
    // Retrieve form data
    $selectEventID = $_POST['eventId'];
    $studentUIN = $_POST['Addstudents'];
    $UIN = getUIN($conn, $selectEventID);

    // Validate and sanitize input if necessary

    // Check if the combination of Event_ID and UIN already exists
    $checkQuery = "SELECT * FROM Event_Tracking WHERE Event_ID = '$selectEventID' AND UIN = '$studentUIN'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Handle duplicate entry as an error (for example, redirect with an error message)
        header("Location: eventmanagement.php?UIN=$UIN&error=duplicate");
        exit();
    }

    // Construct the insert query for Event_Tracking table
    $insertTrackingQuery = "INSERT INTO Event_Tracking (Event_ID, UIN) 
                            VALUES ('$selectEventID', '$studentUIN')";

    if (
        (!empty($_POST['eventId'])) &&
        !empty($_POST['Addstudents'])
    ) {
        // Execute the insert query
        if ($conn->query($insertTrackingQuery) === TRUE) {
            header("Location: eventmanagement.php?UIN=$UIN");
            echo $insertTrackingQuery;
        } else {
            echo "Error inserting event: " . $conn->error;
        }
    } else {
        echo $insertTrackingQuery;
        echo "hi";
        //header("Location: eventmanagement.php?UIN=$UIN");
    }
}

// Delete Attendee
if (isset($_POST['deleteAttendee'])) {
    // Retrieve form data
    $selectEventID = $_POST['deleteId'];
    $studentUIN = $_POST['Deletestudents'];
    $UIN = getUIN($conn, $selectEventID);

    // Validate and sanitize input if necessary

    // Check if the combination of Event_ID and UIN exists
    $checkQuery = "SELECT * FROM Event_Tracking WHERE Event_ID = '$selectEventID' AND UIN = '$studentUIN'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows === 0) {
        // Handle the case where the combination doesn't exist (for example, redirect with an error message)
        header("Location: eventmanagement.php?UIN=$UIN&error=not_found");
        exit();
    }

    // Construct the delete query for Event_Tracking table
    $deleteTrackingQuery = "DELETE FROM Event_Tracking WHERE Event_ID = '$selectEventID' AND UIN = '$studentUIN'";

    // Execute the delete query
    if ($conn->query($deleteTrackingQuery) === TRUE) {
        header("Location: eventmanagement.php?UIN=$UIN");
    } else {
        echo "Error deleting student: " . $conn->error;
    }
}


// Update Event
function eventDropDown($conn) {
    $query = "SELECT * FROM Events";
    $result = $conn->query($query);

    $eventIds = [];
    while ($row = $result->fetch_assoc()) {
        $eventIds[] = $row;
    }

    return $eventIds;
}

// Update Event
if (isset($_POST['updateEventBtn'])) {
    $selectedEventID = $_POST['UpdateeventId'];
    $UIN = getUIN($conn, $selectedEventID);
    // Initialize an empty array to store update assignments
    $updateAssignments = [];

    // Check if each parameter is set and not empty/null, then add it to the update assignments
    if (!empty($_POST['updatedProgramNum']) || $_POST['updatedProgramNum'] == 0) {
        $updatedProgramNum = $_POST['updatedProgramNum'];
        // Validate and sanitize $updatedProgramNum if necessary
        $updateAssignments[] = "Program_Num = '$updatedProgramNum'";
    }

    if (!empty($_POST['updatedStartDate'])) {
        $updatedStartDate = $_POST['updatedStartDate'];
        // Validate and sanitize $updatedStartDate if necessary
        $updateAssignments[] = "Start_Date = '$updatedStartDate'";
    }

    if (!empty($_POST['updatedStartTime'])) {
        $updatedStartTime = $_POST['updatedStartTime'];
        // Validate and sanitize $updatedStartTime if necessary
        $updateAssignments[] = "Start_Time = '$updatedStartTime'";
    }

    if (!empty($_POST['updatedLocation'])) {
        $updatedLocation = $_POST['updatedLocation'];
        // Validate and sanitize $updatedLocation if necessary
        $updateAssignments[] = "Location = '$updatedLocation'";
    }

    if (!empty($_POST['updatedEndDate'])) {
        $updatedEndDate = $_POST['updatedEndDate'];
        // Validate and sanitize $updatedEndDate if necessary
        $updateAssignments[] = "End_Date = '$updatedEndDate'";
    }

    if (!empty($_POST['updatedEndTime'])) {
        $updatedEndTime = $_POST['updatedEndTime'];
        // Validate and sanitize $updatedEndTime if necessary
        $updateAssignments[] = "End_Time = '$updatedEndTime'";
    }

    if (!empty($_POST['updatedEventType'])) {
        $updatedEventType = $_POST['updatedEventType'];
        // Validate and sanitize $updatedEventType if necessary
        $updateAssignments[] = "Event_Type = '$updatedEventType'";
    }


    // Construct the update query
    $updateQuery = "UPDATE Events SET " . implode(', ', $updateAssignments) . " WHERE Event_ID = $selectedEventID";
    // Check if at least one of the fields is set and not empty/null
    if (
        (!empty($_POST['updatedProgramNum']) || $_POST['updatedProgramNum'] == 0) ||
        !empty($_POST['updatedStartDate']) ||
        !empty($_POST['updatedStartTime']) ||
        !empty($_POST['updatedLocation']) ||
        !empty($_POST['updatedEndDate']) ||
        !empty($_POST['updatedEndTime']) ||
        !empty($_POST['updatedEventType'])
    ) 
        {
        $anyFieldSet = true;
        // Execute the update query
        if ($conn->query($updateQuery) === TRUE && $anyFieldSet === true) {
            header("Location: eventmanagement.php?UIN=$UIN");
            echo $UIN;
        } else {
            echo "Error updating event: " . $conn->error;
        }
    } 
    else {
        $anyFieldSet = false;
        header("Location: eventmanagement.php?UIN=$UIN");
    }


    
}


// // Retrieve Event Information
// $events = getEvents($conn);
$programs = getPrograms($conn);
$eventIds = eventDropDown($conn);
$students = getStudents($conn);


// Delete Event
if (isset($_POST['deleteEventBtn'])) {
    // Retrieve form data
    $selectedEventID = $_POST['DeleteeventId'];
    $UIN = getUIN($conn, $selectedEventID);
    // Validate and sanitize input if necessary

    // Delete all instances of the event from Event_Tracking table
    $deleteTrackingQuery = "DELETE FROM Event_Tracking WHERE Event_ID = '$selectedEventID'";

    // Execute the delete query for Event_Tracking table
    if ($conn->query($deleteTrackingQuery) === TRUE) {
        // Now, delete the event from Events table
        $deleteEventQuery = "DELETE FROM Events WHERE Event_ID = '$selectedEventID'";

        // Execute the delete query for Events table
        if ($conn->query($deleteEventQuery) === TRUE) {
            header("Location: eventmanagement.php?UIN=$UIN");
        } else {
            echo "Error deleting event: " . $conn->error;
        }
    } else {
        echo "Error deleting event tracking entries: " . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>



