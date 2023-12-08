<?php
//Written by Maharshi Rathod
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
    <link rel="stylesheet" href="template.css">
</head>

<body>
<ul>
    <li><a href="authentication/authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
    <li><a href="programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
    <li><a href="progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
    <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
    <li style="float:right"><a href="../login.php">Logout</a></li>
</ul>

<form action="eventmanagement_backend.php" method="post">
    <h1> Event Management </h1>
    
    <!-- Insert Event Section -->
    <h2>Insert Event</h2>
    <label for="programNum">Program Number:</label>
    <?php
    include 'eventmanagement_backend.php'; // Make sure to include your database connection file
    ?>
    <select name="programNum" id="programNum" required>
        <?php
        
        // Populate dropdown dynamically with existing programs
        foreach ($programs as $program) {
            echo '<option value="' . $program['Program_Num'] . '">' . $program['Name'] . '</option>';
        }
        ?>
    </select>
    <input type="text" name="UIN" value="<?php echo $UIN; ?>" style="display:none;">
    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate">
    <label for="startTime">Start Time:</label>
    <input type="time" id="startTime" name="startTime">
    <label for="location">Location:</label>
    <input type="text" id="location" name="location">
    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate">
    <label for="endTime">End Time:</label>
    <input type="time" id="endTime" name="endTime">
    <label for="eventType">Event Type:</label>
    <input type="text" id="eventType" name="eventType">
    <input type="submit" name="insertEvent" value="Insert Event">

    <!-- Update Event Section -->
    <h2>Update Event</h2>
    <label for="UpdateeventId">Event ID:</label>
    <select name="UpdateeventId" id="UpdateeventId" required>
        <?php
        foreach ($eventIds as $eventId) {
            echo '<option value="' . $eventId['Event_ID'] . '">' . $eventId['Event_Type'] . '</option>';
        }
        ?>
        </select>


        <label for="updatedProgramNum">Updated Program Number:</label>
        <select name="updatedProgramNum" id="updatedProgramNum">
            <option value="">Select Program</option>
            <?php
                // Populate dropdown dynamically with existing programs
                foreach ($programs as $program) {
                    echo '<option value="' . $program['Program_Num'] . '">' . $program['Name'] . '</option>';
                }
            ?>
        </select>

        <input type="text" name="UIN" value="<?php echo $UIN; ?>" style="display:none;">       
        <label for="updatedStartDate">Updated Start Date:</label>
        <input type="date" id="updatedStartDate" name="updatedStartDate">

        <label for="updatedStartTime">Updated Start Time:</label>
        <input type="time" id="updatedStartTime" name="updatedStartTime">

        <label for="updatedLocation">Updated Location:</label>
        <input type="text" id="updatedLocation" name="updatedLocation">

        <label for="updatedEndDate">Updated End Date:</label>
        <input type="date" id="updatedEndDate" name="updatedEndDate">

        <label for="updatedEndTime">Updated End Time:</label>
        <input type="time" id="updatedEndTime" name="updatedEndTime">

        <label for="updatedEventType">Updated Event Type:</label>
        <input type="text" id="updatedEventType" name="updatedEventType">

        <input type="submit" name="updateEventBtn" value="Update Event">


    <!-- Update Student Section -->
    <h2>Add Student Attendance</h2>
    <label for="eventId">Event ID:</label>
    <select name="eventId" id="eventId" required>
        <?php
        foreach ($eventIds as $eventId) {
            echo '<option value="' . $eventId['Event_ID'] . '">' . $eventId['Event_Type'] . '</option>';
        }
        ?>
        </select>


        <label for="Addstudents">Students:</label>
        <select name="Addstudents" id="Addstudents">
            <option value="">Select Student</option>
            <?php
                // Populate dropdown dynamically with existing programs
                foreach ($students as $student) {
                    echo '<option value="' . $student['UIN'] . '">' . $student['First_Name'] . '</option>';
                }
            ?>
        </select>

        <input type="submit" name="addAttendee" value="Add Student">
    
    <!-- Delete Student Section -->
    <h2>Delete Student Attendance</h2>
    <label for="deleteId">Event ID:</label>
    <select name="deleteId" id="deleteId" required>
        <?php
        foreach ($eventIds as $eventId) {
            echo '<option value="' . $eventId['Event_ID'] . '">' . $eventId['Event_Type'] . '</option>';
        }
        ?>
        </select>


        <label for="Deletestudents">Students:</label>
        <select name="Deletestudents" id="Deletestudents">
            <option value="">Select Student</option>
            <?php
                // Populate dropdown dynamically with existing programs
                foreach ($students as $student) {
                    echo '<option value="' . $student['UIN'] . '">' . $student['First_Name'] . '</option>';
                }
            ?>
        </select>

        <input type="submit" name="deleteAttendee" value="Delete Student">
    

    <!-- Retrieve Event Information Section -->
    <h2>Select Event:</h2>
    <label for="eventSelection">Event:</label>
    <select name="eventSelection" id="eventSelection" required>
        <option value="all" <?php echo ($_SESSION['selectedEventID'] === 'all') ? 'selected' : ''; ?>>All Events</option>
        <?php
        foreach ($eventIds as $eventId) {
            echo '<option value="' . $eventId['Event_ID'] . '" ' . ($_SESSION['selectedEventID'] === $eventId['Event_ID'] ? 'selected' : '') . '>' . $eventId['Event_Type'] . '</option>';
        }
        ?>
    </select>
    <input type="text" name="UIN" value="<?php echo $UIN; ?>" style="display:none;">
    <input type="submit" name="selectEvent" value="Select Event">

    <?php
    if (isset($_SESSION['Allevents'])) {
        $Allevents = $_SESSION['Allevents'];
    } elseif (isset($_SESSION['Oneevent'])) {
        $Oneevent = [$_SESSION['Oneevent']];
    }
    if (empty($Oneevent) && empty($Allevents)) {
        echo "<p>No events available</p>";
    }
    elseif(empty($Allevents)){
        $eventDetails = $Oneevent[0];
        echo '<table border="1">
                  <tr>
                      <th>User Name</th>
                      <th>Program Name</th>
                      <th>Start Date</th>
                      <th>Start Time</th>
                      <th>Location</th>
                      <th>End Date</th>
                      <th>End Time</th>
                      <th>Event Type</th>
                      <th>Attendees</th>
                  </tr>';

        echo "<tr>
                    <td>{$eventDetails['UserName']}</td>
                    <td>{$eventDetails['ProgramName']}</td>
                    <td>{$eventDetails['Start_Date']}</td>
                    <td>{$eventDetails['Start_Time']}</td>
                    <td>{$eventDetails['Location']}</td>
                    <td>{$eventDetails['End_Date']}</td>
                    <td>{$eventDetails['End_Time']}</td>
                    <td>{$eventDetails['Event_Type']}</td>
                    <td>{$eventDetails['Attendees']}</td>
                </tr>";
        
        echo '</table>';
    }
    elseif(empty($Oneevent)){
        echo '<table border="1">
                  <tr>
                      <th>User Name</th>
                      <th>Program Name</th>
                      <th>Start Date</th>
                      <th>Start Time</th>
                      <th>Location</th>
                      <th>End Date</th>
                      <th>End Time</th>
                      <th>Event Type</th>
                      <th>Attendees</th>
                  </tr>';
        foreach ($Allevents as $event) {
            echo "<tr>
                      <td>{$event['UserName']}</td>
                      <td>{$event['ProgramName']}</td>
                      <td>{$event['Start_Date']}</td>
                      <td>{$event['Start_Time']}</td>
                      <td>{$event['Location']}</td>
                      <td>{$event['End_Date']}</td>
                      <td>{$event['End_Time']}</td>
                      <td>{$event['Event_Type']}</td>
                      <td>{$event['Attendees']}</td>
                  </tr>";
        }
        echo '</table>';
        
    } 
    session_destroy(); // End the current session
    ?>


    <!-- Delete Event Section -->
    <h2>Delete Event</h2>
    <label for="DeleteeventId">Event ID:</label>
    <select name="DeleteeventId" id="DeleteeventId" required>
        <?php
        foreach ($eventIds as $eventId) {
            echo '<option value="' . $eventId['Event_ID'] . '">' . $eventId['Event_Type'] . '</option>';
        }
        ?>
        </select>
        
        <input type="submit" name="deleteEventBtn" value="Delete Event">
</form>
</body>
</html>
