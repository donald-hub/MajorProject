<?php
    require "connect.php";
if(isset($_POST['course_id1']) && !empty($_POST['course_id1'])){
    $courseId = $_POST['course_id1'];

try {

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT course_ob.course_ob_no, course_ob.description, course_ob.level, course.course_id, course.course_name
                           FROM course_ob
                           JOIN course ON course_ob.course_id = course.course_id
                           WHERE course_ob.course_id = '$courseId'");
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
                    <th>CO\'s</th>
                    <th>Statements</th>
                    <th>Level</th>
                    <th class="options">Options</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the results and output them
    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['course_ob_no']}</td>
                <td>{$row['description']}</td>
                <td>{$row['level']}</td>
                <td class='options'>
                    <a role='button' id='editBtn'>Edit</a>
                </td>
              </tr>";
    }

    echo '        </tbody>
            </table>
            <button class="btn btn-info">Add CO</button>
            <button class="btn" onclick="download()">Download</button>
        </div>
        </div>
        <div id="editOption" class="hidden">
        <input type="text" name="co" value="CO"></input>
        <input type="text" name="description" value="description"></input>
        </div>';
        

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


// Close the connection
// $pdo = null;'

}

?>


