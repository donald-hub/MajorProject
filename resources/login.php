<?php
session_start();
require "connect.php";
if(isset($_POST['userType'])){
$user_type = $_POST['userType'];
$id = $_POST['username'];
$passwd = $_POST['password'];
try 
  { if($user_type == "faculty")
    $query = "SELECT faculty_id, passwd FROM `faculty` WHERE faculty_id='$id' AND passwd='$passwd';";
    else if($user_type == "admin")
    $query = "SELECT id, admin_pass FROM `admin` WHERE id='$id' AND admin_pass='$passwd';";

      $stmt = $conn->prepare($query); 
      // EXECUTING THE QUERY 
      $stmt->execute(); 
  
      $r = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
      // FETCHING DATA FROM DATABASE 
      $result = $stmt->fetchAll(); 
      // OUTPUT DATA OF EACH ROW 
      if(!$result){
        echo "Login failed";
      }
      else{
        $_SESSION['user']=$_POST['username'];
        if($user_type == "faculty")
        header("Location: ../dashboard.php");
        else if($user_type == "admin")
        header("Location: ../admin.php");

      }
  } catch(PDOException $e) { 
      echo "Error: " . $e->getMessage(); 
  } 
  


}

?>

<?php 
/*
foreach ($result as $row)  
      { 
          echo "Roll No: " . $row["Roll_No"]. " - Name: " .  
            $row["Name"]. " | City: " . $row["City"]. "<br>"; 
      } 
*/
?>