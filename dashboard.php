<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/print.css">
    <!--including boostrap files below-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navigationBar">
        <img src="images/logo.png" alt="" height="80" width="80">
        <span>Tezpur University</span>
        <img class="profile" src="images/profile-logo.png" alt="" height="50" width="60">    
    </nav>
    <nav class="navbarMenu">
        
        <span>
        <i class="bi-arrow-left-circle" onclick="goBack()"></i>
        Dashboard
    </span>
        <form action="resources/logout.php" method="post"><input type="submit"  name="logout" class="logout" value="Logout"></input></form>
    </nav>

    <div class="cardContainer">
        <?php
        require "resources/connect.php";
        $user = $_SESSION['user'];
        try {

            // Prepare the SQL statement
            $stmt = $conn->prepare("SELECT faculty_id, course_id
                                   FROM teaches_faculty_course
                                   WHERE faculty_id = '$user';");
            // Execute the statement
            $stmt->execute();
        
            // Fetch all the results
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Loop through the results and output them
            foreach ($results as $row) {
                echo '<div class="card">
                <span class="cardTitle" id="course_id" value="'.$row['course_id'].'">'.$row['course_id'].'</span>
            </div>';
            }
                
        
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
        
    </div>
    
    <div class="cardOptions hidden">
        <div class="sideBar">
            <ul class="view">
                <li class="menuItems one" >Course Details</li>
                <li class="menuItems two">View Course Objectives</li>
                <li class="menuItems three">Question Papers</li>
                <li class="menuItems five">PYQ's</li>
                <li class="menuItems four">Students Marks Details</li>
            </ul>
        </div>
            
        <div class="main container"> 
            <input type="hidden" id="course_id" value="CS413"></input>
            <div id="courseDetails" class="courseDetails hidden">
                <!-- <h3>Course Details</h3> -->
                <div class="jumbotron" style="margin-top: 50px; background-color: #AED6F1;">
                    <h1>Data Mining</h1>
                    <ul id="courseDetails">
                    <ul id="sublist">
                        <li>Course Code:</li>
                        <li class="course-title"></li>
                    </ul>
                    <ul id="sublist">
                        <li>Course Name:</li>
                        <li>Data Mining</li>
                    </ul>
                    <ul id="sublist">
                        <li>Course Credit:</li>
                        <li>4</li>
                    </ul>
                    <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p> -->
                </div>
                
            
                
                
            </ul>
            </div>
            <div id="answers" class="answers hidden">
                        <h3>answers</h3>
                        <form action="resources/insertAnswers.php" method="post">
                        <div class="form-group">
                    <input class="form-control" type="text" name="que_id" placeholder="Question ID" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="exam_id" placeholder="Exam ID">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="answer" placeholder="Answer">
                </div>
                <input class="btn btn-info btn-block" name="add_answer" type="submit" value="Insert">
            </div>
        </form>
        
        
        
        
        
        <div id="editCos" class="editCos hidden">
            <h3>Course Objectives</h3>
            <div id="responseCos"></div>
            <div id="responseEditCoSection" style="margin-top: 50px">
            <form class="form" action="" method="post">
                <div class="row">
                <div class="form-group col-md-1">
                    <input class="form-control" type="text" placeholder="CO" value="CO1"></input>
                </div>
                <div class="form-group col-md-8">
                    <input class="form-control" type="text" placeholder="Description" value="Choose appropriate protocol and parameters under given use cases and network conditions."></input>
                </div>
                <div class="form-group col-md-1">
                    <input class="form-control" type="text" placeholder="Level" value="1"></input>
                </div>
                <div class="col-md-2">
                    <input class="btn btn-success" name="update" type="button" value="Update" onclick="update()">
                </div>
                </div>
            </form>
            </div> 
                    
                </div>






                <div id="studentDetails" class="studentDetails hidden">
                    <!-- <h3>Student Details</h3> -->
                    <div id="responseStdDetails"></div>
                    <div class="insertMarks">
                        <button id="first_term" class="btn btn-success" type="button" name="first_term">Insert First Term Marks</button>
                        <button id="mid_term" class="btn btn-success" type="button" name="mid_term">Insert Mid Term Marks</button>
                        <button id="second_term" class="btn btn-success" type="button" name="second_term">Insert Second Term Marks</button>
                        <button id="end_term" class="btn btn-success" type="button" name="end_term">Insert End Term Marks</button>
                        <div id="responseInsertMarks"></div>
                    </div>

                </div>




                <div id="questionPaper" class="questionPaper hidden">
                    <!---question paper section start--->
                   
        <form class="form-horizontal" action="questionpaper.php" method="POST">
            <div class="form-group">
                <label class="col-md-2 control-label" for="exam">Exam Name:</label>
                <div class="col-md-10">
                    <select class="form-control" id="exam" name="exam">
                        <option value="test1" active>1st Sesssional Examination</option>
                        <option value="mid">Mid Term Examination</option>
                        <option value="test2">2nd Sessional Examination</option>
                        <option value="end">End Term Examination</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="session_type">Session Type:</label>
                <div class="col-md-10">
                    <select class="form-control" name="session_type" id="session_type">
                        <option value="autumn" active>Autumn</option>
                        <option value="spring">Spring</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="course_id">Course Code</label>
                <div class="col-md-10"  id="responseCode">
                    
            </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="full_marks">Full Marks:</label>
                <div class="col-md-10">
                    <select class="form-control" name="full_marks" id="full_marks">
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="40">40</option>
                        <option value="60">60</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="instruction">Instructions: </label>
                <div class="col-md-10">
                    <textarea class="form-control" id="instruction" name="instruction" rows="3" cols="50">The cat was playing in the garden.</textarea>
                </div>
            </div>
            <div id="question">
                <div class="form-group">
                    <div>
                        <label class="col-md-2 control-label" for="q1">1.</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="q1" id="q1" rows="5" cols="70" required>q1</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <label class="col-md-6 control-label"  style="transform: translate(0%, -25%);" for="exampleFormControlFile1">Upload Image:</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="col-md-5" >
                        <label class="col-md-6 control-label" style="transform: translate(0%, -20%);" for="mark">Mark:</label>
                        <div class="col-md-6">
                            <input type="number" id="m1" name="m1" min="1" max="20" value ="1" onchange="totalMarks()">     
                        </div>
                    </div>
                </div>
                <input type="hidden" name="totalSubQuestions1" id="totalSubQuestions1" value="0"></input>
            </div>
            
            <div class="col-md-12 form-group">
                <div class="col-md-5"></div>
                <div class="col-md-4">
                <button style="border: 1px solid orange;" class="btn btn-default" type="button" id="addSubQuestion">Add Sub-Question</button>
                <button style="border: 1px solid orange;" class="btn btn-default" type="button" id="addQuestion">Add Question</button>
                <input type="hidden" name="totalQuestions" id="totalQuestions" value="1"></input>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                    
                        <span id="txtHint">
                        </span>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="col-md-12 form-group">
                <input class="btn btn-primary" type="submit" id="create" name="create" value="Create"></input>
            </div>
        </form>



                    <!---question paper section end --->
                </div>
            </div>   
            
        </div>

    <script src="js/dashboard.js" required></script>
    <script src="js/questionpaper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/jQuery/jQuery.js"></script>
</body>
</html>