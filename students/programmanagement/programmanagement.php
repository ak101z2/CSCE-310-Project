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
    $sql = "SELECT DISTINCT p.Program_Num, p.Name 
            FROM Programs p
            LEFT JOIN Applications a ON p.Program_Num = a.Program_Num AND a.UIN = '$UIN'
            WHERE COALESCE(p.IsVisible, 1) = 1 AND a.UIN IS NULL";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $programOptions .= "<option value='{$row['Program_Num']}'>{$row['Name']}</option>";
        }
    }

    $userProgramOptions = "";
    $sqlUserPrograms = "SELECT DISTINCT a.Program_Num, p.Name 
                        FROM Applications a 
                        JOIN Programs p ON a.Program_Num = p.Program_Num
                        WHERE a.UIN = '$UIN' AND p.IsVisible = 1";
    $resultUserPrograms = $conn->query($sqlUserPrograms);
    
    if ($resultUserPrograms->num_rows > 0) {
        while ($rowUserPrograms = $resultUserPrograms->fetch_assoc()) {
            $userProgramOptions .= "<option value='{$rowUserPrograms['Program_Num']}'>{$rowUserPrograms['Name']}</option>";
        }
    }
  
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Information Management</title>
    <link rel="stylesheet" href="../template.css">

    <script>
        function handleFormSubmission(form) {
            // Get the form data using FormData
            const formData = new FormData(form);

            // Perform an AJAX request to submit the form data to student_process.php
            fetch('student_program.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.text())
                .then(data => {
                    // Handle the response data here (if needed)
                    // For now, you can log it to the console
                    console.log(data);

                    // Check if the response data contains application details
                    if (data.includes('Application Details')) {
                        // Update the content on the page with the response data
                        document.getElementById('applicationDetails').innerHTML = data;
                    } else {
                        // Optionally, you can update the success or error message on the page
                        if (data.startsWith('Error')) {
                            // Display error message
                            console.error(data);
                        } else {
                            // Display success message
                            console.log('Form submitted successfully');

                            // Check the action to determine whether to reload the page
                            const action = formData.get('action');
                            if (action === 'insert' || action === 'update' || action === 'delete') {
                                location.reload();
                            }
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
    <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Application Information Management</a></li>
    <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
    <li><a href="../document.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
    <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

<form>
    <h1> Application Information Management </h1>
</form>

<!-- Insert Form -->
<form id="insertForm" onsubmit="handleFormSubmission(this); return false;">
    <h3>Submit Application</h3>
    <label for="program_num">Program Name:</label>
    <select name="program_num" required>
        <option value="" disabled selected>Select Program</option>
        <?php echo $programOptions; ?>
    </select>
    <!-- Add the hidden 'uin' field -->
    <input type="hidden" name="uin" value="<?php echo $UIN; ?>">
    
    <!-- Display questions for Uncom_Cert and Com_Cert -->
    <p>Are you currently enrolled in other uncompleted certifications sponsored by the Cybersecurity Center? (Leave blank or provide details)</p>
    <textarea name="uncom_cert"></textarea>

    <p>Have you completed any cybersecurity industry certifications via the Cybersecurity Center? (Leave blank or provide details)</p>
    <textarea name="com_cert"></textarea>

    <p> Insert Purpose Statement<p>
    <textarea name="purpose_statement" required></textarea>
    
    <input type="hidden" name="action" value="insert">
    <button type="submit">Submit Application</button>
</form>

<!-- Update Form -->
<form id="updateForm" onsubmit="handleFormSubmission(this); return false;">
    <h3>Edit Application</h3>
    <label for="program_num">Program Name:</label>
    <select name="program_num" required>
        <option value="" disabled selected>Select Program</option>
        <?php echo empty($userProgramOptions) ? "<option value='' disabled selected>No Programs Applied</option>" : $userProgramOptions; ?>
    </select>
    <!-- Add the hidden 'uin' field -->
    <input type="hidden" name="uin" value="<?php echo $UIN; ?>">
    
    <!-- Display questions for Uncom_Cert and Com_Cert -->
    <p>Are you currently enrolled in other uncompleted certifications sponsored by the Cybersecurity Center? (Leave blank or provide details)</p>
    <textarea name="uncom_cert"></textarea>

    <p>Have you completed any cybersecurity industry certifications via the Cybersecurity Center? (Leave blank or provide details)</p>
    <textarea name="com_cert"></textarea>

    <p> Insert Purpose Statement<p>
    <textarea name="purpose_statement"></textarea>
    
    <input type="hidden" name="action" value="update">
    <button type="submit">Update Application</button>
</form>

<!-- Select Form -->
<form id="selectForm" onsubmit="handleFormSubmission(this); return false;">
    <h3>Review Application</h3>
    <label for="program_num">Program Name:</label>
    <select name="program_num" required>
        <option value="" disabled selected>Select Program</option>
        <?php echo $userProgramOptions; ?>
    </select>
    <input type="hidden" name="uin" value="<?php echo $UIN; ?>"> <!-- Add this line -->
    <input type="hidden" name="action" value="select">
    <button type="submit">Review Application</button>
</form>

<form>
<div id="applicationDetails"></div>
</form>

<!-- Delete Form -->
<form id="deleteForm" onsubmit="handleFormSubmission(this); return false;">
    <h3>Delete Application</h3>
    <label for="program_num">Program Name:</label>
    <select name="program_num" required>
        <option value="" disabled selected>Select Program</option>
        <?php echo $userProgramOptions; ?>
    </select>
    <!-- Add the hidden 'uin' field -->
    <input type="hidden" name="uin" value="<?php echo $UIN; ?>">
    <input type="hidden" name="action" value="delete">
    <button type="submit">Delete Application</button>
</form>

<!-- Display error message if nothing is selected -->
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        if ($action === 'update' || $action === 'select' || $action === 'delete') {
            $selectedApplication = $_POST['app_num'];

            if (empty($selectedApplication)) {
                echo "<p style='color: red;'>Error: Please select an application.</p>";
            }
        }
    }
?>
</body>
</html>