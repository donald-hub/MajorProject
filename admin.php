<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/print.css">
    <!--including boostrap files below-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
    <nav class="navigationBar">
        <img src="images/logo.png" alt="" height="80" width="80">
        <span>Tezpur University</span>
        <img class="profile" src="images/profile-logo.png" alt="" height="50" width="60">    
    </nav>
    <nav class="navbarMenu">
        <span>Admin</span>
        <form action="resources/logout.php" method="post"><input type="submit"  name="logout" class="logout" value="Logout"></input></form>
    </nav>
    <div class="cardOptions">
        <div class="sideBar">
            <ul class="view">
                <li class="menuItems one" id="viewProgramOb">View Programme Objectives</li>
                <li class="menuItems two" id="createTable">Create Table</li>
                <li class="menuItems three" id="populateData">Populate Data</li>
                <li class="menuItems four" id="generateReport">Generate Report</li>
            </ul>
        </div>
        <div id="viewProgramObSection" class="viewProgramObSection ">
            <!-- <h3>Program Objectives</h3> -->
            <div class="container-fluid" style="padding-top: 50px;">
            <form action="admin.php" method="POST">
                <div class="form-group">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="program_id" id="program_id" placeholder="Programme Name"></input>
                    </div>
                <input class="btn" type="submit" name="program_id_btn" value="VIEW">
                </div>
                <?php
                require "resources/connect.php";
                if(isset($_POST['program_id_btn'])){
                    $program_id = $_POST['program_id'];
                
                try {
                
                    // Prepare the SQL statement
                    $stmt = $conn->prepare("SELECT programme_ob.program_ob_no, programme_ob.program_ob_description, programme.program_id, programme.program_name, programme.dept_id
                                           FROM programme_ob
                                           JOIN programme ON programme_ob.program_id = programme.program_id
                                           WHERE programme_ob.program_id = '$program_id'");
                    // Execute the statement
                    $stmt->execute();
                
                    // Fetch all the results
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo '<div id="printSection" ><div class="center">
                            <h3 class="headers bold">Programme Code:&ThickSpace;'.$program_id.'</h3>
                        </div>
                        <div class="center">
                            <h3 class="headers bold">Programme Name:&ThickSpace;'.$results[0]['program_name'].'</h3>
                        </div>
                        <div class="center">
                            <h3 class="headers bold">Offering Department:&ThickSpace;'.$results[0]['dept_id'].'</h3>
                        </div>';
                    echo '<div class="container">
                            <table class="table table-bordered" border = "1">
                                <thead>
                                    <tr>
                                    <th>PO\'s</th>
                                    <th>Statements</th>
                                    <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>';
                
                    // Loop through the results and output them
                    foreach ($results as $row) {
                        echo "<tr>
                                <td>{$row['program_ob_no']}</td>
                                <td>{$row['program_ob_description']}</td>
                                <td><a role='button'>Edit</a></td>
                              </tr>";
                    }
                
                    echo '        </tbody>
                            </table>
                            <button class="btn btn-info">Add CO</button>
                            <button type="button" class="btn" onclick="download()">Download</button>
                        </div>
                        </div>';
                
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                }
                ?>


            </form>
            </div>

        </div>
        <div id="createTableSection" class="container-fluid createTableSection hidden">
            <form action="resources/createTable.php" method="post">
                <div id="section1" class="secion1">
                    <legend class="title">Create</legend>

                    <div class="form-group">
                        <input type="text" class="form-control" name="tname" id="tname" placeholder="Table name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="columns" id="columns" placeholder="No. of Columns" required>
                    </div>
                    <input class="btn btn-success btn-block" id="next" type="button" value="Next">
                </div>
                        
                <div id="section2" class="section2 hidden">
                </div>
                
            </form>
        </div>
        <div id="populateDataSection" class="hidden">
            <h3>Add</h3>
            <button type="button" id="courses" class="btn btn-success">Courses</button>
            <button type="button" id="courseOb" class="btn btn-success">Course Objectives</button>
            <button type="button" id="department" class="btn btn-success">Department</button>
            <button type="button" id="exam" class="btn btn-success">Exam</button>
            <button type="button" id="faculty" class="btn btn-success">Faculty</button>
            <button type="button" id="programme" class="btn btn-success">Programme</button>
            <button type="button" id="programmeOb" class="btn btn-success">Programme Objective</button>
            <button type="button" id="questions" class="btn btn-success">Questions</button>
            <button type="button" id="students" class="btn btn-success">Students</button>
            <div class="row">

                <div class="col-md-4"></div>
                <div class="col-md-4">
                <form action="resources/populateData.php" method="post">
                    
                <div class="section courses hidden">
                <h3>Courses</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="courses_course_id" placeholder="Course ID" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="courses_course_name" placeholder="Course Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="courses_credit" placeholder="Credit">
                </div>
                <input class="btn btn-info btn-block" name="courses" type="submit" value="Insert">
            </div>
                <div class="section courseOb hidden">
                <h3>Course Objective</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="course_ob_course_id" placeholder="Course ID" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="course_ob_description" placeholder="Description">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="course_ob_course_ob_no" placeholder="Course Objective No.">
                </div>
                <input class="btn btn-info btn-block" name="course_ob" type="submit" value="Insert">
            </div>
                <div class="section department hidden">
                <h3>Department</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="dept_dept_id" placeholder="Department ID" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="dept_dept_name" placeholder="Department Name">
                </div>
                <input class="btn btn-info btn-block" name="dept" type="submit" value="Insert">
            </div>
                
            <div class="section exam hidden">
                <h3>Exam</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="exam_exam_id" placeholder="Exam ID" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="exam_exam_name" placeholder="Exam Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="exam_course_id" placeholder="Course ID">
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="exam_exam_date" placeholder="Exam Date">
                </div>
                <input class="btn btn-info btn-block" name="exam" type="submit" value="Insert">
            </div>
            <div class="section faculty hidden">
                    <h3>Faculty</h3>
                    <div class="form-group">
                    <input class="form-control" type="text" name="faculty_faculty_id" placeholder="Faculty ID" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="faculty_f_name" placeholder="First Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="faculty_l_name" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="faculty_dept_id" placeholder="Department ID">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="faculty_phone" placeholder="Contact No">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="faculty_passwd" placeholder="Password">
                </div>
                <input class="btn btn-info btn-block" name="faculty" type="submit" value="Insert">
            </div>
                <div class="section programme hidden">
                <h3>Programme</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="program_programme_id" placeholder="Programme ID">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="program_programme_name" placeholder="Programme Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="program_dept_id" placeholder="Department ID">
                </div>
                <input class="btn btn-info btn-block" name="program" type="submit" value="Insert">
            </div>
            <div class="section programmeOb hidden">
                <h3>Programme objective</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="pob_program_ob_no" placeholder="Programme Objective No">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="pob_progam_ob_description" placeholder="Objective Description">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="pob_program_id" placeholder="Programme ID">
                </div>
                <input class="btn btn-info btn-block" name="program_ob" type="submit" value="Insert">
            </div>
            <div class="section questions hidden">
                <h3>Questions</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="questions_question_id" placeholder="Question ID">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="questions_description" placeholder="Description">
                </div>
                <div class="form-group">
                    <input class="form-control" type="textarea" name="questions_answer" placeholder="Answer">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="questions_exam_id" placeholder="Exam ID">
                </div>
                <input class="btn btn-info btn-block" name="questions" type="submit" value="Insert">
            </div>
            <div class="section students hidden">
                <h3>Student</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="std_std_id" placeholder="Student ID">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="std_std_name" placeholder="Student Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="std_std_reg_no" placeholder="Registration No">
                </div>
                <input class="btn btn-info btn-block" name="students" type="submit" value="Insert">
            </div>
        </form>
        </div>
        <div class="col-md-4"></div>
        </div>
        </div>

        <div id="generateReportSection" class="hidden">
            <!-- <h3>Generate Report</h3> -->
            <div class="responseReport">
                <?php require "resources/ajaxAdminReport.php"; ?>
            </div>
        </div> 
    </div>         
    <script src="js/admin.js"></script>
</body>
</html>