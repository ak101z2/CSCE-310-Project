<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  session_start();
  if ($_SESSION['User_Type'] != "Admin") {
    header("Location: ../students/authentication.php?UIN=$UIN");
  }
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Admin Edit Page</title>
      <link rel="stylesheet" href="authEditDash.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="authDisableAccount_Backend.php?UIN=<?php echo $UIN; ?>&Type=UIN" method="post">
        <h1>Disable User Account</h1>
        <hr>

        <div class="container">
            <label for="DisableAccount"><b>UIN</b></label>
            <input type="text" placeholder="Disable Account by User by UIN" name="DisableAccount" id="DisableAccount" required>
            <button type="submit" class="search">Search</button>
        </div>
        <hr>
    </form>
  </body>
</html>