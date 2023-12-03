<?php
  $UIN = isset($_GET['UIN']) ? $_GET['UIN'] : ''; // Gets UIN
?>

<?php
  include 'db_connection.php';
  $sql = "SELECT First_Name, Last_Name, UIN FROM `users`";
  $students = $conn->query($sql);

  $conn->close();
?>

<html>
  <body>
    <head>
      <meta charset="UTF-8">
      <title>Progress Tracking</title>
      <link rel="stylesheet" href="../template.css">
    </head>

    <ul>
      <li><a href="../authentication.php?UIN=<?php echo $UIN; ?>">Authentication</a></li>
      <li><a href="../programmanagement.php?UIN=<?php echo $UIN; ?>">Program Management</a></li>
      <li><a href="progresstracking.php?UIN=<?php echo $UIN; ?>">Progress Tracking</a></li>
      <li><a href="../eventmanagement.php?UIN=<?php echo $UIN; ?>">Event Management</a></li>
      <li style="float:right"><a href="../../login.php">Logout</a></li>
    </ul>

    <form action="backend.php" method="post">
      <h1> Progress Tracking </h1>
        <label for="student">Student:</label>
          <select name="student" id="student">
            <?php include 'select_students.php'; ?>
          </select>
          <br>
          <input type="submit" value="Select Student">
      <br>
      <br>
      <?php
        if (isset($_GET['UIN'])) {
            echo '<div class="column">';
            // __________________________________________RECORD__________________________________________
            echo '    <h2>Record Student Progress</h2>';
            echo '        <label for="program">Program:</label>';
            echo '            <select name="program" id="programSelect">';
                                  include 'record_programs.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Record Program">';
            echo '        <br><br>';
            echo '        <label for="class">Class:</label>';
            echo '            <select name="class" id="classSelect">';
                                  include 'record_classes.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="status">Status:</label>';
            echo '            <select name="classStatus" id="classStatusSelect">';
            echo '                <option value="notenrolled">Not Enrolled</option>';
            echo '                <option value="enrolled">Enrolled</option>';
            echo '                <option value="completed">Completed</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="classSemester">Semester:</label>';
            echo '            <select name="classSemester" id="classSemesterSelect">';
            echo '                <option value="Fall">Fall</option>';
            echo '                <option value="Spring">Spring</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="classYear">Year:</label>';
            echo '            <select name="classYear" id="classYearSelect">';
            echo '                <option value="2022">2022</option>';
            echo '                <option value="2023">2023</option>';
            echo '                <option value="2024">2024</option>';
            echo '                <option value="2025">2025</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Record Class">';
            echo '        <br><br>';
            echo '        <label for="certification">Certification:</label>';
            echo '            <select name="certification" id="certificationSelect">';
                                  include 'record_certifications.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="certificationProgram">Program:</label>';
            echo '            <select name="certificationProgram" id="certificationProgramSelect">';
                                  include 'edit_programs.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="certificationStatus">Status:</label>';
            echo '            <select name="certificationStatus" id="certificationStatusSelect">';
            echo '                <option value="notregistered">Not Registered</option>';
            echo '                <option value="registered">Registered</option>';
            echo '                <option value="passed">Passed</option>';
            echo '                <option value="failed">Failed</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="certificationTrainingStatus">Training Status:</label>';
            echo '            <select name="certificationTrainingStatus" id="certificationTrainingStatusSelect">';
            echo '                <option value="notstarted">Not Started</option>';
            echo '                <option value="ongoing">Ongoing</option>';
            echo '                <option value="completed">Completed</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="certificationSemester">Semester:</label>';
            echo '            <select name="certificationSemester" id="certificationSemesterSelect">';
            echo '                <option value="Fall">Fall</option>';
            echo '                <option value="Spring">Spring</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="certificationYear">Year:</label>';
            echo '            <select name="certificationYear" id="certificationYearSelect">';
            echo '                <option value="2022">2022</option>';
            echo '                <option value="2023">2023</option>';
            echo '                <option value="2024">2024</option>';
            echo '                <option value="2025">2025</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Record Certification">';
            echo '        <br><br>';
            echo '        <label for="internship">Internship:</label>';
            echo '            <select name="internship" id="internshipSelect">';
                                  include 'record_internships.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="internshipStatus">Status:</label>';
            echo '            <select name="internshipStatus" id="internshipStatusSelect">';
            echo '                <option value="applied">Applied</option>';
            echo '                <option value="rejected">Rejected</option>';
            echo '                <option value="accepted">Accepted</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="internshipYear">Year:</label>';
            echo '            <select name="internshipYear" id="internshipYearSelect">';
            echo '                <option value="2022">2022</option>';
            echo '                <option value="2023">2023</option>';
            echo '                <option value="2024">2024</option>';
            echo '                <option value="2025">2025</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Record Internship">';
            echo '        <br><br>';
            echo '</div>';
            echo '<div class="column">';
            echo '    <h2>Edit Student Progress</h2>';
            // __________________________________________EDIT__________________________________________
            // echo '        <label for="editProgram">Program:</label>';
            // echo '            <select name="editProgram" id="editProgramSelect">';
            //                       include 'edit_programs.php';
            // echo '            </select>';
            // echo '        <br>';
            // echo '        <input type="submit" value="Edit Program">';
            // echo '        <br><br>';
            echo '        <label for="editClass">Class:</label>';
            echo '            <select name="editClass" id="editClassSelect">';
                                  include 'edit_classes.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editStatus">Status:</label>';
            echo '            <select name="editClassStatus" id="editClassStatusSelect">';
            echo '                <option value="notenrolled">Not Enrolled</option>';
            echo '                <option value="inprogress">Enrolled</option>';
            echo '                <option value="completed">Completed</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editClassSemester">Semester:</label>';
            echo '            <select name="editClassSemester" id="editClassSemesterSelect">';
            echo '                <option value="Fall">Fall</option>';
            echo '                <option value="Spring">Spring</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editClassYear">Year:</label>';
            echo '            <select name="editClassYear" id="editClassYearSelect">';
            echo '                <option value="2022">2022</option>';
            echo '                <option value="2023">2023</option>';
            echo '                <option value="2024">2024</option>';
            echo '                <option value="2025">2025</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Edit Class">';
            echo '        <br><br>';
            echo '        <label for="editCertification">Certification:</label>';
            echo '            <select name="editCertification" id="editCertificationSelect">';
                                  include 'edit_certifications.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editCertificationProgram">Program:</label>';
            echo '            <select name="editCertificationProgram" id="editCertificationProgramSelect">';
                                  include 'edit_programs.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editCertificationStatus">Status:</label>';
            echo '            <select name="editCertificationStatus" id="editCertificationStatusSelect">';
            echo '                <option value="notregistered">Not Registered</option>';
            echo '                <option value="registered">Registered</option>';
            echo '                <option value="passed">Passed</option>';
            echo '                <option value="failed">Failed</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editCertificationTrainingStatus">Training Status:</label>';
            echo '            <select name="editCertificationTrainingStatus" id="editCertificationTrainingStatusSelect">';
            echo '                <option value="notstarted">Not Started</option>';
            echo '                <option value="ongoing">Ongoing</option>';
            echo '                <option value="completed">Completed</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editCertificationSemester">Semester:</label>';
            echo '            <select name="editCertificationSemester" id="editCertificationSemesterSelect">';
            echo '                <option value="Fall">Fall</option>';
            echo '                <option value="Spring">Spring</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editCertificationYear">Year:</label>';
            echo '            <select name="editCertificationYear" id="editCertificationYearSelect">';
            echo '                <option value="2022">2022</option>';
            echo '                <option value="2023">2023</option>';
            echo '                <option value="2024">2024</option>';
            echo '                <option value="2025">2025</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Edit Certification">';
            echo '        <br><br>';
            echo '        <label for="editInternship">Internship:</label>';
            echo '            <select name="editInternship" id="editInternshipSelect">';
                                  include 'edit_internships.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editInternshipStatus">Status:</label>';
            echo '            <select name="editInternshipStatus" id="editInternshipStatusSelect">';
            echo '                <option value="applied">Applied</option>';
            echo '                <option value="rejected">Rejected</option>';
            echo '                <option value="accepted">Accepted</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="editInternshipYear">Year:</label>';
            echo '            <select name="editInternshipYear" id="editInternshipYearSelect">';
            echo '                <option value="2022">2022</option>';
            echo '                <option value="2023">2023</option>';
            echo '                <option value="2024">2024</option>';
            echo '                <option value="2025">2025</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Edit Internship">';
            echo '        <br><br>';
            echo '</div>';
            echo '<div class="column">';
            echo '    <h2>Delete Student Progress</h2>';
            // __________________________________________Delete__________________________________________
            echo '        <label for="deleteProgram">Program:</label>';
            echo '            <select name="deleteProgram" id="deleteProgramSelect">';
                                  include 'edit_programs.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Remove from Program">';
            echo '        <br><br>';
            echo '        <label for="deleteClass">Class:</label>';
            echo '            <select name="deleteClass" id="deleteClassSelect">';
                                  include 'edit_classes.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Remove from Class">';
            echo '        <br><br>';
            echo '        <label for="deleteCertification">Certification:</label>';
            echo '            <select name="deleteCertification" id="deleteCertificationSelect">';
                                  include 'edit_certifications.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <label for="deleteCertificationProgram">Program:</label>';
            echo '            <select name="deleteCertificationProgram" id="deleteCertificationProgramSelect">';
                                  include 'edit_programs.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Remove from Certification">';
            echo '        <br><br>';
            echo '        <label for="deleteInternship">Internship:</label>';
            echo '            <select name="deleteInternship" id="deleteInternshipSelect">';
                                  include 'edit_internships.php';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="Remove from Internship">';
            echo '        <br><br>';
            echo '</div>';
            echo '<div class="column">';
            echo '    <h2>View Student Progress</h2>';
            // __________________________________________VIEW__________________________________________
            echo '        <label for="view">Type:</label>';
            echo '            <select name="view" id="viewSelect">';
            echo '                <option value=""></option>';
            echo '                <option value="student">Student</option>';
            echo '            </select>';
            echo '        <br>';
            echo '        <input type="submit" value="View">';
            echo '</div>';
        }
      ?>
    </form>
  </body>
</html>