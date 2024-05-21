<?php
require "connect.php";


if(isset($_POST['add_answer'])){
    $que_id = $_POST['que_id'];
    $exam_id = $_POST['exam_id'];
    $answer = $_POST['answer'];

    try{
        $sql = "INSERT INTO answers (que_id, exam_id, answer) VALUES ('$que_id', '$exam_id', '$answer')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
?>