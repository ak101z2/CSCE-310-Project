<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
?>

<?php
  $servername = "localhost";
  $username = "user";
  $password = "pass1";
  $dbname = "csce310project";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT First_Name, Last_Name, UIN FROM `users`";
  $students = $conn->query($sql);

  $sql = "SELECT `Name` FROM `programs`";
  $programs = $conn->query($sql);

  $sql = "SELECT Class_ID, `Name` FROM `classes`";
  $classes = $conn->query($sql);

  $sql = "SELECT Cert_ID, `Name` FROM `certification`";
  $certifications = $conn->query($sql);

  $conn->close();
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Progress Tracking</title>
      <link rel="stylesheet" href="template.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../login.php">Logout</a></li>
    </ul>

    <form action="progresstracking/progresstracking_backend.php" method="post">
      <h1> Progress Tracking </h1>
        <label for="student">Student:</label>
          <select name="student" id="student">
            <?php
              if ($students->num_rows > 0) {
                  while ($row = $students->fetch_assoc()) {
                    echo "<option value='" . $row['UIN'] . "'>" . $row['First_Name'] . " " . $row['Last_Name'] . ": " . $row['UIN'] . "</option>";
                  }
              } else {
                  echo "<option value=''>No students found</option>";
              }
            ?>
          </select>
        <br>
        <br>
        
        <div class="column">
          <h2> Record Student Progress </h2>
            <label for="student">Program:</label>
              <select name="student" id="student">
              <?php
                  if ($programs->num_rows > 0) {
                      while ($row = $programs->fetch_assoc()) {
                          echo "<option value=''>" . $row['Name'] . "</option>";
                      }
                  } else {
                      echo "<option value=''>No programs found</option>";
                  }
                ?>
              </select>
            <br>
            <input type="submit" value="Record">
            <br><br>
            <label for="student">Class:</label>
              <select name="student" id="student">
              <?php
                  if ($classes->num_rows > 0) {
                      while ($row = $classes->fetch_assoc()) {
                          echo "<option value=''>" . $row['Name'] . "</option>";
                      }
                  } else {
                      echo "<option value=''>No programs found</option>";
                  }
                ?>
              </select>
            <br>
            <label for="dog-names">Status</label> 
                <select name="dog-names" id="dog-names"> 
                    <option value="rigatoni">Not Enrolled</option> 
                    <option value="dave">Upcoming</option> 
                    <option value="pumpernickel">In Progress</option> 
                    <option value="reeses">Completed</option> 
                </select>
            <br>
            <label for="dog-names">Semester</label> 
                <select name="dog-names" id="dog-names"> 
                    <option value="fall">Fall</option> 
                    <option value="spring">Spring</option> 
                </select>
            <br>
            <label for="dog-names">Year</label> 
                <select name="dog-names" id="dog-names"> 
                    <option value="rigatoni">2022</option> 
                    <option value="dave">2023</option> 
                    <option value="pumpernickel">2024</option> 
                    <option value="reeses">2025</option> 
                </select>
            <br>
            <input type="submit" value="Record">
            <br>
            <br>
            <label for="student">Certification:</label>
            <select name="student" id="student">
            <?php
                if ($certifications->num_rows > 0) {
                    while ($row = $certifications->fetch_assoc()) {
                        echo "<option value=''>" . $row['Name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No programs found</option>";
                }
              ?>
            </select>
            <br>
            <label for="dog-names">Status</label> 
                <select name="dog-names" id="dog-names"> 
                    <option value="rigatoni">Not Enrolled</option> 
                    <option value="dave">Upcoming</option> 
                    <option value="pumpernickel">In Progress</option> 
                    <option value="reeses">Completed</option> 
                </select>
            <br>
            <label for="additionalInfo">Training Status:</label>
              <input type="text" name="additionalInfo" id="additionalInfo">
            <br>
            <label for="dog-names">Semester</label> 
                <select name="dog-names" id="dog-names"> 
                    <option value="fall">Fall</option> 
                    <option value="spring">Spring</option> 
                </select>
            <br>
            <label for="dog-names">Year</label> 
                <select name="dog-names" id="dog-names"> 
                    <option value="rigatoni">2022</option> 
                    <option value="dave">2023</option> 
                    <option value="pumpernickel">2024</option> 
                    <option value="reeses">2025</option> 
                </select>
            <br>
            <input type="submit" value="Record">
        </div>
        <div class="column">
          <h2> Edit Student Progress </h2>
        </div>
        <div class="column">
          <h2> Delete Student Progress </h2>
        </div>
    </form>

  </body>
</html>