<?php
  $UINGET = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  session_start();
  if ($_SESSION['User_Type'] != "Admin") {
    header("Location: ../students/authentication.php?UIN=$UINGET");
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
      <li><a href="authentication.php?UIN=<?php echo $UINGET; ?>">Authentication</a></li>
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="authEditSearchResults_Backend.php?UIN=<?php echo $UINGET; ?>&Type=UIN" method="post">
        <h1>Edit User</h1>
        <hr>

        <div class="container">
            <label for="UIN"><b>UIN</b></label>
            <input type="text" placeholder="Search for User by UIN" name="UIN" id="UIN" required>
            <button type="submit" class="search">Search</button>
        </div>
        <hr>
    </form>

    <form action="authEditSearchResults_Backend.php?UIN=<?php echo $UINGET; ?>&Type=Username" method="post">
        <div class="container">
            <label for="Username"><b>Username</b></label>
            <input type="text" placeholder="Search for User by Username" name="Username" id="Username" required>
            <button type="submit" class="search">Search</button>
        </div> 
        <hr>

    </form>

  </body>
</html>