<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  session_start();
  if ($_SESSION['User_Type'] != "Admin") {
    header("Location: ../students/authentication.php?UIN=$UIN");
  }
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
    $dbname = "csce310project_final";

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
</div>

<hr>

<button type="submit" class="registerbtn">Update</button>

</form>
