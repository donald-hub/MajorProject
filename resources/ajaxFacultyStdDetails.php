<?php
    require "connect.php";
if(isset($_POST['course_id']) && !empty($_POST['course_id'])){
    $courseId = $_POST['course_id'];


try {

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT 
                        student.std_id, 
                        student.std_name, 
                        course.course_id, 
                        course.course_name,
                        SUM(CASE WHEN marks.exam_id = 'test1_spring_2024' THEN marks.marks ELSE 0 END) as test1,
                        SUM(CASE WHEN marks.exam_id = 'mid_spring_2024' THEN marks.marks ELSE 0 END) as mid_term,
                        SUM(CASE WHEN marks.exam_id = 'test2_spring_2024' THEN marks.marks ELSE 0 END) as test2,
                        SUM(CASE WHEN marks.exam_id = 'end_spring_2024' THEN marks.marks ELSE 0 END) as end_term
                        FROM 
                        marks
                        JOIN 
                        register_student_course ON register_student_course.std_id = marks.std_id
                        JOIN 
                        student ON marks.std_id = student.std_id
                        JOIN 
                        course ON register_student_course.course_id = course.course_id
                        WHERE 
                        register_student_course.course_id = '$courseId'
                        GROUP BY 
                        student.std_id, 
                        student.std_name, 
                        course.course_id, 
                        course.course_name;
");
// Execute the statement
$stmt->execute();

// Fetch all the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<div id="printSection"><div class="center">
        <h3 class="headers bold">Course Code:&ThickSpace;'.$courseId.'</h3>
    </div>
    <div class="center">
       <h3 class="headers bold">Course Name:&ThickSpace;'.$results[0]["course_name"].'</h3>
    </div>';
echo '<div class="container">
        <table class="table table-bordered" border = "1">
            <thead>
                <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Test 1</th>
                <th>Mid Term</th>
                <th>Test 2</th>
                <th>End Term</th>
                <th>Total</th>
                <th>Percentage</th>
                </tr>
            </thead>
            <tbody>';

// Loop through the results and output them
foreach ($results as $row) {
    $total = $row['test1']+$row['test2']+$row['mid_term']+$row['end_term'];
    $percentage = ($total/150)*100;
    echo "<tr>
            <td>{$row['std_id']}</td>
            <td>{$row['std_name']}</td>
            <td>{$row['test1']}</td>
            <td>{$row['mid_term']}</td>
            <td>{$row['test2']}</td>
            <td>{$row['end_term']}</td>
            <td>{$total}</td>
            <td>{$percentage}</td>
          </tr>";
}

echo '        </tbody>
        </table>
        <button class="btn btn-info">Add CO</button>
        <button class="btn" onclick="download()">Download</button>
    </div>
    </div>
    <div id="editOption" class="hidden">
    <input type="text" name="description" value="description"></input>
    </div>';
    

} catch (PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

}
?>