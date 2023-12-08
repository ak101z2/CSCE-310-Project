<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
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
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Application Information Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../document.php?UIN=<?php echo $UIN; ?>">Document Management</a></li>
      <li style="float:right"><a href="../login.php">Logout</a></li>
    </ul>

    <form action="#" method="post">
      <h1> Disable Account </h1>

      <h1> ARE YOU SURE YOU WANT TO DISABLE YOUR ACCOUNT </h1>
    </form>
    <?php 
        session_start();
        $_SESSION['DisableAccount'] = $UIN;
    ?>

    <div class="buttons">
      <a href="authDisableAccount_Backend.php?UIN=<?php echo $UIN; ?>">YES</a>
      <a href="authentication.php?UIN=<?php echo $UIN; ?>">NO</a>
    </div>

  </body>
</html>