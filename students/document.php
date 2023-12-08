<?php
//Written by Maharshi Rathod
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
  include 'doc_backend.php';
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Document Management</title>
      <link rel="stylesheet" href="template.css">
    </head>

    <ul>
      <li><a href="authentication/authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="programmanagement/programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking/progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="document.php?UIN=<?php echo $UIN; ?>">Document Management</a></li>
      <li style="float:right"><a href="../login.php">Logout</a></li>
    </ul>

    <form action="doc_backend.php" method="post" enctype="multipart/form-data">
    <!-- Insert Document Section -->
    <h2>Insert Document</h2>
    <label for="appNum">Application Number:</label>
    
    <select name="appNum" id="appNum" >
        <?php
        
        // Populate dropdown dynamically with existing programs
        foreach ($apps as $app) {
            echo '<option value="' . $app['App_Num'] . '">' . $app['App_Num'] . '</option>';
        }
        ?>
    </select>
    <input type="text" name="UIN" value="<?php echo $UIN; ?>" style="display:none;">
    <label for="file">Choose Document (PDF/Word):</label>
    <input type="file" name="file" class="form-control" >
    <input type="submit" name="insertDoc" value="Insert Document">
    </form>
    <form action="doc_backend.php" method="post" enctype="multipart/form-data">
    <!-- Update Document Section -->
    <h2>Update Document</h2>
    <label for="docNum">Select Document Number:</label>
    <select name="docNum" id="docNum" required>
        <?php
        // Populate dropdown dynamically with existing documents
        foreach ($documents as $doc) {
            echo '<option value="' . $doc['Doc_Num'] . '">' . $doc['Doc_Num'] . '</option>';
        }
        ?>
    </select>
    <br>
    <label for="appNumUpdate">Application Number:</label>
        <select name="appNumUpdate" id="appNumUpdate" >
            <?php
            // Populate dropdown dynamically with existing programs
            foreach ($apps as $app) {
                echo '<option value="' . $app['App_Num'] . '">' . $app['App_Num'] . '</option>';
            }
            ?>
        </select>
    <br>
    <label for="updateOption">Update Option:</label>
    <select name="updateOption" id="updateOption" >
        <option value="replace">Replace Document</option>
        <option value="changeAppNum">Change Application Number</option>
    </select>
    <br>
    <label for="file">Select New File:</label>
    <input type="file" name="file" accept=".pdf, .docx" >
    <br>
    <input type="text" name="UIN" value="<?php echo $UIN; ?>" style="display:none;">
    <input type="submit" name="updateDoc" value="Update Document">

    
    <!-- View Document Section -->
    <h2>View Document</h2>
    <label for="docNumView">Select Document Number:</label>
    <select name="docNumView" id="docNumView" required>
        <?php
        // Populate dropdown dynamically with existing documents
        foreach ($documents as $doc) {
            echo '<option value="' . $doc['Doc_Num'] . '">' . $doc['Doc_Num'] . '</option>';
        }
        ?>
    </select>
    <input type="text" name="UIN" value="<?php echo $UIN; ?>" style="display:none;">
    <input type="submit" name="viewDocs" value="View Document">

    <!-- Delete Document Section -->
    <h2>Delete Document</h2>
    <label for="deleteDoc">Document:</label>
    <select name="deleteDoc" id="deleteDoc" required>
        <?php
        // Populate dropdown dynamically with existing documents
        foreach ($documents as $doc) {
          echo '<option value="' . $doc['Doc_Num'] . '">' . $doc['Doc_Num'] . '</option>';
        }
        ?>
        </select>
        <input type="text" name="UIN" value="<?php echo $UIN; ?>" style="display:none;">
        <input type="submit" name="deleteDocBut" value="Delete Document">

</form>



  </body>
</html>