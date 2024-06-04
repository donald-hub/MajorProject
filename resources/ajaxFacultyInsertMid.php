<?php
    require "connect.php";
if(isset($_POST['course_id']) && !empty($_POST['course_id'])){
    $courseId = $_POST['course_id'];


try {
    $test = 'mid';
    // Get the current date 
    $date = getdate(); 
    $month = $date['mon'];
    $session = $month < 7 ? 'spring' : 'autumn';
    $year = $date['year']; 
    $exam_id = $test.'_'.$session.'_'.$year;
    // echo $exam_id;

  

// Prepare the SQL statement
// $stmt = $conn->prepare("SELECT 
// qp.exam_id,
// qp.course_id,
// rsc.std_id -- or any other aggregate function to pick one std_id
// FROM 
// question_paper qp
// JOIN 
// register_student_course rsc ON qp.course_id = rsc.course_id
// WHERE 
// qp.exam_id = '$exam_id' AND qp.course_id = '$courseId'
// GROUP BY 
// qp.que_id, qp.exam_id, qp.course_id;");

$stmt = $conn->prepare("select std_id from project_data.register_student_course 
where course_id = '$courseId';");
// Execute the statement
$stmt->execute();

// Fetch all the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<div id="printSection"><div class="center">
        <h3 class="headers bold">Course Code:&ThickSpace;'.$courseId.'</h3>
    </div>';
echo '<div class="container">
        <table class="table table-bordered" border = "1">
            <thead>
                <tr>
                <th>Student ID</th>';
                $subquery = "SELECT que_id from project_data.question_paper where exam_id = '$exam_id' and course_id = '$courseId'; ";
                $stmt2 = $conn->prepare($subquery); 
                $stmt2->execute();
                $subresults = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;
                foreach($subresults as $questions){
                    $count++;
                    echo '<th>'.$questions["que_id"].'</th>';
                }


echo '</tr>
            </thead>
            <tbody>';

// Loop through the results and output them
foreach ($results as $row) {
    echo "<tr>
            <td>{$row['std_id']}</td>";
            for($i = 0; $i < $count; $i++){
                echo "<td><input class='form-control' type='text' name='q1'></input> </td>";
            }
            echo "</tr>";
}

echo '        </tbody>
        </table>
        <button style="position: absolute; right: 70px;" class="btn btn-primary">Insert</button>
    </div>
    </div>';
    

} catch (PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

}
?>