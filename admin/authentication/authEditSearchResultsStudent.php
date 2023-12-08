<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  
  $type = isset($_GET['Type']) ? $_GET['Type'] : ''; // Gets Search Type
  $value = $_SESSION["$type"];
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Edit User UIN : <?php echo $UIN; ?></title>
      <link rel="stylesheet" href="authEditSearchResults.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>


<?php
    $servername = "localhost";
    $username = "user";
    $password = "pass1";
    $dbname = "csce310project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    if ($type == "UIN") {
        $sql = "SELECT * FROM `users` WHERE UIN = $value";

    } else if ($type == "Username") {
        $sql = "SELECT * FROM `users` WHERE Username = '$value'";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: authentication.php?UIN=$UIN");
        exit;
      }

    $sql = "SELECT * FROM `users` WHERE UIN = " . $row['UIN'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: authentication.php?UIN=$UIN");
        exit;
      }
?>

<form action="authEditStudent_Backend.php?UIN=<?php echo $UIN; ?>" method="post">
    <h1>Edit User</h1>
    <hr>


<div class="container">

    <div class = "hold">
        <label for="UIN"><b>UIN</b></label>
        <input type="text" value="<?php echo $row['UIN']; ?>" placeholder="Enter UIN" name="UIN" id="UIN" required>


        <label for="First_Name"><b>First Name</b></label>
        <input type="text" value="<?php echo $row['First_Name']; ?>" placeholder="Enter First Name" name="First_Name" id="First_Name" required>

        <label for="M_Initial"><b>M Initial</b></label>
        <input type="text" value="<?php echo $row['M_Initial']; ?>" placeholder="Enter M Initial" name="M_Initial" id="M_Initial" required>
    </div>

    <div class = "hold">
        <label for="Last_Name"><b>Last Name</b></label>
        <input type="text" value="<?php echo $row['Last_Name']; ?>" placeholder="Enter Last Name" name="Last_Name" id="Last_Name" required>

        <label for="Username"><b>Username</b></label>
        <input type="text" value="<?php echo $row['Username']; ?>" placeholder="Enter Username" name="Username" id="Username" required>
    </div>

    <div class = "hold">
        <label for="Passwords"><b>Passwords</b></label>
        <input type="text" value="<?php echo $row['Passwords']; ?>"placeholder="Enter Passwords" name="Passwords" id="Passwords" required>

        <label for="Email"><b>Email</b></label>
        <input type="text" value="<?php echo $row['Email']; ?>"placeholder="Enter Email" name="Email" id="Email" required>

        <label for="Discord_Name"><b>Discord Name</b></label>
        <input type="text" value="<?php echo $row['Discord_Name']; ?>"placeholder="Enter Discord Name" name="Discord_Name" id="Discord_Name" required>

        <label for="User_Type"><b>User Type</b></label>
        <select name="User_Type" id="User_Type">
            <option value="Admin">Admin</option>
            <option value="CollegeStudent">CollegeStudent</option>
            <option value="NonCollegeStudent">NonCollegeStudent</option>
        </select>
    </div>

<hr>
<?php

    if($row['User_Type'] == "Admin") {
        exit;
    }
    $sql = "SELECT * FROM `college_student` WHERE UIN = " . $row['UIN'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: authentication.php?UIN=$UIN");
        exit;
      }
?>


    <div class = "hold">
        <label for="Gender"><b>Gender</b></label>
        <input type="text" value="<?php echo $row['Gender']; ?>" placeholder="Enter Gender" name="Gender" id="Gender" required>

        <label for="Hispanic_Latino"><b>Hispanic Latino</b></label>
        <input type="text" value="<?php echo $row['Hispanic_Latino']; ?>" placeholder="Enter Hispanic Latino" name="Hispanic_Latino" id="Hispanic_Latino" required>
    </div>

    <div class = "hold">
        <label for="Race"><b>Race</b></label>
        <input type="text" value="<?php echo $row['Race']; ?>" placeholder="Enter Race" name="Race" id="Race" required>

        <label for="US_Citizen"><b>US Citizen</b></label>
        <input type="text" value="<?php echo $row['US_Citizen']; ?>" placeholder="Enter US Citizen" name="US_Citizen" id="US_Citizen" required>
    </div>

    <div class = "hold">
        <label for="First_Generation"><b>First Generation</b></label>
        <input type="text" value="<?php echo $row['First_Generation']; ?>"placeholder="Enter First Generation" name="First_Generation" id="First_Generation" required>

        <label for="DoB"><b>Date of Birth</b></label>
        <input type="text" value="<?php echo $row['DoB']; ?>"placeholder="Enter Date of Birth" name="DoB" id="DoB" required>

        <label for="GPA"><b>GPA</b></label>
        <input type="text" value="<?php echo $row['GPA']; ?>"placeholder="Enter GPA" name="GPA" id="GPA" required>
    </div>

    <div class = "hold">
        <label for="Major"><b>Major</b></label>
        <input type="text" value="<?php echo $row['Major']; ?>" placeholder="Enter Major" name="Major" id="Major" required>

        <label for="Minor1"><b>Minor 1</b></label>
        <input type="text" value="<?php echo $row['Minor1']; ?>" placeholder="Enter Minor 1" name="Minor1" id="Minor1" required>
    </div>

    <div class = "hold">
        <label for="Minor2"><b>Minor 2</b></label>
        <input type="text" value="<?php echo $row['Minor2']; ?>" placeholder="Enter Minor2" name="Minor2" id="Minor2" required>

        <label for="Expected_Graduation"><b>Expected Graduation Year</b></label>
        <input type="text" value="<?php echo $row['Expected_Graduation']; ?>" placeholder="Enter Expected Graduation" name="Expected_Graduation" id="Expected_Graduation" required>
    </div>

    <div class = "hold">
        <label for="School"><b>School</b></label>
        <input type="text" value="<?php echo $row['School']; ?>" placeholder="Enter School" name="School" id="School" required>

        <label for="Classification"><b>Classification</b></label>
        <input type="text" value="<?php echo $row['Classification']; ?>" placeholder="Enter Classification" name="Classification" id="Classification" required>
    </div>

    <div class = "hold">
        <label for="Phone"><b>Phone</b></label>
        <input type="text" value="<?php echo $row['Phone']; ?>" placeholder="Enter Phone" name="Phone" id="Phone" required>

        <label for="Student_Type"><b>Student Type</b></label>
        <input type="text" value="<?php echo $row['Student_Type']; ?>" placeholder="Enter Student Type" name="Student_Type" id="Student_Type" required>
    </div>
</div>

<hr>

<button type="submit" class="registerbtn">Update</button>

</form>
