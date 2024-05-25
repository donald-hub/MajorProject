
<html>
<head>
<!--including boostrap files below-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        .center{
            text-align: center;
        }
        .bold{
            font-weight: bolder;
        }
    </style>
</head>
<body>

<?php
require "resources/connect.php";
$course_id = 'CS413';
try {

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT course_ob.course_ob_no, course_ob.description, course_ob.level, course.course_id, course.course_name
                           FROM course_ob
                           JOIN course ON course_ob.course_id = course.course_id
                           WHERE course_ob.course_id = '$course_id'");
    // Execute the statement
    $stmt->execute();

    // Fetch all the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="center">
            <h3 class="bold">Course Code:&ThickSpace;'.$results[0]["course_id"].'</h3>
        </div>
        <div class="center">
            <h3 class="bold">Course Name:&ThickSpace;'.$results[0]["course_name"].'</h3>
        </div>';
    echo '<div class="container">
            <table class="table table-bordered" border = "1">
                <thead>
                    <tr>
                    <th>CO\'s</th>
                    <th>Statements</th>
                    <th>Level</th>
                    <th>Options</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the results and output them
    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['course_ob_no']}</td>
                <td>{$row['description']}</td>
                <td>{$row['level']}</td>
                <td><a role='button'>Edit</a></td>
              </tr>";
    }

    echo '        </tbody>
            </table>
            <button class="btn btn-info">Add CO</button>
        </div>';
        

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the connection
// $pdo = null;'
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>