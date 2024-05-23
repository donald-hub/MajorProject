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
            $course_id = $_POST['course'];
            $full_marks = $_POST['full_marks'];
            $instruction = $_POST['instruction'];
            $questions = $_POST['questions'];
            $mark = $_POST['mark'];

            $counter = 0;
            $date = getdate(); 
            $year = $date['year']; 
            $exam_id = $exam."_".$session_type."_".$year;
            foreach ($questions as $value) {
                $counter++;
                try{
                    $sql = "INSERT INTO question_paper (que_id, description, exam_id, course_id) VALUES ('$counter', '$value', '$exam_id', '$course_id')";
                    // use exec() because no results are returned
                    $conn->exec($sql);
                    } 
                    catch(PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }
            }


           





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
            $no = 0;
            foreach ($questions as $value) {
                $no++;
                $html .= "<div><div style='font-family: Times New Roman; float: left;'>$no. $value</div><div style='float: right;' class='time'>[$mark]</div></div>";
            }
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
            $html .= "<td>2,4</td>";
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