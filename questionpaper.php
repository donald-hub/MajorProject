<?php
error_reporting(0); 
require "resources/connect.php";
require_once __DIR__ . '/vendor/autoload.php';
if(isset($_POST['create'])){
    if( !empty($_POST['exam']) && !empty($_POST['session_type']) && !empty($_POST['full_marks']) && !empty($_POST['questions']) && !empty($_POST['mark']))
    {
    // Retrieve form data
    $exam = $_POST['exam'];
    $session_type = $_POST['session_type'];
    $course_id = $_POST['course_id'];
    $full_marks = $_POST['full_marks'];
    $instruction = $_POST['instruction'];
    $questions = $_POST['questions'];
    $mark = $_POST['mark'];
    $mpdf = new \Mpdf\Mpdf();
    $html = "<style>.universityName{margin: 0; text-align: center} .container{display: flex; } .container p{text-align: center; margin: 0; font-family: sans-serif;}";
    $html .= ".time{text-align: right} .note{font-size: small; text-align: center;}";
    $html .= "table,th,td{border: 1px solid; border-collapse: collapse;}";
    $html .= ".instructions{font-size: small; border: 1px solid black; font-style: italic; padding: 10px; margin-bottom: 10px;}</style>";
    $html .= "<div style='text-align: right'>TU/CSE</div>";
    $html .= "<h2 class='universityName'>Tezpur University</h2>";
    $html .= "<div class='container'>";
    $year =date("Y");
    if($exam == 'one') $html .= "<p>Sessional I Examination, $session_type $year </p>";
    else if($exam == 'two') $html .= "<p>Sessional II Examination, $session_type $year </p>";
    else if($exam == 'mid') $html .= "<p>Mid term Examination, $session_type $year </p>";
    else if($exam == 'end') $html .= "<p>End term Examination, $session_type $year </p>";
    //fetch course_name
    $query = "SELECT course_name FROM course where course_id = '$course_id';"; 
    try 
    { 
      $stmt = $conn->prepare($query); 
      // EXECUTING THE QUERY 
      $stmt->execute(); 
      $r = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
      // FETCHING DATA FROM DATABASE 
      $result = $stmt->fetchAll(); 
      // OUTPUT DATA OF EACH ROW 
      foreach ($result as $row)  
      { 
        $course_name = $row['course_name'];
        $html .= "<p>" . $course_id . " : " . $course_name . "</p>";
      } 
    } catch(PDOException $e) { 
      echo "Error: " . $e->getMessage();
    }
    // end fetch course name
    if($exam == 'one') $time = '1 hr';
    else if($exam == 'two') $time = '1 hrs';
    else if($exam == 'mid') $time = '2 hrs';
    else if($exam == 'two') $time = '3 hrs';
    $html .= "<div><div style='float: left; width: 50%;'>Full Marks: $full_marks</div><div style='float: left; width: 50%;' class='time'>Time: $time</div></div>";
    $html .= "<div class='note'>(The figures in the right hand margin indicates full marks for the questions.)</div>";
    $html .= "<hr style='margin-top: 0; margin-bottom: 5px; color: black;'>";
    if($instruction != ""){
        $html .= "<div class='instructions'>Instructions: $instruction</div>";
    }
    //fetch cos and desciptions
    $query = "SELECT course_ob_no,description FROM course_ob where course_id = '$course_id';";
    try 
    { 
      $stmt = $conn->prepare($query); 
      // EXECUTING THE QUERY 
      $stmt->execute(); 
      $r = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
      // FETCHING DATA FROM DATABASE 
      $result = $stmt->fetchAll(); 
      // OUTPUT DATA OF EACH ROW 
    $no = 1;
    $html .= "<div><div style='font-family: Times New Roman; float: left;'>$no. $questions</div><div style='float: right;' class='time'>[$mark]</div></div>";
    $html .= "</div>";
    $html .= "<div>";
    $html .= "<div>";
    $html .= "<table border='1'>";
    $html .= "<caption>Course outcomes mapping to question numbers</caption>";
    $html .= "<tr>";
    $html .= "<th>CO</th>";
    $html .= "<th>Desciption</th>";
    $html .= "<th>Questions</th>";
    $html .= "</tr>";
    foreach ($result as $row)  
    { 
    $html .= "<tr>";
    $html .= "<td>".$row['course_ob_no']."</td>";
    $html .= "<td>".$row['description']."</td>";
    $html .= "<td>2, 4</td>";
    $html .= "</tr>";
    } 
    $html .= "</table>";
    $html .= "</div>";
    $html .= "</div>";
    } catch(PDOException $e) { 
      echo "Error: " . $e->getMessage(); 
    }
    // end fetch co's and descriptions
    $html .= "<div style='font-size: small; font-family: sans-serif courier; text-align: center; font-style: italic'>Best Wishes for your Exam</div>";
    $html .= "<div style='font-size: small;margin-top:0; font-family: sans-serif; text-align: center; font-style: italic'>------------------x------------------</div>";
    $mpdf->WriteHTML($html);
    $file = time().'.pdf';
    $mpdf->output($file,'I');
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/questionpaper.css">
    <!--including boostrap files below-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 m-2">
    <div>

    <form class="form-horizontal" action="questionpaper.php" method="POST">
    <div class="form-group">
        <label class="col-md-2 control-label" for="exam">Exam Name:</label>
        <div class="col-md-10">
            <select class="form-control" id="exam" name="exam">
                <option value="one" active>1st Sesssional Examination</option>
                <option value="mid">Mid Term Examination</option>
                <option value="two">2nd Sessional Examination</option>
                <option value="end">End Term Examination</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="session_type">Session Type:</label>
        <div class="col-md-10">
            <select class="form-control" name="session_type" id="session_type">
                <option value="Autumn" active>Autumn</option>
                <option value="Spring">Spring</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="course_id">Course Code</label>
        <div class="col-md-10">
            <select class="form-control" name="course_id" id="course_id">
                <?php
            $query = "SELECT course_id, course_name FROM course;"; 
            try 
            { 
                $stmt = $conn->prepare($query); 
                // EXECUTING THE QUERY 
                $stmt->execute(); 
                
                $r = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                // FETCHING DATA FROM DATABASE 
                $result = $stmt->fetchAll(); 
                // OUTPUT DATA OF EACH ROW 
                foreach ($result as $row)  
                { 
                    echo "<option onchange=\"test('" . $row['course_id'] . "')\" value=\"" . $row['course_id'] . "\">" . $row['course_id'] . "</option><br/>";
                    
                } 
            } catch(PDOException $e) { 
                echo "Error: " . $e->getMessage(); 
            }
            ?>
        </select>
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
            <textarea class="form-control" id="instruction" name="instruction" rows="5" cols="50">The cat was playing in the garden.</textarea>
        </div>
    </div>
    <div id="question">
        <div class="form-group">
            <div>
                <label class="col-md-2 control-label" for="questions">1.</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="questions" id="questions"></textarea>
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
                    <input type="number" id="mark" name="mark" min="1" max="20" value ="1">     
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class="col-md-12 form-group">
        <div class="col-md-5"></div>
        <div class="col-md-4">
        <button style="border: 1px solid orange;" class="btn btn-default" type="button" id="addSubQuestion">Add Sub-Question</button>
        <button style="border: 1px solid orange;" class="btn btn-default" type="button" id="addQuestion">Add Question</button>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="form-group">
        <div class="col-md-3"></div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-1">CO</th>
                    <th class="col-md-10">Desciption</th>
                    <th class="col-md-1">Questions</th>
                </tr>
                <div id="txtHint">
                <?php
                //fetch co and description in form
        // ob_clean();
        // ob_end_flush();
        //fetch cos and desciptions

        $q = $_REQUEST["q"];
        echo $q;
        if ($q != ""){
            require "resources/connect.php";
            $query = "SELECT course_ob_no,description FROM course_ob where course_id = '$q';";
            try 
            { 
                $stmt = $conn->prepare($query); 
                // EXECUTING THE QUERY 
                $stmt->execute(); 
                $r = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                // FETCHING DATA FROM DATABASE 
                $result = $stmt->fetchAll(); 
                // OUTPUT DATA OF EACH ROW 
                if($q == "") echo "empty";
                else echo $q;
            foreach ($result as $row)  
            {   $html = "";
                $html .= "<tr>";
                $html .= "<td class='col-md-1'>".$row['course_ob_no']."</td>";
                $html .= "<td class='col-md-10'>".$row['description']."</td>";
                $html .= "<td class='col-md-1'>2, 4</td>";
                $html .= "</tr>";
                echo $html;
                } 
            } catch(PDOException $e) { 
                echo "Error: " . $e->getMessage(); 
            }
    }
    //end fetch co and description in form                
    ?>
            
        </div>
        </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="col-md-12 form-group">
        <input class="btn btn-primary" type="submit" name="create" value="Create"></input>
    </div>
</form>
</div>
    </div>
    <div class="col-md-1"></div>
</div>
</div>

<script src="js/questionpaper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/jQuery/jQuery.js"></script>
</body>
</html>



