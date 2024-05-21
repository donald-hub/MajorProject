<?php
require "connect.php";
    $query = "SELECT course_id, course_name FROM `course`;"; 
  try 
  { 
      $stmt = $conn->prepare($query); 
      // EXECUTING THE QUERY 
      $stmt->execute(); 
  
      $r = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
      // FETCHING DATA FROM DATABASE 
      $result = $stmt->fetchAll(); 
      // OUTPUT DATA OF EACH ROW 
      foreach ($result as $row)  
      { 
          echo "course_id: ".$row["course_id"]." - course_name: ".$row["course_name"]. "<br>"; 
      } 
  } catch(PDOException $e) { 
      echo "Error: " . $e->getMessage(); 
  } 
?>