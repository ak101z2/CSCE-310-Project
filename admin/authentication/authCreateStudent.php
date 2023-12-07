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
      <li><a href="programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="authCreateStudent_Backend.php?UIN=<?php echo $UIN; ?>" method="post">
    <h1>Add new Student</h1>
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

            <label for="User_Type"><b>User Type</b></label>
            <select name="User_Type" id="User_Type">
                <option value="CollegeStudent">CollegeStudent</option>
                <option value="NonCollegeStudent">NonCollegeStudent</option>
            </select>


        </div>
        <div class = "hold">
            <label for="Email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="Email" id="Email" required>

            <label for="Discord_Name"><b>Discord Name</b></label>
            <input type="text" placeholder="Enter Discord Name" name="Discord_Name" id="Discord_Name" required>
        </div>
    </div>

    <hr>

    <h1>Extra Information</h1>

    <div class = "hold">
        <label for="Gender"><b>Gender</b></label>
        <select name="Gender" id="Gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="Hispanic_Latino"><b>Hispanic Latino</b></label>
        <select name="Hispanic_Latino" id="Hispanic_Latino">
            <option value="True">Yes Hispanic/Latino</option>
            <option value="False">No Hispanic/Latino</option>
        </select>
    </div>

    <div class = "hold">
        <label for="Race"><b>Race</b></label>
        <input type="text" placeholder="Enter Race" name="Race" id="Race" required>

        <label for="US_Citizen"><b>US Citizen</b></label>
        <select name="US_Citizen" id="US_Citizen">
            <option value="True">Yes US Citizen</option>
            <option value="False">No US Citizen</option>
        </select>
    </div>

    <div class = "hold">
        <label for="First_Generation"><b>First Generation</b></label>
        <select name="First_Generation" id="First_Generation">
            <option value="True">Yes First Generation</option>
            <option value="False">No First Generation</option>
        </select>

        <label for="DoB"><b>Date of Birth</b></label>
        <input type="text" placeholder="Enter Date of Birth" name="DoB" id="DoB" required>

        <label for="GPA"><b>GPA</b></label>
        <input type="text" placeholder="Enter GPA" name="GPA" id="GPA" required>
    </div>

    <div class = "hold">
        <label for="Major"><b>Major</b></label>
        <input type="text" placeholder="Enter Major" name="Major" id="Major" required>

        <label for="Minor1"><b>Minor 1</b></label>
        <input type="text" placeholder="Enter Minor 1" name="Minor1" id="Minor1" required>
    </div>

    <div class = "hold">
        <label for="Minor2"><b>Minor 2</b></label>
        <input type="text" placeholder="Enter Minor2" name="Minor2" id="Minor2" required>

        <label for="Expected_Graduation"><b>Expected Graduation Year</b></label>
        <input type="text" placeholder="Enter Expected Graduation" name="Expected_Graduation" id="Expected_Graduation" required>
    </div>

    <div class = "hold">
        <label for="School"><b>School</b></label>
        <input type="text" placeholder="Enter School" name="School" id="School" required>

        <label for="Classification"><b>Classification</b></label>
        <input type="text" placeholder="Enter Classification" name="Classification" id="Classification" required>
    </div>

    <div class = "hold">
        <label for="Phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="Phone" id="Phone" required>

        <label for="Student_Type"><b>Student Type</b></label>
        <select name="Student_Type" id="Student_Type">
            <option value="CollegeStudent">College Student</option>
            <option value="NonCollegeStudent">Non College Student</option>
        </select>
    </div>
</div>


    <button type="submit" class="registerbtn">Register</button>

    </form>

  </body>
</html>