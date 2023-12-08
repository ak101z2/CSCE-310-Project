<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Event Management</title>
      <link rel="stylesheet" href="template.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Application Information Management</a></li>
      <li><a href="progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Document Management</a></li>
      <li style="float:right"><a href="../login.php">Logout</a></li>
    </ul>

    <form action="eventmanagement_backend.php" method="post">
      <h1> Event Management </h1>
    </form>

  </body>
</html>