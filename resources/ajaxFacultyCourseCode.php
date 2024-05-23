<?php
    require "connect.php";
if(isset($_POST['course_id']) && !empty($_POST['course_id'])){
    $courseId = $_POST['course_id'];


    echo $courseId;

// Close the connection
// $pdo = null;'

}

?>


