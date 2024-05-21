<?php
require "connect.php";

$f_name = $_POST['fname'];
$l_name = $_POST['lname'];
$f_id = $_POST['facultyId'];
$dept_id = $_POST['deptId'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$re_password = $_POST['re-password'];
if ($password != $re_password){
    echo "Enter same Password!";
}
else{
    try{
        $sql = "INSERT INTO faculty (f_name, l_name, faculty_id, dept_id, phone_no, passwd) VALUES ('$f_name', '$l_name', '$f_id', '$dept_id', '$phone', '$password')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Registered successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}

?>