<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN

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
      <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
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
      <a href="authViewSearchResults.php?UIN=<?php echo $UIN; ?>">View Personal Information</a>
      <a href="authEditSearchResultsStudent.php?UIN=<?php echo $UIN; ?>">Edit Personal Information</a>
      <a href="authDisableAccountStudent.php?UIN=<?php echo $UIN; ?>">Disable Account</a>
    </div>

  </body>
</html>