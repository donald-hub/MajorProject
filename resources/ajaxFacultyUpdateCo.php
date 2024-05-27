<?php 
require "connect.php";
if(isset($_POST['course_ob_no']) && isset($_POST['description']) && isset($_POST['level']) && isset($_POST['courseId'])){
    $course_ob_no = $_POST['course_ob_no'];
    $description = $_POST['description'];
    $level = $_POST['level'];
    $course_id = $_POST['courseId'];

}


?>