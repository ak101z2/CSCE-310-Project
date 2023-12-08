<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  session_start();
  if ($_SESSION['User_Type'] != "Admin") {
    header("Location: ../students/authentication.php?UIN=$UIN");
  }

  $servername = "localhost";
  $username = "user";
  $password = "pass1";
  $dbname = "csce310project";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM auth_view WHERE UIN = $UIN";
  $result = $conn->query($sql);

?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Authentication</title>
      <link rel="stylesheet" href="authentication.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="#" method="post">
      <h1> Authentication Page </h1>
      <?php
        while ($row = $result->fetch_assoc()) {
          echo "<h2>Welcome: " . $row['First_Name'] . " " . $row['Last_Name'] . "<br></h2>";
          echo "<h3>UIN: " . $row['UIN'] . "<br></h3>";
          echo "<hr>";
        }
      ?>
    </form>

    <div class="buttons">
      <a href="authCreateAdmin.php?UIN=<?php echo $UIN; ?>">Create New Admin</a>
      <a href="authCreateStudent.php?UIN=<?php echo $UIN; ?>">Create New Student</a>
      <a href="authViewDash.php?UIN=<?php echo $UIN; ?>">View Users</a>
      <a href="authEditDash.php?UIN=<?php echo $UIN; ?>">Edit User</a>
      <a href="authDisableAccountDash.php?UIN=<?php echo $UIN; ?>">Disable User Account</a>
      <a href="authDeleteInstanceDash.php?UIN=<?php echo $UIN; ?>">Delete User Account</a>
    </div>

  </body>
</html>