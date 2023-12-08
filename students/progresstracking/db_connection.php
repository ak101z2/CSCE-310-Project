<!-- Common script for setting up the database connection -->
<!-- Use the server name, username, password, and database name -->
<!-- Establish connection and check for errors -->

<?php
  $servername = "localhost";
  $username = "user";
  $password = "pass1";
  $dbname = "csce310project_final";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>