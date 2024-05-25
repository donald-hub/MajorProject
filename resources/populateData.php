<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require "connect.php";


if(isset($_POST['courses'])){
    $course_id = $_POST['courses_course_id'];
    $course_name = $_POST['courses_course_name'];
    $credit = $_POST['courses_credit'];

    try{
        $sql = "INSERT INTO course (course_id, course_name, credit) VALUES ('$course_id', '$course_name', '$credit')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
else if(isset($_POST['course_ob'])){
    $course_id = $_POST['course_ob_course_id'];
    $description = $_POST['course_ob_description'];
    $course_ob_no = $_POST['course_ob_course_ob_no'];

    try{
        $sql = "INSERT INTO course_ob (course_id, description, course_ob_no) VALUES ('$course_id', '$description', '$course_ob_no')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
else if(isset($_POST['dept'])){
    $dept_id = $_POST['dept_dept_id'];
    $dept_name = $_POST['dept_dept_name'];

    try{
        $sql = "INSERT INTO department (dept_id, dept_name) VALUES ('$dept_id', '$dept_name')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
else if(isset($_POST['exam'])){
    $exam_id = $_POST['exam_exam_id'];
    $exam_name = $_POST['exam_exam_name'];
    $course_id = $_POST['exam_course_id'];
    $exam_date = $_POST['exam_exam_date'];

    try{
        $sql = "INSERT INTO exam (exam_id, exam_name, course_id, exam_date) VALUES ('$exam_id', '$exam_name', '$course_id','$exam_date')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
else if(isset($_POST['faculty'])){
    $faculty_id = $_POST['faculty_faculty_id'];
    $f_name = $_POST['faculty_f_name'];
    $l_name = $_POST['faculty_l_name'];
    $dept_id = $_POST['faculty_dept_id'];
    $phone = $_POST['faculty_phone'];
    $passwd = $_POST['faculty_passwd'];

    try{
        $sql = "INSERT INTO faculty (faculty_id, f_name, l_name, dept_id, phone_no, passwd) VALUES ('$faculty_id', '$f_name', '$l_name', '$dept_id', '$phone', '$passwd')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
else if(isset($_POST['program'])){
    $program_id = $_POST['program_programme_id'];
    $program_name = $_POST['program_programme_name'];
    $dept_id = $_POST['program_dept_id'];

    try{
        $sql = "INSERT INTO programme (program_id, program_name, dept_id) VALUES ('$program_id', '$program_name', '$dept_id')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
else if(isset($_POST['program_ob'])){
    $program_ob_no = $_POST['pob_program_ob_no'];
    $program_ob_description = $_POST['pob_progam_ob_description'];
    $program_ob_program_id = $_POST['pob_program_id'];

    try{
        $sql = "INSERT INTO programme_ob (program_ob_no, program_ob_description, program_id) VALUES ('$program_ob_no', '$program_ob_description', '$program_ob_program_id')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}
else if(isset($_POST['questions'])){
    $que_id = $_POST['questions_question_id'];
    $description = $_POST['questions_description'];
    $answer = $_POST['questions_answer'];
    $exam_id = $_POST['questions_exam_id'];

    try{
        $sql = "INSERT INTO question_paper (que_id, description, answer, exam_id) VALUES ('$que_id', '$description', '$answer','$exam_id')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}

else if(isset($_POST['students'])){
    $std_id = $_POST['std_std_id'];
    $std_name = $_POST['std_std_name'];
    $std_reg_no = $_POST['std_std_reg_no'];

    try{
        $sql = "INSERT INTO student (std_id, std_name, reg_no) VALUES ('$std_id', '$std_name', '$std_reg_no')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Inserted successfully";
        } 
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
}






















// $f_name = $_POST['fname'];
// $l_name = $_POST['lname'];
// $f_id = $_POST['facultyId'];
// $dept_id = $_POST['deptId'];
// $phone = $_POST['phone'];
// $password = $_POST['password'];
// $re_password = $_POST['re-password'];
// if ($password != $re_password){
//     echo "Enter same Password!";
// }
// else{
//     try{
//         $sql = "INSERT INTO faculty (f_name, l_name, faculty_id, dept_id, phone_no, passwd) VALUES ('$f_name', '$l_name', '$f_id', '$dept_id', '$phone', '$password')";
//         // use exec() because no results are returned
//         $conn->exec($sql);
//         echo "Registered successfully";
//         } 
//         catch(PDOException $e) {
//             echo $sql . "<br>" . $e->getMessage();
//         }
// }

?>