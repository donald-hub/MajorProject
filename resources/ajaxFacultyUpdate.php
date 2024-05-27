<?php 


if(isset($_POST['update'])){
    if(!empty($_POST['course_ob_no']) && !empty($_POST['description']) && !empty($_POST['level']) && !empty($_POST['course_id'])){
        $course_ob_no = $_POST['course_ob_no'];
        $description = $_POST['description'];
        $level = $_POST['level'];
        $course_id = $_POST['course_id'];

        try{
            $sql = "UPDATE course_ob SET course_ob_no = $course_ob_no, description = $description, level = $level WHERE course_ob_no = $course_ob_no and course_id = $course_id";
            $stmt = $conn->prepare($sql);
            // Execute the statement
            $stmt->execute();
            echo "Record updated successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }
}

?>