<?php
    include 'db_connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // _______________RECORD________________
        if (isset($_POST['program']) && $_POST['program'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $program_num = $_POST['program'];
            $student_UIN = $_POST['student'];
            $sql = "INSERT INTO `track` (`Program_Num`, `UIN`) VALUES ('$program_num', '$student_UIN');";
            $result = $conn->query($sql);
            header("Location: progresstracking.php?UIN=$selectedStudentUIN");
            exit();
        } 

        if (isset($_POST['class']) && $_POST['class'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $class = $_POST['class'];
            $status = $_POST['classStatus'];
            $semester = $_POST['classSemester'];
            $year = $_POST['classYear'];
    
            $sqlClass = "INSERT INTO `class_enrollment` (`UIN`, `Class_ID`, `Status`, `Semester`, `Year`) VALUES ('$selectedStudentUIN', '$class', '$status', '$semester', '$year');";
            $resultClass = $conn->query($sqlClass);
            header("Location: progresstracking.php?UIN=$selectedStudentUIN");
            exit();
        }
    
        if (isset($_POST['certification']) && $_POST['certification'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $certification = $_POST['certification'];
            $program_num = $_POST['certificationProgram'];
            $statusCert = $_POST['certificationStatus'];
            $trainingStatus = $_POST['certificationTrainingStatus'];
            $semesterCert = $_POST['certificationSemester'];
            $yearCert = $_POST['certificationYear'];
            
            $sqlCertification = "INSERT INTO `cert_enrollment` (`UIN`, `Cert_ID`, `Status`, `Training_Status`, `Program_Num`, `Semester`, `YEAR`) 
                     VALUES ('$selectedStudentUIN', '$certification', '$statusCert', '$trainingStatus', '$program_num', '$semesterCert', '$yearCert');";
            $resultCertification = $conn->query($sqlCertification);
            header("Location: progresstracking.php?UIN=$selectedStudentUIN");
            exit();
        }
    
        if (isset($_POST['internship']) && $_POST['internship'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $internship = $_POST['internship'];
            $statusInternship = $_POST['internshipStatus'];
            $yearInternship = $_POST['internshipYear'];
    
            $sqlInternship = "INSERT INTO `intern_app` (`UIN`, `Intern_ID`, `Status`, `Year`) VALUES ('$selectedStudentUIN', '$internship', '$statusInternship', '$yearInternship');";
            $resultInternship = $conn->query($sqlInternship);
            header("Location: progresstracking.php?UIN=$selectedStudentUIN");
            exit();
        }

        //___________________EDIT___________________
        if (isset($_POST['editClass']) && $_POST['editClass'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $class = $_POST['editClass'];
            $status = $_POST['editClassStatus'];
            $semester = $_POST['editClassSemester'];
            $year = $_POST['editClassYear'];        
            $sqlClass = "UPDATE `class_enrollment` SET `Status` = '$status', `Semester` = '$semester', `Year` = '$year' WHERE `UIN` = '$selectedStudentUIN' AND `Class_ID` = '$class';";
            $resultClass = $conn->query($sqlClass);
        }
        
        if (isset($_POST['editCertification']) && $_POST['editCertification'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $certification = $_POST['editCertification'];
            $program_num = $_POST['editCertificationProgram'];
            $statusCert = $_POST['editCertificationStatus'];
            $trainingStatus = $_POST['editCertificationTrainingStatus'];
            $semesterCert = $_POST['editCertificationSemester'];
            $yearCert = $_POST['editCertificationYear'];        
            $sqlCertification = "UPDATE `cert_enrollment` SET `Status` = '$statusCert', `Training_Status` = '$trainingStatus', `Program_Num` = '$program_num', `Semester` = '$semesterCert', `YEAR` = '$yearCert' 
                                 WHERE `UIN` = '$selectedStudentUIN' AND `Cert_ID` = '$certification';";
            $resultCertification = $conn->query($sqlCertification);
        }

        if (isset($_POST['editInternship']) && $_POST['editInternship'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $internship = $_POST['editInternship'];
            $statusInternship = $_POST['editInternshipStatus'];
            $yearInternship = $_POST['editInternshipYear'];        
            $sqlInternship = "UPDATE `intern_app` SET `Status` = '$statusInternship', `Year` = '$yearInternship' WHERE `UIN` = '$selectedStudentUIN' AND `Intern_ID` = '$internship';";
            $resultInternship = $conn->query($sqlInternship);
        }

        //_________________DELETE_________________
        if (isset($_POST['deleteProgram']) && $_POST['deleteProgram'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $program_num = $_POST['deleteProgram'];
            $student_UIN = $_POST['student'];
            $sql = "DELETE FROM `track` WHERE `Program_Num` = '$program_num' AND `UIN` = '$student_UIN';";
            $result = $conn->query($sql);
        }

        if (isset($_POST['deleteClass']) && $_POST['deleteClass'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $class = $_POST['deleteClass'];
            $sql = "DELETE FROM `class_enrollment` WHERE `Class_ID` = '$class' AND `UIN` = '$selectedStudentUIN';";
            $result = $conn->query($sql);
        }

        if (isset($_POST['deleteCertification']) && $_POST['deleteCertification'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $certification = $_POST['deleteCertification'];
            $program_num = $_POST['deleteCertificationProgram'];
            $sql = "DELETE FROM `cert_enrollment` WHERE `Cert_ID` = '$certification' AND `UIN` = '$selectedStudentUIN' AND `Program_Num` = '$program_num';";
            $resultCertification = $conn->query($sql);
        }

        if (isset($_POST['deleteInternship']) && $_POST['deleteInternship'] != 'null') {
            $selectedStudentUIN = $_POST['student'];
            $internship = $_POST['deleteInternship'];
            $sql = "DELETE FROM `intern_app` WHERE `UIN` = '$selectedStudentUIN' AND `Intern_ID` = '$internship';";
            $result = $conn->query($sql);
        }

        //_________________View_________________
        if (isset($_POST['view']) && $_POST['view'] != 'null') {
            if ($_POST['view'] == 'admin') {
                echo "<title>Admin Report</title>";
                echo "<h1>Admin Report</h1>";

                $q1 = "SELECT p.Name AS ProgramName, COUNT(DISTINCT t.UIN) AS StudentCount
                FROM programs p
                LEFT JOIN track t ON p.Program_Num = t.Program_Num
                GROUP BY p.Program_Num, p.Name;";
                $result = $conn->query($q1);
                if ($result) {
                    echo "<h2>Programs</h2>";
                    echo "<table border='1'>
                          <tr>
                            <th>Program Name</th>
                            <th>Student Count</th>
                          </tr>";                
                    while ($row = $result->fetch_assoc()) {
                        $programName = $row['ProgramName'];
                        $studentCount = $row['StudentCount'];
                        echo "<tr>
                                <td>$programName</td>
                                <td>$studentCount</td>
                              </tr>";
                    }                
                    echo "</table>";
                }
                
                $q2 = "SELECT
                    c.Name AS ClassName,
                    c.Type AS ClassType,
                    COALESCE(COUNT(DISTINCT ce.UIN), 0) AS StudentCount,
                    COALESCE(SUM(ce.Status = 'notenrolled'), 0) AS NotEnrolledCount,
                    COALESCE(SUM(ce.Status = 'enrolled'), 0) AS EnrolledCount,
                    COALESCE(SUM(ce.Status = 'completed'), 0) AS CompletedCount
                FROM classes c
                LEFT JOIN class_enrollment ce ON c.Class_ID = ce.Class_ID
                GROUP BY c.Class_ID, c.Name, c.Type";
                $resultClasses = $conn->query($q2);
                if ($resultClasses) {
                    echo "<h2>Classes</h2>";
                    echo "<table border='1'>
                        <tr>
                            <th>Class Name</th>
                            <th>Class Type</th>
                            <th>Total Students</th>
                            <th>Not Enrolled</th>
                            <th>Enrolled</th>
                            <th>Completed</th>
                        </tr>";
                    while ($row = $resultClasses->fetch_assoc()) {
                        $className = $row['ClassName'];
                        $classType = $row['ClassType'];
                        $totalStudents = $row['StudentCount'];
                        $notEnrolledCount = $row['NotEnrolledCount'];
                        $enrolledCount = $row['EnrolledCount'];
                        $completedCount = $row['CompletedCount'];
                        echo "<tr>
                                <td>$className</td>
                                <td>$classType</td>
                                <td>$totalStudents</td>
                                <td>$notEnrolledCount</td>
                                <td>$enrolledCount</td>
                                <td>$completedCount</td>
                            </tr>";
                    }
                    echo "</table>";
                }

                $q3 = "SELECT
                    cert.Name AS CertificationName,
                    COALESCE(COUNT(DISTINCT ce.UIN), 0) AS TotalStudents,
                    COALESCE(SUM(ce.Training_Status = 'notstarted'), 0) AS NotStartedCount,
                    COALESCE(SUM(ce.Training_Status = 'ongoing'), 0) AS OngoingCount,
                    COALESCE(SUM(ce.Training_Status = 'completed'), 0) AS CompletedCount,
                    COALESCE(SUM(ce.Status = 'notregistered'), 0) AS NotRegisteredCount,
                    COALESCE(SUM(ce.Status = 'registered'), 0) AS RegisteredCount,
                    COALESCE(SUM(ce.Status = 'passed'), 0) AS PassedCount,
                    COALESCE(SUM(ce.Status = 'failed'), 0) AS FailedCount
                FROM certification cert
                LEFT JOIN cert_enrollment ce ON cert.Cert_ID = ce.Cert_ID
                GROUP BY cert.Cert_ID, cert.Name";
                $resultCertifications = $conn->query($q3);
                if ($resultCertifications) {
                    echo "<h2>Certifications</h2>";
                    echo "<table border='1'>
                        <tr>
                            <th>Certification Name</th>
                            <th>Total Students</th>
                            <th>Not Started Training</th>
                            <th>Ongoing Training</th>
                            <th>Completed Training</th>
                            <th>Not Registered for Exam</th>
                            <th>Registered for Exam</th>
                            <th>Passed Exam</th>
                            <th>Failed Exam</th>
                        </tr>";
                    while ($row = $resultCertifications->fetch_assoc()) {
                        $certificationName = $row['CertificationName'];
                        $totalStudents = $row['TotalStudents'];
                        $notStartedCount = $row['NotStartedCount'];
                        $ongoingCount = $row['OngoingCount'];
                        $completedCount = $row['CompletedCount'];
                        $notRegisteredCount = $row['NotRegisteredCount'];
                        $registeredCount = $row['RegisteredCount'];
                        $passedCount = $row['PassedCount'];
                        $failedCount = $row['FailedCount'];
                        echo "<tr>
                                <td>$certificationName</td>
                                <td>$totalStudents</td>
                                <td>$notStartedCount</td>
                                <td>$ongoingCount</td>
                                <td>$completedCount</td>
                                <td>$notRegisteredCount</td>
                                <td>$registeredCount</td>
                                <td>$passedCount</td>
                                <td>$failedCount</td>
                            </tr>";
                    }
                    echo "</table>";
                }
                
                $q4 = "SELECT
                    i.Name AS InternshipName,
                    i.Is_Gov AS IsGovernment,
                    COALESCE(SUM(ia.Status = 'applied'), 0) AS AppliedCount,
                    COALESCE(SUM(ia.Status = 'rejected'), 0) AS RejectedCount,
                    COALESCE(SUM(ia.Status = 'accepted'), 0) AS AcceptedCount
                FROM internship i
                LEFT JOIN intern_app ia ON i.Intern_ID = ia.Intern_ID
                GROUP BY i.Intern_ID, i.Name, i.Is_Gov";
                $resultInternships = $conn->query($q4);
                if ($resultInternships) {
                    echo "<h2>Internships</h2>";
                    echo "<table border='1'>
                        <tr>
                            <th>Internship Name</th>
                            <th>Is Government</th>
                            <th>Applied Count</th>
                            <th>Rejected Count</th>
                            <th>Accepted Count</th>
                        </tr>";

                    while ($row = $resultInternships->fetch_assoc()) {
                        $internshipName = $row['InternshipName'];
                        $isGovernment = $row['IsGovernment'];
                        $appliedCount = $row['AppliedCount'];
                        $rejectedCount = $row['RejectedCount'];
                        $acceptedCount = $row['AcceptedCount'];

                        echo "<tr>
                                <td>$internshipName</td>
                                <td>$isGovernment</td>
                                <td>$appliedCount</td>
                                <td>$rejectedCount</td>
                                <td>$acceptedCount</td>
                            </tr>";
                    }
                    echo "</table>";
                }
                
                $q5 = "SELECT Gender, Hispanic_Latino, Race, First_Generation, Major
                    FROM college_student";
                $resultStudents = $conn->query($q5);
                if ($resultStudents) {
                    echo "<h2>College Students Information</h2>";
                    echo "<table border='1'>
                        <tr>
                            <th>Gender</th>
                            <th>Hispanic/Latino</th>
                            <th>Race</th>
                            <th>First Generation</th>
                            <th>Major</th>
                        </tr>";
                    while ($row = $resultStudents->fetch_assoc()) {
                        $gender = $row['Gender'];
                        $hispanicLatino = $row['Hispanic_Latino'];
                        $race = $row['Race'];
                        $firstGeneration = $row['First_Generation'];
                        $major = $row['Major'];
                        echo "<tr>
                                <td>$gender</td>
                                <td>$hispanicLatino</td>
                                <td>$race</td>
                                <td>$firstGeneration</td>
                                <td>$major</td>
                            </tr>";
                    }
                    echo "</table>";
                }

                echo "<br>";
                $previousPage = $_SERVER['HTTP_REFERER'];
                echo "<form action='$previousPage' method='post'>
                        <button type='submit'>Go Back</button>
                    </form>";
                exit();
            } 
            
            else if ($_POST['view'] == 'student') {
                $selectedStudentUIN = $_POST['student'];
                echo "<title>Student Report</title>";
                echo "<h1>Student Report for Student (UIN: $selectedStudentUIN)</h1>";


                $qProgramsForStudent = "SELECT p.Name AS ProgramName
                                        FROM programs p
                                        JOIN track t ON p.Program_Num = t.Program_Num AND t.UIN = '$selectedStudentUIN'";
                $resultProgramsForStudent = $conn->query($qProgramsForStudent);
                echo "<h2>Programs</h2>";
                echo "<table border='1'>
                    <tr>
                        <th>Program Name</th>
                    </tr>";
                while ($row = $resultProgramsForStudent->fetch_assoc()) {
                    $programName = $row['ProgramName'];
                    echo "<tr>
                            <td>$programName</td>
                        </tr>";
                }
                echo "</table>";
                

                $qClassesForStudent = "SELECT
                    c.Name AS ClassName,
                    c.Type AS ClassType,
                    COALESCE(SUM(ce.Status = 'notenrolled'), 0) AS NotEnrolledCount,
                    COALESCE(SUM(ce.Status = 'enrolled'), 0) AS EnrolledCount,
                    COALESCE(SUM(ce.Status = 'completed'), 0) AS CompletedCount
                FROM classes c
                JOIN class_enrollment ce ON c.Class_ID = ce.Class_ID AND ce.UIN = '$selectedStudentUIN'
                GROUP BY c.Class_ID, c.Name, c.Type";
                $resultClassesForStudent = $conn->query($qClassesForStudent);
                echo "<h2>Classes</h2>";
                echo "<table border='1'>
                    <tr>
                        <th>Class Name</th>
                        <th>Class Type</th>
                        <th>Not Enrolled</th>
                        <th>Enrolled</th>
                        <th>Completed</th>
                    </tr>";
                while ($row = $resultClassesForStudent->fetch_assoc()) {
                    $className = $row['ClassName'];
                    $classType = $row['ClassType'];
                    $notEnrolledCount = $row['NotEnrolledCount'];
                    $enrolledCount = $row['EnrolledCount'];
                    $completedCount = $row['CompletedCount'];
                    echo "<tr>
                            <td>$className</td>
                            <td>$classType</td>
                            <td>$notEnrolledCount</td>
                            <td>$enrolledCount</td>
                            <td>$completedCount</td>
                        </tr>";
                }
                echo "</table>";


                $qCertificationsForStudent = "SELECT
                    cert.Name AS CertificationName,
                    COALESCE(SUM(ce.Training_Status = 'notstarted'), 0) AS NotStartedCount,
                    COALESCE(SUM(ce.Training_Status = 'ongoing'), 0) AS OngoingCount,
                    COALESCE(SUM(ce.Training_Status = 'completed'), 0) AS CompletedCount,
                    COALESCE(SUM(ce.Status = 'notregistered'), 0) AS NotRegisteredCount,
                    COALESCE(SUM(ce.Status = 'registered'), 0) AS RegisteredCount,
                    COALESCE(SUM(ce.Status = 'passed'), 0) AS PassedCount,
                    COALESCE(SUM(ce.Status = 'failed'), 0) AS FailedCount
                FROM certification cert
                JOIN cert_enrollment ce ON cert.Cert_ID = ce.Cert_ID AND ce.UIN = '$selectedStudentUIN'
                GROUP BY cert.Cert_ID, cert.Name";
                $resultCertificationsForStudent = $conn->query($qCertificationsForStudent);
                echo "<h2>Certifications</h2>";
                echo "<table border='1'>
                    <tr>
                        <th>Certification Name</th>
                        <th>Not Started Training</th>
                        <th>Ongoing Training</th>
                        <th>Completed Training</th>
                        <th>Not Registered for Exam</th>
                        <th>Registered for Exam</th>
                        <th>Passed Exam</th>
                        <th>Failed Exam</th>
                    </tr>";
                while ($row = $resultCertificationsForStudent->fetch_assoc()) {
                    $certificationName = $row['CertificationName'];
                    $notStartedCount = $row['NotStartedCount'];
                    $ongoingCount = $row['OngoingCount'];
                    $completedCount = $row['CompletedCount'];
                    $notRegisteredCount = $row['NotRegisteredCount'];
                    $registeredCount = $row['RegisteredCount'];
                    $passedCount = $row['PassedCount'];
                    $failedCount = $row['FailedCount'];
                    echo "<tr>
                            <td>$certificationName</td>
                            <td>$notStartedCount</td>
                            <td>$ongoingCount</td>
                            <td>$completedCount</td>
                            <td>$notRegisteredCount</td>
                            <td>$registeredCount</td>
                            <td>$passedCount</td>
                            <td>$failedCount</td>
                        </tr>";
                }
                echo "</table>";


                $qInternshipsForStudent = "SELECT
                    i.Name AS InternshipName,
                    i.Is_Gov AS IsGovernment,
                    COALESCE(SUM(ia.Status = 'applied'), 0) AS AppliedCount,
                    COALESCE(SUM(ia.Status = 'rejected'), 0) AS RejectedCount,
                    COALESCE(SUM(ia.Status = 'accepted'), 0) AS AcceptedCount
                FROM internship i
                JOIN intern_app ia ON i.Intern_ID = ia.Intern_ID AND ia.UIN = '$selectedStudentUIN'
                GROUP BY i.Intern_ID, i.Name, i.Is_Gov";
                $resultInternshipsForStudent = $conn->query($qInternshipsForStudent);
                echo "<h2>Internships</h2>";
                echo "<table border='1'>
                    <tr>
                        <th>Internship Name</th>
                        <th>Is Government</th>
                        <th>Applied Count</th>
                        <th>Rejected Count</th>
                        <th>Accepted Count</th>
                    </tr>";
                while ($row = $resultInternshipsForStudent->fetch_assoc()) {
                    $internshipName = $row['InternshipName'];
                    $isGovernment = $row['IsGovernment'];
                    $appliedCount = $row['AppliedCount'];
                    $rejectedCount = $row['RejectedCount'];
                    $acceptedCount = $row['AcceptedCount'];
                    echo "<tr>
                            <td>$internshipName</td>
                            <td>$isGovernment</td>
                            <td>$appliedCount</td>
                            <td>$rejectedCount</td>
                            <td>$acceptedCount</td>
                        </tr>";
                }
                echo "</table>";


                $qStudentInformation = "SELECT Gender, Hispanic_Latino, Race, First_Generation, Major
                        FROM college_student
                        WHERE UIN = '$selectedStudentUIN'";
                $resultStudentInformation = $conn->query($qStudentInformation);
                echo "<h2>College Student Information</h2>";
                echo "<table border='1'>
                    <tr>
                        <th>Gender</th>
                        <th>Hispanic/Latino</th>
                        <th>Race</th>
                        <th>First Generation</th>
                        <th>Major</th>
                    </tr>";
                if ($resultStudentInformation && $resultStudentInformation->num_rows > 0) {
                    $row = $resultStudentInformation->fetch_assoc();
                    $gender = $row['Gender'];
                    $hispanicLatino = $row['Hispanic_Latino'];
                    $race = $row['Race'];
                    $firstGeneration = $row['First_Generation'];
                    $major = $row['Major'];
                    echo "<tr>
                            <td>$gender</td>
                            <td>$hispanicLatino</td>
                            <td>$race</td>
                            <td>$firstGeneration</td>
                            <td>$major</td>
                        </tr>";
                } else {
                    echo "<tr><td colspan='5'>No information found for UIN: $selectedStudentUIN</td></tr>";
                }
                echo "</table>";


                echo "<br>";
                $previousPage = $_SERVER['HTTP_REFERER'];
                echo "<form action='$previousPage' method='post'>
                        <button type='submit'>Go Back</button>
                    </form>";
                exit();
            }            
        }

        if (isset($_POST['student'])) {
            $selectedStudentUIN = $_POST['student'];
            $query = "SELECT * FROM `users` WHERE UIN = '$selectedStudentUIN'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $selectedStudentData = $result->fetch_assoc();
                header("Location: progresstracking.php?UIN=$selectedStudentUIN");
                exit();
            } else {
                echo "Error: Student not found.";
            }
        } else {
            echo "Error: Student not selected.";
        }
    } else {
        echo "Error: Invalid request method.";
    }
    $conn->close();
?>
