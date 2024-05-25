<?php
    require "connect.php";
if(isset($_POST['course_id3']) && !empty($_POST['course_id3'])){
    $courseId = $_POST['course_id3'];
    // echo $courseId;
    echo '<select class="form-control" id="course" name="course">
    <option value="' . $courseId . '">' . $courseId . '</option>
    </select>';

}

?>


