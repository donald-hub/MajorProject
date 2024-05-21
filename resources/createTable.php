<?php
require "connect.php";
$table_name = $_POST['tname'];
$columns = $_POST['columns'];
$column_name = $_POST['column_name'];
$data_type = $_POST['data_type'];
$primary = $_POST['primary'];
$null = $_POST['null'];
$size = $_POST['size'];
try{
//  // SQL to create table
//  $sql = "CREATE TABLE Users (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(30) NOT NULL,
//     password VARCHAR(255) NOT NULL,
//     email VARCHAR(50),
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
// )";

// // Use exec() because no results are returned
// $conn->exec($sql);
// echo "Table Users created successfully";
for($i = 0; $i<count($column_name) ; $i++){
    echo $column_name[$i];
}
}
catch(PDOException $e) {
echo "Error: " . $e->getMessage();
}
?>