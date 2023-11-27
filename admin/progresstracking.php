<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Progress Tracking</title>
      <link rel="stylesheet" href="template.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="login.php">Logout</a></li>
    </ul>

    <form action="progresstracking_backend.php" method="post">
      <h1> Progress Tracking </h1>
        <h2> Programs </h2>
          <div class="column">
            <h3> Create a New Program </h3>
            <h3> Update an Existing Program </h3>
            <h3> View All Programs </h3>
            <h3> Delete a Program </h3>
          </div>
          <div class="column">
            <h3> Add Student to a Program </h3>
            <h3> View a Student's Programs </h3>
            <h3> Delete a Student's Program </h3>
          </div>
        <h2> Certifications </h2>
          <div class="column">
            <h3> Create a New Certification </h3>
            <h3> Update an Existing Certification </h3>
            <h3> View All Certifications </h3>
            <h3> Delete a Certification </h3>
          </div>
          <div class="column">
            <h3> Add Student to a Certification </h3>
            <h3> Update a Student's Certification </h3>
            <h3> View a Student's Certifications </h3>
            <h3> Delete a Student's Certification </h3>
          </div>
        <h2> Classes </h2>
          <div class="column">
            <h3> Create a New Class </h3>
            <h3> Update an Existing Class </h3>
            <h3> View All Classes </h3>
            <h3> Delete a Class </h3>
          </div>
          <div class="column">
            <h3> Add Student to a Class </h3>
            <h3> Update a Student's Class </h3>
            <h3> View a Student's Classes </h3>
            <h3> Delete a Student's Class </h3>
          </div>
    </form>

  </body>
</html>