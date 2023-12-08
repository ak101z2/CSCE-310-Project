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
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="authDeleteInstance.php?UIN=<?php echo $UIN; ?>&Type=UIN" method="post">
        <h1>Delete User Account</h1>
        <hr>

        <div class="container">
            <label for="DeleteAccount"><b>UIN</b></label>
            <input type="text" placeholder="Delete Account by User by UIN" name="DeleteAccount" id="DeleteAccount" required>
            <button type="submit" class="search">Search</button>
        </div>
        <hr>
    </form>
  </body>
</html>