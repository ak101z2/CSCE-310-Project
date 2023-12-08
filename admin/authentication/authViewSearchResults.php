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
      <link rel="stylesheet" href="authViewSearchResults.css">
    </head>

    <ul>
      <li><a href="authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>


<?php
    $servername = "localhost";
    $username = "user";
    $password = "pass1";
    $dbname = "CSCE310project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }


    $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
    $type = isset($_GET['Type']) ? $_GET['Type'] : ''; // Gets Search Type
    $typeValue = $_POST["$type"];

    if ($type == "UIN") {
        $sql = "SELECT * FROM `users` WHERE UIN = $typeValue";

    } else if ($type == "Username") {
        $sql = "SELECT * FROM `users` WHERE Username = '$typeValue'";

    } else if ($type == "User_Type") {
        $sql = "SELECT * FROM `users` WHERE User_Type = '$typeValue'";

    }
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
		if ($type == "UIN") {
			$sql = "SELECT * FROM `college_student` WHERE UIN = $typeValue";

		} else if ($type == "Username") {
			$sql = "SELECT * FROM `college_student` WHERE UIN = '$row[UIN]'";

		} else if ($type == "User_Type") {
			$sql = "SELECT * FROM `college_student` WHERE Student_Type = '$typeValue'";

		}
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