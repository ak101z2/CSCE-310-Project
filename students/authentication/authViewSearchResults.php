<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Event Management</title>
      <link rel="stylesheet" href="authViewSearchResults.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="../programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Application Information Management</a></li>
      <li><a href="../progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../document.php?UIN=<?php echo $UIN; ?>">Document Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>


<?php
    $servername = "localhost";
    $username = "user";
    $password = "pass1";
    $dbname = "csce310project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }


    $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN

    $sql = "SELECT * FROM `users` WHERE UIN = $UIN";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
      } else {
        header("Location: authentication.php?UIN=$UIN");
        exit;
      }
?>

    <h2>General Search Results</h2>
    <table>
        <tr>
            <?php
            // Output table headers
            foreach ($rows[0] as $key => $value) {
                echo "<th>$key</th>";
            }
            ?>
        </tr>

        <?php
        // Output data rows
        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <?php 
		
        $sql = "SELECT * FROM `college_student` WHERE UIN = $UIN";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$rows2[] = $row;
			}
		  } else {
			exit;
		  }
    ?>

<h2>Specific Information Results</h2>
    <table>
        <tr>
            <?php
            // Output table headers
            foreach ($rows2[0] as $key => $value) {
                echo "<th>$key</th>";
            }
            ?>
        </tr>

        <?php
        // Output data rows
        foreach ($rows2 as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>


</body>
</html>