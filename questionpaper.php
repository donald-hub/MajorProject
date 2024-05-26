<?php
error_reporting(0); 
require "resources/connect.php";
require_once __DIR__ . '/vendor/autoload.php';

if (isset($_POST['create'])) {
    if (!empty($_POST['exam']) && !empty($_POST['session_type']) && !empty($_POST['full_marks']) && !empty($_POST['totalQuestions'])) {
        // Retrieve form data
        $exam = $_POST['exam'];
        $session_type = $_POST['session_type'];
        $course_id = $_POST['course'];
        $full_marks = $_POST['full_marks'];
        $instruction = $_POST['instruction'];
        $totalQuestions = $_POST['totalQuestions'];
        $array = ['a', 'b', 'c', 'd', 'e', 'f', 'g','h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $date = getdate();
        $year = $date['year'];
        $exam_id = $exam . "_" . $session_type . "_" . $year;
        
        
        
        $mpdf = new \Mpdf\Mpdf();
        $html = "<style>.universityName{margin: 0; text-align: center} .container{display: flex; } .container p{text-align: center; margin: 0; font-family: sans-serif;}";
        
        $html .= ".time{text-align: right} .note{font-size: small; text-align: center;}";
        $html .= "table,th,td{border: 1px solid; border-collapse: collapse;}";
        $html .= ".instructions{font-size: small; border: 1px solid black; font-style: italic; padding: 10px; margin-bottom: 10px;}</style>";
        $html .= "<div style='text-align: right'>TU/CSE</div>";
        $html .= "<h2 class='universityName'>Tezpur University</h2>";
        $html .= "<div class='container'>";
        $year = date("Y");
        if ($exam == 'test1') $html .= "<p>Sessional I Examination, $session_type $year </p>";
        else if ($exam == 'test2') $html .= "<p>Sessional II Examination, $session_type $year </p>";
        else if ($exam == 'mid') $html .= "<p>Mid term Examination, $session_type $year </p>";
        else if ($exam == 'end') $html .= "<p>End term Examination, $session_type $year </p>";

        // Fetch course_name
        $query = "SELECT course_name FROM course WHERE course_id = '$course_id';";
        try {
            $stmt = $conn->prepare($query);
            // Executing the query
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            // Output data of each row
            foreach ($result as $row) {
                $course_name = $row['course_name'];
                $html .= "<p>" . $course_id . " : " . $course_name . "</p>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        // End fetch course name

        if ($exam == 'test1') $time = '1 hr';
        else if ($exam == 'test2') $time = '1 hrs';
        else if ($exam == 'mid') $time = '2 hrs';
        else if ($exam == 'end') $time = '3 hrs';
        $html .= "<div><div style='float: left; width: 50%;'>Full Marks: $full_marks</div><div style='float: left; width: 50%;' class='time'>Time: $time</div></div>";
        $html .= "<div class='note'>(The figures in the right hand margin indicates full marks for the questions.)</div>";
        $html .= "<hr style='margin-top: 0; margin-bottom: 5px; color: black;'>";
        if ($instruction != "") {
            $html .= "<div class='instructions'>Instructions: $instruction</div>";
        }
       
        // Fetch course outcomes and descriptions
        $query = "SELECT course_ob_no, description FROM course_ob WHERE course_id = '$course_id';";
        try {
            $stmt = $conn->prepare($query);
            // Executing the query
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();


            //external loop for inserting parent quesiont
        for($i = 1; $i<= $totalQuestions ; $i++){
            $questions[$i-1] = $_POST['q'.$i];
            $marks[$i-1] = $_POST['m'.$i];
            $totalSubQuestions = $_POST['totalSubQuestions'.$i];

            try {
                $index = $i - 1;
                $sql = "INSERT INTO question_paper (que_id, description, exam_id, course_id, fk_que_id, marks) VALUES ('$i', '".$questions[$index]."', '$exam_id', '$course_id', NULL, '$marks[$index]')";
                $conn->exec($sql);
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }

            // Generate questions and marks
            $html .= "<div><div style='font-family: Times New Roman; float: left;'> $i. " . htmlspecialchars($questions[$index]) . "</div><div style='float: right;' class='time'>".$marks[$index]."</div></div>";

            //internal loop for inserting subquestions
            for($j = 0; $j < $totalSubQuestions; $j++){
                $subQuestionIndex = 'q' . $i . $array[$j];
                $subQuestions[$j] = $_POST[$subQuestionIndex];
                $subQuestionIndex = 'm'.$i.$array[$j];
                $subMarks[$j] = $_POST[$subQuestionIndex];
                try {
                    $subQuestion_id = $i.$array[$j];
                    $subQuestion = $subQuestions[$j];
                    $sql = "INSERT INTO question_paper (que_id, description, exam_id, course_id, fk_que_id, marks) VALUES ('$subQuestion_id', '$subQuestion', '$exam_id', '$course_id', '$i', '$subMarks[$j]')";
                    // use exec() because no results are returned
                    $conn->exec($sql);
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
                $html .= "<div><div style='font-family: Times New Roman; float: left;'>($array[$j])" . htmlspecialchars($subQuestions[$j]) . "</div><div style='float: right;' class='time'>".$subMarks[$j]."</div></div>";

            }
        }
     
           

            // Table for course outcomes mapping
            $html .= "<div>";
            $html .= "<table border='1'>";
            $html .= "<caption>Course outcomes mapping to question numbers</caption>";
            $html .= "<tr>";
            $html .= "<th>CO</th>";
            $html .= "<th>Description</th>";
            $html .= "<th>Questions</th>";
            $html .= "</tr>";
            foreach ($result as $row) {
                $html .= "<tr>";
                $html .= "<td>" . $row['course_ob_no'] . "</td>";
                $html .= "<td>" . $row['description'] . "</td>";
                $html .= "<td>2,4</td>"; // Update this according to your logic
                $html .= "</tr>";
            }
            $html .= "</table>";
            $html .= "</div>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        // End fetch course outcomes and descriptions

        $html .= "<div style='font-size: small; font-family: sans-serif courier; text-align: center; font-style: italic'>Best Wishes for your Exam</div>";
        $html .= "<div style='font-size: small;margin-top:0; font-family: sans-serif; text-align: center; font-style: italic'>------------------x------------------</div>";
        $mpdf->WriteHTML($html);
        $file = time() . '.pdf';
        $mpdf->output($file, 'I');
    }
}
?>
