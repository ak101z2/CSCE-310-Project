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
      <title>Authentication</title>
      <link rel="stylesheet" href="authCreate.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="authCreateAdmin_Backend.php?UIN=<?php echo $UIN; ?>" method="post">
    <h1>Add new Admin</h1>
    <hr>

    <div class="container">

        <div class = "hold">
            <label for="First_Name"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="First_Name" id="First_Name" required>

            <label for="M_Initial"><b>M Initial</b></label>
            <input type="text" placeholder="Enter M Initial" name="M_Initial" id="M_Initial" required>
        </div>

        <div class = "hold">
            <label for="Last_Name"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="Last_Name" id="Last_Name" required>

            <label for="Username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="Username" id="Username" required>
        </div>

        <div class = "hold">
            <label for="Passwords"><b>Passwords</b></label>
            <input type="text" placeholder="Enter Passwords" name="Passwords" id="Passwords" required>
        </div>
        <div class = "hold">
            <label for="Email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="Email" id="Email" required>

            <label for="Discord_Name"><b>Discord Name</b></label>
            <input type="text" placeholder="Enter Discord Name" name="Discord_Name" id="Discord_Name" required>
        </div>
    </div>

    <hr>

    <button type="submit" class="registerbtn">Register</button>

    </form>

  </body>
</html>