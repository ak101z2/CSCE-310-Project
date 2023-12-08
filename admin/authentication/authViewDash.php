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
      <title>Event Management</title>
      <link rel="stylesheet" href="authViewDash.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="authViewSearchResults.php?UIN=<?php echo $UIN; ?>&Type=UIN" method="post">
        <h1>View User</h1>
        <hr>

        <div class="container">
            <label for="UIN"><b>UIN</b></label>
            <input type="text" placeholder="Search for User by UIN" name="UIN" id="UIN" required>
            <button type="submit" class="search">Search</button>
        </div>
        <hr>
    </form>

    <form action="authViewSearchResults.php?UIN=<?php echo $UIN; ?>&Type=Username" method="post">
        <div class="container">
            <label for="Username"><b>Username</b></label>
            <input type="text" placeholder="Search for User by Username" name="Username" id="Username" required>
            <button type="submit" class="search">Search</button>
        </div> 
        <hr>

    </form>

    <form action="authViewSearchResults.php?UIN=<?php echo $UIN; ?>&Type=User_Type" method="post">
        <h1>View by User Type</h1>
        <hr>

        <div class="container">
            <label for="User_Type"><b>User Type</b></label>
            <select name="User_Type" id="User_Type">
                <option value="Admin">Admin</option>
                <option value="CollegeStudent">CollegeStudent</option>
                <option value="NonCollegeStudent">NonCollegeStudent</option>
            </select>
            <button type="submit" class="search">Search</button>
        </div> 
        <hr>

    </form>

  </body>
</html>