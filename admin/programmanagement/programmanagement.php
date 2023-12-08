<?php

//Coded by: Ryan Paul

  $servername = "localhost";
  $username = "user";
  $password = "pass1";
  $dbname = "csce310project";


  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  
  $programOptions = "";
  $sql = "SELECT Program_Num, Name FROM Programs";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $programOptions .= "<option value='{$row['Program_Num']}'>{$row['Name']}</option>";
      }
  }
?>


<html>
  <head>
    <meta charset="UTF-8">
    <title>Program Management</title>
    <link rel="stylesheet" href="../template.css">

    <script>
      function handleFormSubmission(form) {
      // Get the form data using FormData
      const formData = new FormData(form);

      // Perform an AJAX request to submit the form data to admin_process.php
      fetch('admin_program.php', {
          method: 'POST',
          body: formData,
      })
          .then(response => response.text())
          .then(data => {
              // Handle the response data here
              console.log(data);

              // Check the action to determine the behavior
              const action = formData.get('action');

              if (action === 'select') {
                  // Display the report in a new div
                  const reportDiv = document.getElementById('reportDiv');
                  reportDiv.innerHTML = data;
              } else if (data.startsWith('Error')) {
                  // Display error message
                  console.error(data);
              } else {
                  // Display success message
                  console.log('Form submitted successfully');

                  // Check if the action is add, edit, or remove before reloading
                  if (action === 'insert' || action === 'update' || action === 'delete') {
                      location.reload();
                  }
              }
          })
          .catch(error => {
              // Handle any errors that occurred during the fetch
              console.error('Error during form submission:', error);
          });
      }
    </script>
  </head>
  <body>

    <ul>
      <li><a href="../authentication/authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="../progresstracking/progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form >
      <h1> Program Management </h1>
    </form>

    <!-- Insert Form -->
    <form id="insertForm" onsubmit="handleFormSubmission(this); return false;">
        <h3>Add a New Program</h3>
        <input type = "text" name ="UIN" value="<?php echo $UIN; ?>" style = "display:none;">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <input type="hidden" name="action" value="insert">
        <button type="submit">Add Program</button>
    </form>


    <!-- Update Form -->
    <form id="updateForm" onsubmit="handleFormSubmission(this); return false;">
        <h3>Edit Existing Program</h3>
        <label for="program_num">Program Number:</label>
        <select name="program_num" required>
            <option value="" disabled selected>Select Program</option>
            <?php echo $programOptions; ?>
        </select>
        <label for="name">New Name:</label>
        <input type="text" name="name">
        <label for="description">New Description:</label>
        <textarea name="description"></textarea>

        <!-- Use a single radio button for "Grant Access" without a specific value -->
        <label for="grant_access">Grant Access:</label>
        <input type="radio" name="grant_access"> Yes

        <input type="hidden" name="action" value="update">
        <button type="submit">Update Program</button>
    </form>


    <!-- Select Form -->
    <form id="selectForm" onsubmit="handleFormSubmission(this); return false;">
        <h3>Create Report for a Program</h3>
        <label for="program_num">Program Number:</label>
        <select name="program_num" required>
            <option value="" disabled selected>Select Program</option>
            <?php echo $programOptions; ?>
        </select>
        <input type="hidden" name="action" value="select">
        <button type="submit">Generate Report</button>
    </form>

    <!-- Add a new div to display the report -->
    <form>
    <div id="reportDiv"></div>
    </form>

    <!-- Delete Form -->
    <form id="deleteForm" onsubmit="handleFormSubmission(this); return false;">
        <h3>Remove Program</h3>
        <label for="program_num">Program Number:</label>
        <select name="program_num" required>
            <option value="" disabled selected>Select Program</option>
            <?php echo $programOptions; ?>
        </select>
        <input type="radio" name="delete_type" value="remove_access" checked> Remove Access
        <input type="radio" name="delete_type" value="full_delete"> Full Delete
        <input type="hidden" name="action" value="delete">
        <button type="submit">Delete Program</button>
    </form>

    <!-- Display error message if nothing is selected -->
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];

            if ($action === 'update' || $action === 'select' || $action === 'delete') {
                $selectedProgram = $_POST['program_num'];

                if (empty($selectedProgram)) {
                    echo "<p style='color: red;'>Error: Please select a program.</p>";
                }
            }
        }
    ?>
  </body>
</html>